<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['logged_in'])) {
    header('Location: login_blog.php'); // Redirige vers la page de login si non connecté
    exit;
}

// Vérifie que l'ID de l'article à supprimer est fourni
if (!isset($_POST['id'])) {
    header('Location: blog.php'); // Redirige vers le blog si pas d'ID
    exit;
}

$idToDelete = $_POST['id']; // Récupère l'ID de l'article
$jsonFile = 'blog_articles.json';

if (file_exists($jsonFile)) {
    // Lit le contenu du fichier JSON
    $posts = json_decode(file_get_contents($jsonFile), true);

    // Supprime l'article correspondant à l'ID
    $posts = array_filter($posts, fn($post) => $post['id'] !== $idToDelete);

    // Réécrit le fichier JSON sans l'article supprimé
    file_put_contents(
        $jsonFile,
        json_encode(array_values($posts), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

// Retour automatique au blog
header('Location: blog.php');
exit;
?>
