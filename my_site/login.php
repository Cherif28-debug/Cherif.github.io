<?php
session_start();

$correctPassword = 'CS203';
$error = null;

if (isset($_POST['password'])) {
    if ($_POST['password'] === $correctPassword) {
        $_SESSION['logged_in'] = true;
        header('Location: to-do.php'); // Redirige vers la page de tâches
        exit();
    } else {
        $error = "Mot de passe incorrect !";
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

<form method="post" action="login.php">
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
