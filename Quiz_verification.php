<?php
// Vérifie si tous les champs existent
if (
    empty($_GET['name']) ||
    empty($_GET['email']) ||
    empty($_GET['q1']) ||
    empty($_GET['q3']) ||
    empty($_GET['q4']) ||
    empty($_GET['q5'])
) {
    echo "<p style='color:red;'>Veuillez remplir toutes les questions obligatoires.</p>";
    echo "<a href='my_form.php'>Retour au formulaire</a>";
    exit;
}

// Récupération des données
$name = htmlspecialchars($_GET['name']);
$email = htmlspecialchars($_GET['email']);
$q1 = $_GET['q1'];
$q3 = $_GET['q3'];
$q4 = (int)$_GET['q4'];
$q5 = $_GET['q5'];
$q2 = isset($_GET['q2']) ? $_GET['q2'] : [];

// Calcul du score
$score = 0;

if ($q1 == 'A') $score += 10;
if (in_array('A', $q2)) $score += 10;
if ($q3 == 'leader') $score += 15;
if ($q4 >= 5) $score += 15;
if ($q5 == 'A') $score += 10;

// Détermine le type d’étudiant
if ($score < 20) {
    $resultat = "Étudiant relax 😎";
} elseif ($score < 40) {
    $resultat = "Étudiant équilibré ⚖️";
} else {
    $resultat = "Étudiant ultra motivé 🚀";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du quiz</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="result-page">
    <h1>Résultat du quiz</h1>
    <p>Merci, <strong><?= $name ?></strong> (<em><?= $email ?></em>)</p>

    <h2>Ton résultat : <?= $resultat ?></h2>

    <h3>Toutes les catégories possibles :</h3>
    <ul>
        <li>Étudiant relax 😎</li>
        <li>Étudiant équilibré ⚖️</li>
        <li>Étudiant ultra motivé 🚀</li>
    </ul>

    <p><a href="my_form.php">Refaire le quiz</a></p>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
