<?php

class ReceitaValidator
{
    public static function nomeValido($nome)
    {
        return is_string($nome) && strlen(trim($nome)) >= 3;
    }

    public static function descricaoValida($descricao)
    {
        return is_string($descricao) && strlen(trim($descricao)) >= 5;
    }

    public static function custoValido($custo)
    {
        return is_numeric($custo) && $custo > 1000;
    }

    public static function tipoValido($tipo)
    {
        return in_array($tipo, ['doce', 'salgada']);
    }

    public static function dataValida($data)
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $data) === 1;
    }
}