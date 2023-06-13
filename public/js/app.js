// app.js

// Função para confirmar exclusão de uma tarefa
function confirmDelete() {
    return confirm("Tem certeza de que deseja excluir esta tarefa?");
}

// Evento de clique no botão de exclusão
var deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        var result = confirmDelete();
        if (!result) {
            event.preventDefault();
        }
    });
});
