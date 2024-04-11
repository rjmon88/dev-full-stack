<?php

namespace DevFullStack\Rule;

use Exception;

class Rule
{
    public static function isParameterNotEmpity($param, $paramDesc): void
    {
        if (empty($param)) {
            throw new Exception("{$paramDesc} não preenchido.");
        }
    }

    public static function isParamBiggerThanNumberChar($param, $paramDesc, $numberChar): void
    {
        if (strlen($param) <= $numberChar) {
            throw new Exception("{$paramDesc} deve ter mais de {$numberChar} caracteres.");
        }
    }
}