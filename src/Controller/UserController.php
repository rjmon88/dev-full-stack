<?php

namespace DevFullStack\Controller;


use DateTime;
use DevFullStack\Entity\User;
use DevFullStack\Mapper\MapperUser;
use DevFullStack\Rule\RuleUser;
use Exception;

class UserController
{
    protected $mapperUser;

    public function __construct()
    {
        $this->mapperUser = new MapperUser();
    }

    // Listagem de usuários
    public function index()
    {
        /** @var User[] $usersList */
        $usersList = $this->mapperUser->findAll();

        // Retorna os usuários como JSON
        header('Content-Type: application/json');
        echo json_encode($usersList);
    }

    // Exibição de um usuário específico
    public function show($id)
    {
        $user = User::find($id); // Busca o usuário pelo ID

        if (!$user) {
            // Usuário não encontrado
            http_response_code(404);
            echo json_encode(array("message" => "Usuário não encontrado."));
            return;
        }

        // Retorna o usuário como JSON
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    // Exibição de um usuário específico
    public function find($id = null)
    {
        extract($_REQUEST);
        $user = $this->mapperUser->find($id); // Busca o usuário pelo ID

        if (!$user) {
            // Usuário não encontrado
            http_response_code(404);
            echo json_encode(array("message" => "Usuário não encontrado."));
            return;
        }

        // Retorna o usuário como JSON
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    public function findByEmail($email)
    {
        return $this->mapperUser->findByEmail($email);
    }

    public function create(
        $first_name = null,
        $last_name = null,
        $document = null,
        $email = null,
        $phone_number = null,
        $birth_date = null,
    )
    {
        extract($_REQUEST);
        $birth_date = ($birth_date) ? new DateTime($birth_date) : null;

        $user = new User(
            $first_name,
            $last_name,
            $document,
            $email,
            $phone_number,
            $birth_date,
        );
        $user->setCreatedAtValue();

        try {
            RuleUser::isValidUserToCreate($user);
            $user = $this->mapperUser->create($user);

            // Retorna os usuários como JSON
            header('Content-Type: application/json', true, 201);
            echo json_encode($user);
        } catch (Exception $e) {
//            header('Content-Type: application/json');
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    // Criação de um novo usuário
    public function store()
    {
        // Obtenha os dados enviados pelo cliente
        $data = json_decode(file_get_contents("php://input"));

        // Crie um novo usuário com os dados fornecidos
        $user = new User();
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->document = $data->document;
        $user->email = $data->email;
        $user->phone_number = $data->phone_number;
        $user->birth_date = $data->birth_date;

        // Salve o usuário no banco de dados
        if ($user->save()) {
            http_response_code(201); // Código de resposta HTTP: 201 Created
            echo json_encode(array("message" => "Usuário criado com sucesso."));
        } else {
            http_response_code(500); // Código de resposta HTTP: 500 Internal Server Error
            echo json_encode(array("message" => "Erro ao criar usuário."));
        }
    }

    // Atualização de um usuário existente
    public function update(
        $id = null,
        $first_name = null,
        $last_name = null,
        $document = null,
        $email = null,
        $phone_number = null,
        $birth_date = null,
    )
    {
        $putData = file_get_contents("php://input", "r");
        if (empty($putData)) {
            extract($_REQUEST);
        } else {
            parse_str($putData,$putData);
            extract($putData);
        }
        $birth_date = ($birth_date) ? new DateTime($birth_date) : null;

        $user = $this->mapperUser->find($id); // Busca o usuário pelo ID

        if (!$user) {
            // Usuário não encontrado
            http_response_code(404);
            echo json_encode(array("message" => "Usuário não encontrado."));
            return;
        }

        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->document = $document;
        $user->email = $email;
        $user->phone_number = $phone_number;
        $user->birth_date = $birth_date;

        // Salve as alterações no banco de dados
        if ($this->mapperUser->update($user)) {
            echo json_encode(array("message" => "Usuário atualizado com sucesso."));
        } else {
            http_response_code(500); // Código de resposta HTTP: 500 Internal Server Error
            echo json_encode(array("message" => "Erro ao atualizar usuário."));
        }



//        // Busque o usuário pelo ID
//        $user = User::find($id);
//
//        if (!$user) {
//            // Usuário não encontrado
//            http_response_code(404);
//            echo json_encode(array("message" => "Usuário não encontrado."));
//            return;
//        }
//
//        // Obtenha os dados enviados pelo cliente
//        $data = json_decode(file_get_contents("php://input"));
//
//        // Atualize os campos do usuário com os novos dados
//        $user->first_name = $data->first_name;
//        $user->last_name = $data->last_name;
//        $user->document = $data->document;
//        $user->email = $data->email;
//        $user->phone_number = $data->phone_number;
//        $user->birth_date = $data->birth_date;
//
//        // Salve as alterações no banco de dados
//        if ($user->save()) {
//            echo json_encode(array("message" => "Usuário atualizado com sucesso."));
//        } else {
//            http_response_code(500); // Código de resposta HTTP: 500 Internal Server Error
//            echo json_encode(array("message" => "Erro ao atualizar usuário."));
//        }
    }

    // Exclusão de um usuário
    public function delete($id = null)
    {
        extract($_REQUEST);
        $user = $this->mapperUser->find($id); // Busca o usuário pelo ID

        if (!$user) {
            // Usuário não encontrado
            http_response_code(404);
            echo json_encode(array("message" => "Usuário não encontrado."));
            return;
        }

        // Exclua o usuário do banco de dados
        if ($this->mapperUser->delete($user)) {
            echo json_encode(array("message" => "Usuário excluído com sucesso."));
        } else {
            http_response_code(500); // Código de resposta HTTP: 500 Internal Server Error
            echo json_encode(array("message" => "Erro ao excluir usuário."));
        }
    }
}
