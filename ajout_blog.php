<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Sauvegarde la page actuelle pour y revenir après le login
    $_SESSION['redirect_to'] = 'ajout_blog.php';
    // Redirige vers la page de connexion
    header("Location: login_blog.php");
    exit;
}

// Charge les articles existants depuis le fichier JSON
$jsonFile = 'blog_articles.json';
$posts = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère et nettoie le titre et les paragraphes
    $title = trim($_POST['title']);
    $paragraphs = array_filter(array_map('trim', explode("\n", $_POST['paragraphs'])));

    // Vérifie que le titre et au moins un paragraphe sont présents
    if (!empty($title) && !empty($paragraphs)) {
        // Crée un nouvel article
        $newPost = [
            'id' => uniqid('blog'), // ID unique
            'date' => date('Y-m-d'), // Date du jour
            'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'), // Sécurise le titre
            'paragraphs' => array_map(fn($p) => htmlspecialchars($p, ENT_QUOTES, 'UTF-8'), $paragraphs) // Sécurise chaque paragraphe
        ];

        // Ajoute le nouvel article à la liste
        $posts[] = $newPost;

        // Sauvegarde la liste complète dans le fichier JSON
        file_put_contents(
            $jsonFile,
            json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        // Redirige vers la page du blog
        header('Location: blog.php');
        exit();
    } else {
        // Message d'erreur si le formulaire est incomplet
        $error = "Veuillez saisir le titre et au moins un paragraphe.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un nouvel article</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>
<?php include 'nav.php'; // Menu de navigation ?>

<h1>Ajouter un nouvel article</h1>

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= $error ?></p> <!-- Affiche le message d'erreur si nécessaire -->
<?php endif; ?>

<!-- Formulaire pour ajouter un article -->
<form method="post">
    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title" required style="width: 50%;"><br><br>

    <label for="paragraphs">Texte de l'article (un paragraphe par ligne) :</label><br>
    <textarea id="paragraphs" name="paragraphs" rows="10" cols="70" required></textarea><br><br>

    <button type="submit">Ajouter l'article</button>
</form>

<p><a href="blog.php">Retour au blog</a></p>

<?php include 'footer.php'; // Pied de page ?>
</body>
</html>
