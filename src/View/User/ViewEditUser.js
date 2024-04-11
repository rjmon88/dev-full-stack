$(document).ready(function() {
    // Função para obter o ID do usuário a partir da URL
    function getUserIdFromUrl() {
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        return urlParams.get('id');
    }

    // Função para carregar os dados do usuário a ser editado
    function loadUserData(userId) {
        $.ajax({
            url: '/api/users/edit/?id=' + userId, // URL da API para buscar dados do usuário
            method: 'GET',
            success: function(user) {
                let birth_date_formated = new Date(user.birth_date.date);
                // Preenche os campos do formulário com os dados do usuário
                $('#user-id').val(user.id);
                $('#first-name').val(user.first_name);
                $('#last-name').val(user.last_name);
                $('#document').val(user.document);
                $('#email').val(user.email);
                $('#phone-number').val(user.phone_number);
                $('#birth-date').val(birth_date_formated.toISOString().slice(0, 10));
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar dados do usuário:', status, error);
            }
        });
    }

    // Obtém o ID do usuário da URL
    var userId = getUserIdFromUrl();

    // Verifica se o ID do usuário está presente na URL
    if (userId) {
        // Carrega os dados do usuário a ser editado
        loadUserData(userId);
    } else {
        console.error('ID do usuário não encontrado na URL');
    }

    // Evento de envio do formulário de edição de usuário
    $('#edit-user-form').submit(function(event) {
        event.preventDefault();

        // Obtém os dados do formulário
        var formData = $(this).serialize();

        // Envia os dados para a API editar o usuário
        $.ajax({
            url: '/api/users/update/' + userId, // URL da API para editar usuário
            method: 'PUT',
            data: formData,
            success: function(response) {
                let json = JSON.parse(response);
                alert(json.message);
                // Redireciona para a página de listagem de usuários após editar
                window.location.href = '/web/users';
            },
            error: function(xhr, status, error) {
                console.error('Erro ao editar usuário:', status, error);
            }
        });
    });
});
