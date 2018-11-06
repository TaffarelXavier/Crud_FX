<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TX_Dates {

    public static function get_exemplo_from_timespam($unixtime) {
        var_dump(date('d/m/Y H:i:s', $unixtime));
    }

    public static function get_timestamp($string) {
        var_dump($string);
    }

    /**
     * 
     * @param type $unixtime
     * @return type
     */
    public static function get_date_from_unixtime($unixtime) {
        return date('d/m/Y \à\s H:i:s', $unixtime);
    }

    /**
     * 
     * @param string $string O Formato da data
     * @example  12/28/2016 13:02:59, o qual 12=mes; 28=dia; 2016=ano; 
     */
    public static function get_timestamp_from_string($string) {
        return strtotime($string);
    }

    /**
     * <p>Formata uma data de acordo com o timestamp</p>
     * @param int $timestamp 
     * @return string
     */
    public static function get_date($timestamp) {
        $dia = date('d', $timestamp);
        $mes = date('n', $timestamp);
        $hora = date('H:i', $timestamp);
        $ano = date('Y', $timestamp);
        $mes_ext = array(0, 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        return $dia . ' de ' . $mes_ext[$mes] . ' de ' . $ano . ' às ' . $hora;
    }

    /**
     * 
     * 
     * @param type $nome $array_dados['alu_nome']
     * @param type $tamanho_nome O número de palavras para ser exibido.
     */
    public static function mostrar_cumprimentos($nome, $tamanho_nome = 2) {
        $hr = date("H");
        if ($hr >= 12 && $hr < 18) {
            $resp = "Boa tarde, ";
        } else if ($hr >= 0 && $hr < 12) {
            $resp = "Bom dia, ";
        } else {
            $resp = "Boa noite, ";
        }
        return  $resp.TX_String::replaceNome($nome, $tamanho_nome);
    }

}
