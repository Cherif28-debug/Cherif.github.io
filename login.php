<?php
// ----------------- MODELE -----------------
require_once __DIR__ . '/includes/config.php';
session_start();

$correctPassword = 'CS203';
$error = '';
$message = '';
$username = '';

// Déconnexion
if (isset($_POST['logout'])) {
    session_destroy();
    session_start();
    $message = "Déconnecté avec succès !";
}

// Gestion du fichier login_attempts.json
$attemptsFile = 'login_attempts.json';
if (!file_exists($attemptsFile)) file_put_contents($attemptsFile, json_encode([]));
$attempts = json_decode(file_get_contents($attemptsFile), true);

// Pré-remplissage avec le cookie
if (isset($_COOKIE['todo-username'])) {
    $username = $_COOKIE['todo-username'];
}

// Traitement du formulaire de connexion
if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Initialisation si nouvel utilisateur
    if (!isset($attempts[$username])) {
        $attempts[$username] = ['tentatives' => 0, 'locked_until' => 0];
    }

    // Vérifier verrouillage
    if ($attempts[$username]['locked_until'] > time()) {
        $remaining = $attempts[$username]['locked_until'] - time();
        $error = "Utilisateur temporairement verrouillé, réessayez dans $remaining secondes.";
    } elseif ($password === $correctPassword) {
        // Connexion réussie
        $_SESSION['is_logged_in'] = true;
        setcookie('todo-username', $username, time() + 3600, "/"); // cookie 1h
        $attempts[$username]['tentatives'] = 0;
        $attempts[$username]['locked_until'] = 0;
        file_put_contents($attemptsFile, json_encode($attempts));
        header('Location: to-do.php');
        exit();
    } else {
        // Mauvais mot de passe
        $attempts[$username]['tentatives'] += 1;
        if ($attempts[$username]['tentatives'] >= 3) {
            $attempts[$username]['locked_until'] = time() + 30; // verrou 30s
            $attempts[$username]['tentatives'] = 0;
            $error = "Trop de tentatives. Compte verrouillé 30 secondes.";
        } else {
            $error = "Mot de passe incorrect !";
        }
        file_put_contents($attemptsFile, json_encode($attempts));
    }
}

// Afficher le formulaire même si déjà connecté
$alreadyLoggedIn = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
$redirect = $_SESSION['redirect_to'] ?? 'to-do.php';
header("Location: $redirect");
exit();

?>

<!-- ----------------- VIEW ----------------- -->
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

<?php if (!$alreadyLoggedIn): ?>
<form method="post" action="login.php">
    <label>
        Nom d'utilisateur: 
        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>
    </label><br><br>
    <label>
        Mot de passe: 
        <input type="password" name="password" required>
    </label><br><br>
    <button type="submit">Se connecter</button>
</form>
<?php else: ?>
<p>Vous êtes déjà connecté. <a href="to-do.php">Accéder à la liste des tâches</a> ou <form style="display:inline;" method="post"><button type="submit" name="logout">Se déconnecter</button></form></p>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
