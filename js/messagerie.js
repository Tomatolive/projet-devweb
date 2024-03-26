document.getElementById('formulaire').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêcher le rechargement de la page

    var formData = new FormData(this); // Récupérer les données du formulaire
    var xhr = new XMLHttpRequest(); // Créer une nouvelle requête AJAX
    xhr.open('POST', '../messagerie/envoiMessage.php', true); // Définir la méthode et l'URL
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var reponse = JSON.parse(xhr.responseText);
                // Mettre à jour l'interface utilisateur avec la réponse
                if (reponse.succes) {
                    // Actualiser la conversation avec le nouveau message
                    var conversation = document.getElementById('conversation');
                    conversation.innerHTML = conversation.innerHTML + reponse.nvMessage;
                }
            }
        }
    };
    xhr.send(formData); // Envoyer les données du formulaire
});
