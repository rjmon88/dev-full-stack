$(document).ready(function() {
    // Função para carregar a lista de usuários cadastrados
    function loadUsers() {
        $.ajax({
            url: '/api/users', // URL da API para buscar usuários
            method: 'GET',
            success: function(users) {
                // Limpa o conteúdo atual da lista de usuários
                $('#user-list').empty();

                // Renderiza os usuários na tabela
                users.forEach(function(user) {
                    let birth_date_formated = new Date(user.birth_date.date);
                    let created_at_formated = new Date(user.created_at.date);
                    let updated_at_formated = new Date(user.updated_at.date);

                    let userHtml = '<tr>';
                    userHtml += '<td>' + user.id + '</td>';
                    userHtml += '<td>' + user.first_name + '</td>';
                    userHtml += '<td>' + user.last_name + '</td>';
                    userHtml += '<td>' + user.document + '</td>';
                    userHtml += '<td>' + user.email + '</td>';
                    userHtml += '<td>' + user.phone_number + '</td>';
                    userHtml += '<td>' + birth_date_formated.toLocaleDateString() + '</td>';
                    userHtml += '<td>' + created_at_formated.toLocaleString() + '</td>';
                    userHtml += '<td>' + updated_at_formated.toLocaleString() + '</td>';
                    userHtml += '<td>';
                    userHtml += '<button class="edit-btn" data-id="' + user.id + '">Editar</button>';
                    userHtml += '<button class="delete-btn" data-id="' + user.id + '">Excluir</button>';
                    userHtml += '</td>';
                    userHtml += '</tr>';

                    // Adiciona o HTML do usuário à lista de usuários
                    $('#user-list').append(userHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Erro ao buscar usuários:', status, error);
            }
        });
    }

    // Carrega a lista de usuários cadastrados ao carregar a página
    loadUsers();

    // Evento de envio do formulário de cadastro de usuário
    $('#user-form').submit(function(event) {
        event.preventDefault();

        // Obtém os dados do formulário
        var formData = $(this).serialize();

        // Envia os dados para a API cadastrar o usuário
        $.ajax({
            url: '/api/users/create', // URL da API para cadastrar usuário
            method: 'POST',
            data: formData,
            success: function(response) {
                // Recarrega a lista de usuários após cadastrar um novo usuário
                loadUsers();

                // Limpa os campos do formulário após o cadastro
                $('#user-form')[0].reset();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
                console.error(xhr.responseText, status, error);
            }
        });
    });

    // Evento de clique no botão "Editar"
    $(document).on('click', '.edit-btn', function() {
        var userId = $(this).data('id');
        // Redireciona para a página de edição do usuário com o ID
        window.location.href = '/web/users/edit?id=' + userId;
    });

    // Evento de clique no botão "Excluir"
    $(document).on('click', '.delete-btn', function() {
        var userId = $(this).data('id');

        // Confirmação antes de excluir o usuário
        if (confirm('Tem certeza que deseja excluir este usuário?')) {
            // Envia uma requisição AJAX para excluir o usuário
            $.ajax({
                url: '/api/users/delete/' + userId, // URL da API para excluir usuário
                method: 'DELETE',
                success: function(response) {
                    let json = JSON.parse(response);
                    // Recarrega a lista de usuários após excluir um usuário
                    loadUsers();
                    alert(json.message);
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao excluir usuário:', status, error);
                }
            });
        }
    });
});
