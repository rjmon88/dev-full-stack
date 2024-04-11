<?php include __DIR__ . '/../Header/ViewHeader.php' ?>
<h1>Cadastro de Novos Usuários</h1>

<form id="user-form">
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
    <button type="submit">Cadastrar</button>
</form>

<h2>Listagem de Usuários Cadastrados</h2>

<table id="user-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>Documento</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Data Nascimento</th>
        <th>Criado</th>
        <th>Atualizado</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody id="user-list">
    <!-- Os usuários serão renderizados aqui -->
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/src/View/User/ViewListUser.js"></script>
<?php include __DIR__ . '/../Footer/ViewFooter.php' ?>