<?php
/*
 * Validador.php
 * Copyright (c) GRUPO/LPJ.
 *
 * Este software é confidencial e propriedade da GRUPO/LPJ.
 * Não é permitida sua distribuição ou divulgação do seu conteúdo sem expressa autorização da GRUPO/LPJ.
 * Este arquivo contém informações proprietárias.
 */

namespace App\Exceptions;

use Illuminate\Support\Facades\Validator;

/**
 * Classe de representação de mensagem de exceção do validator.
 *
 * @package App\Exceptions
 * @author Squadra Tecnologia
 */
class Validador
{
    const MESSAGES = [
        'required' => ":attribute: Campo obrigatório não informado.",
        'between' => ':attribute: Valor inválido',
        'numeric' => ':attribute: Valor inválido.',
        'max' => ':attribute: Deve ser igual ou menor a :max caracteres.',
        'digits_between' => ':attribute: Deve ser igual ou menor a :max caracteres.',
        'size' => ':attribute: Deve ser igual a :size caracteres.',
        'digits' => ':attribute: Deve ser igual a :digits caracteres.',
        'integer' => ':attribute: Valor inválido.',
        'in' => ':attribute: Valor inválido.',
        'alpha_num' => ':attribute: Valor inválido.',
        'string' => ':attribute: Valor inválido.',
        'regex' => ':attribute: Valor inválido.',
        'date_format' => ':attribute: Valor inválido.',
        'cnpj' => ':attribute: CNPJ Destinatário não cadastrado na tabela de Filial.',
        'numero_ocvm' => ':attribute: Número de OCM duplicado.',
        'codigo_produto' => ':attribute: Código Produto duplicado.',
    ];

    /**
     * Método responsável por validar as regras de negócio da requisição e retornar ao usuário caso falhe.
     *
     * @param $requisicao
     * @param $regras
     * @param null $mensagens
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validar($requisicao, $regras, $mensagens = null)
    {
        if (empty($mensagens)) {
            $mensagens = self::MESSAGES;
        }

        $validacao = Validator::make($requisicao, $regras, $mensagens);
        self::setAtributosCamelCase($validacao);

        return $validacao;
    }

    /**
     * Transforma os nomes para camelCase.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validacao
     */
    private static function setAtributosCamelCase(\Illuminate\Contracts\Validation\Validator $validacao): void
    {
        $nomesAtributos = [];
        foreach ((array)$validacao->getRules() as $attribute => $value) {
            $nomesAtributos[$attribute] = $attribute;
        }
        $validacao->setAttributeNames($nomesAtributos);
    }

    /**
     * Formata o retorno das mensagens de erro.
     *
     * @param $erros
     * @return array
     */
    public static function getMessagemErro($erros)
    {
        $errosRetorno = [];

        foreach ($erros as $erro) {
            array_push($errosRetorno, current($erro));
        }

        return $errosRetorno;
    }

}