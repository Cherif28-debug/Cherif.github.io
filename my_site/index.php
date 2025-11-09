<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Cherif Camara">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checams</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<main>
    <h1>Bienvenue sur ma page personnelle</h1>

    <h2>Qui suis-je ?</h2>
    <p>
        Salut ! Je m'appelle <strong>Cherif Camara</strong>.<br>
        Je suis étudiant-athlète en Neurosciences psychologie et je suis passionné par le <em>football</em> ainsi que la <em>neuroscience</em>.<br>
        Je fais aussi un deuxième sport qu'est le soccer et je le pratique juste durant l'été quand on prend nos vacances de 3 mois au football. Comme ça je m'assure de rester en forme.
    </p>

    <hr>
    <h2>Mes centres d'intérêt</h2>
    <ul>
        <li>Football &amp; Soccer &amp; Golf &amp; Excursion en forêt</li>
        <li>Neuroscience &amp; Médecine &amp; Psychologie</li>
        <li>Passer des moments de solitude dans la nature</li>
        <li>Voyages et Culture</li>
    </ul>

    <hr>
    <h2>Mon parcours scolaire</h2>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: yellow; font-family: Algerian, serif;">
                <th>Année</th>
                <th>Diplôme / École</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <tr>
                <td>2022-...</td>
                <td>B.Sc. Neuroscience, Université de Bishops</td>
            </tr>
            <tr>
                <td>2019-2022</td>
                <td>DEC Sciences Naturelles, Cégep de Sherbrooke</td>
            </tr>
            <tr>
                <td>2015-2019</td>
                <td>DES, École Secondaire Internationale du Phare</td>
            </tr>
        </tbody>
    </table>

    <hr>
    <h2>Mon carrousel d'images</h2>
    <div class="diaporama">
        <div class="slideshow_img"><img src="images/lac_rose.jpg" alt="Lac Rose"></div>
        <div class="slideshow_img"><img src="images/maison_esclaves.jpeg" alt="Maison des esclaves"></div>
        <div class="slideshow_img"><img src="images/riz-poisson.jpg" alt="Riz aux poissons"></div>

        <a href="javascript:void(0)" id="prev" onclick="previous()">&#10094;</a>
        <a href="javascript:void(0)" id="next" onclick="next()">&#10095;</a>
    </div>

    <hr>
    <h2>Références</h2>
    <p>
        Camara, Cherif Ibrahima. 
        <i>My artistic self</i>. 
        <a href="my_artistic_self.php" target="_blank">
            https://Cherif.github.io/my_artistic_self.php/
        </a>, 2025.
    </p>
</main>

<?php include 'footer.php'; ?>

<!-- Carrousel script -->
<script src="carrousel.js" defer></script>

</body>
</html>
