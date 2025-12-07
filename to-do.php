<?php
require_once __DIR__ . '/includes/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (empty($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'nav.php';

$username = isset($_COOKIE['todo-username']) ? $_COOKIE['todo-username'] : 'Utilisateur';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Cherif Camara">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma liste de tâches</title>
    <link rel="stylesheet" href="my_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<!-- Bouton déconnexion -->
<form method="post" action="login.php" style="position:absolute; top:10px; right:10px;">
    <button type="submit" name="logout">Se déconnecter</button>
</form>

<h1>Ma liste de choses à faire</h1>
<h2>La liste de tâches de <?= htmlspecialchars($username) ?></h2>

<form id="todo-form">
    <input type="text" id="new-item" placeholder="Nouvelle tâche...">
    <button type="submit">Ajouter à la liste</button>
</form>

<ul id="todo-list"></ul>

<script>
let items = JSON.parse(localStorage.getItem("items")) || [];

const form = document.getElementById("todo-form");
const input = document.getElementById("new-item");
const list = document.getElementById("todo-list");

function renderItem(text, id) {
    const li = document.createElement("li");
    li.dataset.id = id;

    const spanText = document.createElement("span");
    spanText.textContent = text;
    li.appendChild(spanText);

    const trash = document.createElement("span");
    trash.classList.add("fas", "fa-trash");
    trash.style.cursor = "pointer";
    trash.style.marginLeft = "10px";
    trash.addEventListener("click", () => {
        li.remove();
        items = items.filter(x => x.id !== id);
        localStorage.setItem("items", JSON.stringify(items));
    });

    li.appendChild(trash);
    list.appendChild(li);
}

function renderList() {
    list.innerHTML = '';
    items.forEach(item => renderItem(item.text, item.id));
}

form.addEventListener("submit", (e) => {
    e.preventDefault();
    const text = input.value.trim();
    if (!text) return alert("Veuillez entrer une tâche.");
    const newItem = { text, id: Date.now() };
    items.push(newItem);
    localStorage.setItem("items", JSON.stringify(items));
    renderItem(text, newItem.id);
    input.value = '';
});

renderList();
</script>

<?php include 'footer.php'; ?>
</body>
</html>
