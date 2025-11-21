<?php
session_start(); // Démarre la session pour gérer la connexion

$correctPassword = "CS203";   // Mot de passe du cours
$errorMessage = "";            // Message d'erreur si le mot de passe est incorrect

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifie si le mot de passe est correct
    if ($_POST["password"] === $correctPassword) {
        $_SESSION["logged_in"] = true; // Crée la session pour indiquer que l'utilisateur est connecté
        header("Location: blog.php"); // Redirige vers la page du blog
        exit;
    } else {
        $errorMessage = "Mot de passe incorrect. Veuillez réessayer SVP."; // Message d'erreur affiché à l'utilisateur
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion au blog</title>
</head>
<body>
<h1>Connexion</h1>
<?php if ($errorMessage): ?>
    <p style="color:red;"><?= $errorMessage ?></p> <!-- Affiche le message d'erreur si présent -->
<?php endif; ?>
<form method="post">
    <label>Mot de passe :
        <input type="password" name="password" required> <!-- Champ pour saisir le mot de passe -->
    </label>
    <button type="submit">Se connecter</button> <!-- Bouton de connexion -->
</form>
</body>
</html>
