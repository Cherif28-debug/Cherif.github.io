<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Cherif Camara">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checams – Quiz</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">
    <h1>Quel type d'étudiant êtes-vous ?</h1>

    <!-- ✅ Le formulaire envoie maintenant vers quiz_verification.php avec la méthode GET -->
    <form action="quiz_verification.php" method="get">
        <fieldset>
            <legend>Répondez aux questions ci-dessous</legend>

            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" required>

            <hr>

            <p>1. Préférez-vous étudier :</p>
            <div class="choices">
                <input type="radio" id="q1a" name="q1" value="A" required>
                <label for="q1a">Le matin</label>

                <input type="radio" id="q1b" name="q1" value="B">
                <label for="q1b">Le soir</label>
            </div>

            <p>2. Vous êtes plutôt :</p>
            <div class="choices">
                <input type="checkbox" id="q2a" name="q2[]" value="A">
                <label for="q2a">Organisé</label>

                <input type="checkbox" id="q2b" name="q2[]" value="B">
                <label for="q2b">Spontané</label>
            </div>

            <p>3. Quand vous travaillez en groupe, vous êtes :</p>
            <select id="q3" name="q3" required>
                <option value="">--Choisissez une option--</option>
                <option value="leader">Leader</option>
                <option value="suiveur">Suiveur</option>
                <option value="indépendant">Indépendant</option>
            </select>

            <p>4. Combien d’heures par jour étudiez-vous en moyenne ?</p>
            <input type="number" id="q4" name="q4" min="0" max="12" required>

            <p>5. Préférez-vous :</p>
            <div class="choices">
                <input type="radio" id="q5a" name="q5" value="A" required>
                <label for="q5a">Cours théoriques</label>

                <input type="radio" id="q5b" name="q5" value="B">
                <label for="q5b">Cours pratiques</label>
            </div>

            <hr>
            <button type="submit">Soumettre</button>
        </fieldset>
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
