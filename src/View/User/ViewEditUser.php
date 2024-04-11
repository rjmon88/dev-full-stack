<?php include __DIR__ . '/../Header/ViewHeader.php' ?>
<h1>Editar Usuário</h1>

<form id="edit-user-form">
    <input type="hidden" id="user-id" name="id">
    <label for="first-name">Nome:</label>
    <input type="text" id="first-name" name="first_name" required>
    <br>
    <label for="last-name">Sobrenome:</label>
    <input type="text" id="last-name" name="last_name" required>
    <br>
    <label for="document">Documento:</label>
    <input type="text" id="document" name="document" required>
    <br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="phone-number">Telefone:</label>
    <input type="text" id="phone-number" name="phone_number" required>
    <br>
    <label for="birth-date">Data Nascimento:</label>
    <input type="date" id="birth-date" name="birth_date" required>
    <br>
    <button type="submit">Salvar Alterações</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/src/View/User/ViewEditUser.js"></script>
<?php include __DIR__ . '/../Footer/ViewFooter.php' ?>