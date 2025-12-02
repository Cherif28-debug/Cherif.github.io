<?php
session_start(); // Démarre la session pour gérer le login

// Charger le fichier JSON contenant les articles
$jsonFile = 'blog_articles.json';
$posts = [];
if(file_exists($jsonFile)) {
    $json = file_get_contents($jsonFile);
    $posts = json_decode($json, true); // Convertit le JSON en tableau PHP
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Blog</title>
    <link rel="stylesheet" href="my_style.css"> <!-- CSS du site -->
</head>
<body>
<?php include 'nav.php'; ?> <!-- Barre de navigation -->

<h1>Bienvenue sur mon blog</h1>
<p>Ce blog n’est pas seulement une suite d’articles : c’est un espace de partage, 
    de réflexion et de découverte...</p>
<p>Mon objectif est de créer un lieu accueillant où l’on peut apprendre, réfléchir et s’inspirer...</p>
<p><a href="#articles">Commencer la lecture</a></p>

<main>
    <section id="articles">
        <h2>Articles récents</h2>
        <?php if(!empty($posts)): ?> <!-- S'il y a des articles -->
            <?php foreach($posts as $post): ?> <!-- Boucle sur chaque article -->
                <article id="<?= htmlspecialchars($post['id']) ?>">
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><em><?= htmlspecialchars($post['date']) ?></em></p>
                    <?php foreach($post['paragraphs'] as $p): ?>
                        <p><?= nl2br(htmlspecialchars($p)) ?></p> <!-- Affiche chaque paragraphe -->
                    <?php endforeach; ?>

                    <?php if(!empty($_SESSION['logged_in'])): ?> 
                        <!-- Bouton supprimer visible seulement si connecté -->
                        <button onclick="deletePost('<?= htmlspecialchars($post['id']) ?>')">Supprimer</button>
                    <?php endif; ?>

                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun article disponible.</p>
        <?php endif; ?>
    </section>

    <?php if(!empty($_SESSION['logged_in'])): ?> 
        <!-- Lien pour ajouter un article, visible seulement si connecté -->
       <p><a href="ajout_blog.php" class="add-article">Ajouter un nouvel article</a></p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?> <!-- Pied de page -->
</body>
</html>
