<?php

namespace DevFullStack\Rule;

use DevFullStack\Controller\UserController;
use DevFullStack\Entity\User;
use Exception;

class RuleUser extends Rule
{
    public static function isValidUserToCreate(User $user): void
    {
        self::isValidFirstName($user->first_name, 'Nome');
        self::isValidLastName($user->last_name, 'Sobrenome');
        self::isValidDocument($user->document, 'Documento');
        self::isValidEmail($user->email, 'E-mail');
        self::isValidPhoneNumber($user->phone_number, 'Telefone');
        self::isValidBirthDate($user->birth_date, 'Data nascimento');
        self::isUniqueEmail($user->email, 'E-mail');
    }

    public static function isValidFirstName($firstName, $paramDesc): void
    {
        self::isParameterNotEmpity($firstName, $paramDesc);
        self::isParamBiggerThanNumberChar($firstName, $paramDesc, 3);
    }

    public static function isValidLastName($lastName, $paramDesc): void
    {
        self::isParameterNotEmpity($lastName, $paramDesc);
        self::isParamBiggerThanNumberChar($lastName, $paramDesc, 3);
    }

    public static function isValidDocument($document, $paramDesc): void
    {
        self::isParameterNotEmpity($document, $paramDesc);
    }

    public static function isValidEmail($email, $paramDesc): void
    {
        self::isParameterNotEmpity($email, $paramDesc);
    }

    public static function isValidPhoneNumber($phoneNumber, $paramDesc): void
    {
        self::isParameterNotEmpity($phoneNumber, $paramDesc);
    }

    public static function isValidBirthDate($birthDate, $paramDesc): void
    {
        self::isParameterNotEmpity($birthDate, $paramDesc);
    }

    public static function isUniqueEmail($email, $paramDesc): void
    {
        $userController = new UserController();
        $user = $userController->findByEmail($email);
        if (!empty($user)) {
            throw new Exception("{$paramDesc} já cadastrado.");
        }
    }
}