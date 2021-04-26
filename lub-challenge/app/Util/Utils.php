<?php

namespace App\Util;

use Illuminate\Support\Arr;

/**
 * Classe utilitária de apoio geral á codificação da aplicação,
 * essa classe contém todos os métodos que sejam comuns à várias outras classes da aplicação.
 *
 * @package App\Util
 */
class Utils
{
    /**
     * Retorna o valor existente no array ($data) conforme o índice ($index).
     * Obs: Caso o índice não exista o retorno será 'nulo'.
     *
     * @param mixed $index
     * @param array $array
     * @param mixed $default
     *
     * @return mixed
     */
    public static function getValue($index, $array, $default = null)
    {
        return Arr::get($array, $index, $default);
    }

}
