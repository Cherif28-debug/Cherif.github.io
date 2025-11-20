<?php
session_start();
require_once __DIR__ . '/includes/config.php'; // si tu veux config spécifique

$correctPassword = 'CS203';
$error = null;
$message = null;

// Déconnexion
if (isset($_POST['logout'])) {
    session_destroy();
    session_start();
    $message = "Déconnecté avec succès !";
}

// Vérification de session existante
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: to-do.php');
    exit();
}

// Gestion du fichier login_attempts.json
$attemptsFile = 'login_attempts.json';
$attempts = file_exists($attemptsFile) ? json_decode(file_get_contents($attemptsFile), true) : [];

// Traitement du formulaire de connexion
if (isset($_POST['username'], $_POST['password'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];

    // Initialiser l'utilisateur si inexistant
    if (!isset($attempts[$user])) {
        $attempts[$user] = ['tentatives' => 0, 'locked_until' => 0];
    }

    // Vérifier si l'utilisateur est verrouillé
    if ($attempts[$user]['locked_until'] > time()) {
        $error = "Utilisateur temporairement verrouillé, réessayez plus tard.";
    } elseif ($password === $correctPassword) {
        // Connexion réussie
        $_SESSION['logged_in'] = true;
        setcookie('todo-username', $user, time() + 3600); // cookie 1h
        // Réinitialiser le compteur de tentatives
        $attempts[$user]['tentatives'] = 0;
        file_put_contents($attemptsFile, json_encode($attempts));
        header('Location: to-do.php');
        exit();
    } else {
        // Mauvais mot de passe
        $attempts[$user]['tentatives'] += 1;
        if ($attempts[$user]['tentatives'] >= 3) {
            $attempts[$user]['locked_until'] = time() + 30; // bloque 30s
            $attempts[$user]['tentatives'] = 0;
            $error = "Verrouillé 30 secondes après 3 tentatives.";
        } else {
            $error = "Mot de passe incorrect !";
        }
        file_put_contents($attemptsFile, json_encode($attempts));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Liste des tâches</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>

<?php include __DIR__ . '/nav.php'; ?>

<h1>Connexion pour accéder à la liste des tâches</h1>

<?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="login.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur" value="<?php echo isset($_COOKIE['todo-username']) ? htmlspecialchars($_COOKIE['todo-username']) : ''; ?>" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
