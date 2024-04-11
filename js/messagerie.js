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

document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.suppr');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var messageId = this.getAttribute('data-message-id');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) {
                // Envoyer une requête AJAX pour supprimer le message
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../messagerie/supprimerMessage.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Actualiser l'interface utilisateur après la suppression
                            if (xhr.responseText.trim() === 'success') {
                                // Supprimer le message de l'interface utilisateur
                                button.parentNode.remove(); // Supprime le message parent du bouton
                            } else {
                                alert('Erreur lors de la suppression du message.');
                            }
                        } else {
                            alert('Erreur de requête AJAX : ' + xhr.status);
                        }
                    }
                };
                xhr.send('message_id=' + messageId); // Envoyer l'identifiant du message
            }
        });
    });
});
