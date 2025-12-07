// Fonction pour supprimer un article
function deletePost(postId) {
    // Demande confirmation à l'utilisateur
    if (!confirm("Es-tu sûr de vouloir supprimer cet article ?")) {
        return; // Si l'utilisateur annule, on quitte la fonction
    }

    // Envoie une requête POST vers le script PHP de suppression
    fetch('suppression_blog.php', {
        method: 'POST', // Méthode POST pour envoyer des données
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(postId) // Envoie l'ID de l'article à supprimer
    })
    .then(res => res.text()) // Récupère la réponse du serveur
    .then(response => {
        console.log(response); // Affiche la réponse dans la console (pour debug)
        window.location.reload(); // Recharge la page pour mettre à jour la liste des articles
    })
    .catch(err => {
        // En cas d'erreur réseau ou autre
        console.error("Erreur lors de la suppression :", err);
        alert("Une erreur est survenue.");
    });
}
