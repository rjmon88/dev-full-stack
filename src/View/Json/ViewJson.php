<?php

class ViewJsonObject
{

    /**
     * @var mixed
     */
    protected $obj = null;

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    /**
     * @return mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * O Método  mágico __toStrong() não pode lançar um exceção. Portanto o
     * retorno será uma msg de erro normal, mas com header 500.
     *
     * @author Alain <alain@cbm.sc.gov.br>
     * @since 20191013
     * @return false|string
     */
    public function __toString()
    {
        //TODO Tratamento para evitar senhas no FRONT
        $this->removerDescSenhaUsuarioRecrsivo($this->obj);

        $retorno = json_encode($this->obj);
        $eCode = json_last_error();
        $eMsg = json_last_error_msg();

        if ($eCode) {
            $retorno = 'JSON ERROR: ' . $eMsg;
            header($eMsg, true, 500);
            return $retorno;
        } else {
            header('Content-Type: application/json');
            return $retorno;
        }
    }
}