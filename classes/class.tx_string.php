<?php

/**
 * @author Taffarel Xavier <taffarel_deus@hotmail.com>
 */
class TX_String {

    /**
     * 
     * @param type $str
     * @param type $length
     * @param string $st
     * @return boolean
     */
    public static function replaceNome($str, $length = 2, $list_black = array(' da ', ' de ', ' das ', ' dos ', ' e ', ' DO ', ' do '), $st = '') {

        $exp = preg_split('/\s+/', trim($str));

        $string = str_ireplace($list_black, ' ', implode(' ', $exp));

        $count_word = str_word_count($string);

        switch ($count_word) {
            case 0:
                return false;
            case 1:
                return $string;
            case 2:
                $ex = explode(' ', $string);

                $length_word = (count($ex));

                if ($length > $length_word) {
                    $length = $length_word;
                }

                if ($length == 'TODO' || $length == 0 || $length == '' || $length == '0') {
                    for ($i = 0; $i < $length_word; ++$i) {
                        $st .= ' ' . $ex[$i];
                    }
                } else {
                    for ($i = 0; $i < $length; ++$i) {
                        $st .= ' ' . $ex[$i];
                    }
                }
                return trim($st);
            default:
                $ex = explode(' ', $string);

                $length_word = (count($ex));

                if ($length > $length_word) {
                    $length = $length_word;
                }

                if ($length == 'TODO' || $length == 0 || $length == '' || $length == '0') {
                    for ($i = 0; $i < $length_word; ++$i) {
                        $st .= ' ' . $ex[$i];
                    }
                } else {
                    for ($i = 0; $i < $length; ++$i) {
                        $st .= ' ' . $ex[$i];
                    }
                }
                return trim($st);
        }
    }

    public static function MontarLink($texto) {
        if (!is_string($texto))
            return $texto;

        $er = "/(https:\/\/(www\.|.*?\/)?|http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";

        $texto = preg_replace_callback($er, function($match) {
            $link = $match[0];

            //coloca o 'http://' caso o link não o possua
            $link = (stristr($link, "http") === false) ? "http://" . $link : $link;

            //troca "&" por "&", tornando o link válido pela W3C
            $link = str_replace("&", "&amp;", $link);

            return "<b><a href=\"" . strtolower($link) . "\" target=\"_blank\">" . ((strlen($link) > 60) ? substr($link, 0, 25) . "..." . substr($link, -15) : $link) . "</a></b>";
        }, $texto);

        return $texto;
    }

    public static function tranformar_em_links($text) {

        $text = ' ' . html_entity_decode($text);

        $link = '<i class=\'icon-external-link\'></i>';
        $class = 'link-external';
        // Full-formed links
        $text = preg_replace('#(((f|ht){1}tps?://)[-a-zA-Z0-9@:%_\+.~\#?&//=]+)#i', '<b>'
                . '<a class="' . $class . '" href="\\1" '
                . 'title="Clique para abrir" target=_blank>\\1' . $link . '</a></b>', $text);
        // Links without scheme prefix (i.e. http://)

        $text = preg_replace('#([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~\#?&//=]+)#i', '\\1<b>'
                . '<a class="' . $class . '" href="http://\\2" title="Clique para abrir"  '
                . 'target=_blank>\\2' . $link . '</a></b>', $text);

        // E-mail links (mailto)
        $text = preg_replace('#([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})#i', '<b>'
                . '<a class="' . $class . '" href="mailto:\\1"'
                . ' title="Clique para abrir" target=_blank>\\1' . $link . '</a></b>', $text);

        return $text;
    }

    public static function tranformar_em_links_antigo($text) {

        $text = ' ' . $text;

        $link = '<i class=\'icon-external-link\'></i>';
        $class = 'link-external';
        // Full-formed links
        $text = preg_replace('#(((f|ht){1}tps?://)[-a-zA-Z0-9@:%_\+.~\#?&//=]+)#i', '<b>'
                . '<a class="' . $class . '" href="\\1" '
                . 'title="Clique para abrir" target=_blank>\\1' . $link . '</a></b>', $text);
        // Links without scheme prefix (i.e. http://)

        $text = preg_replace('#([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~\#?&//=]+)#i', '\\1<b>'
                . '<a class="' . $class . '" href="http://\\2" title="Clique para abrir"  '
                . 'target=_blank>\\2' . $link . '</a></b>', $text);

        // E-mail links (mailto)
        $text = preg_replace('#([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})#i', '<b>'
                . '<a class="' . $class . '" href="mailto:\\1"'
                . ' title="Clique para abrir" target=_blank>\\1' . $link . '</a></b>', $text);

        return $text;
    }

    public static function link_it($string) {
        $string = preg_replace("~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~", "<a href=\"\\0\" style=\"color:#4485f6;\" title=\"Clique para abrir\"  target=\"_blank\" > \\0 </a>", $string);
        return $string;
    }

    /**
     *  //$str9 = preg_replace("/\#([\s\S]*)\#/mi", "<mark>$1</mark>", $string);
     * @param type $string
     * @return type
     */
    public static function replace_caracteres_especiais($string) {
        $str1 = preg_replace("/\*(.+?)\*/mi", "<b>$1</b>", $string);
        $str2 = preg_replace("/\_(.+?)\_/mi", "<i>$1</i>", $str1);
        $str3 = preg_replace("/\_\*(.+?)\*\_/mi", "<b><i>$1</i></b>", $str2);
        $str4 = preg_replace("/\~(.+?)\~/mi", "<strike>$1</strike>", $str3);
        $str5 = preg_replace("/\[(.*?)\]/mi", "<sup>$1</sup>", $str4);
        $str6 = preg_replace("/\@(.+?)\@/mi", "<sub>$1</sub>", $str5);
        $caracteres = array('&#34;', '&34;', '&#39;', '&39;');
        $replace = array('"', '"', '\'', '\'');
        $str7 = str_ireplace($caracteres, $replace, $str6);
        $str8 = preg_replace("/\#(.+?)\#/mi", "<mark>$1</mark>", $str7);
        $str9 = str_ireplace(array('\r\n', '\n', '\r'), '<br/>', $str8);
        return $str9;
    }

    public static function pub_replace_caracteres_especiais($string) {
        $string = preg_replace("/\*(.+?)\*/mi", "<b>$1</b>", $string);
        //$string = preg_replace("/\_(.+?)\_/mi", "<i>$1</i>", $string);
        $string = preg_replace("/\_\*(.+?)\*\_/mi", "<b><i>$1</i></b>", $string);
        $string = preg_replace("/\~(.+?)\~/mi", "<strike>$1</strike>", $string);
        $string = preg_replace("/\[(.*?)\]/mi", "<sup>$1</sup>", $string);
        $string = preg_replace("/\@(.+?)\@/mi", "<sub>$1</sub>", $string);
        $caracteres = array('&#34;', '&34;', '&#39;', '&39;');
        $replace = array('"', '"', '\'', '\'');
        $string = str_ireplace($caracteres, $replace, $string);
        $string = preg_replace("/\#(.+?)\#/mi", "<mark>$1</mark>", $string);
        $string = str_ireplace(array('\r\n', '\n', '\r'), '<br/>', $string);
        return $string;
    }

    /**
     * Retorna o tamanho de uma string
     * @param type $string
     * @return type
     */
    public static function tx_strlen($string) {
        mb_internal_encoding("UTF-8");
        return mb_strlen($string, mb_internal_encoding());
    }

    /**
     * 
     * @param string $str
     * @param type $l
     * @param type $e
     * @return string
     */
    public static function chunk_split_unicode($str, $l = 76, $e = "\r\n") {
        $tmp = array_chunk(
                preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $l);
        $str = '';
        foreach ($tmp as $t) {
            $str .= join("", $t) . $e;
        }
        return $str;
    }

    public static function substr_unicode($str, $s, $l = null) {
        $r = '/^.{' . (int) $s . '}(.';
        $r .= ($l === null) ? '*)$' : '{' . (int) $l . '})';
        $r .= '/su';
        preg_match($r, $str, $o);
        return $o[1];
    }

    /**
     * 
     * @param string $string
     * @param type $start
     * @param type $length
     * @return boolean|string
     */
    public static function substrex(&$string, $start, $length = PHP_INT_MAX) {
        if ($start > strlen($string)) {
            return false;
        }
        if (empty($length)) {
            return '';
        }
        if ($start < 0) {
            $start = max(0, $start + strlen($string));
        }
        $end = ($length < 0) ?
                strlen($string) + $length :
                min(strlen($string), $start + $length);
        if ($end < $start) {
            return false;
        }
        $length = $end - $start;
        $substr = substr($string, $start, $length);
        $string = substr($string, 0, $start) . substr($string, $end);
        return $substr;
    }

    public static function uniqidReal($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

    public static $texto = 'foo';

    /**
     * 
     * @param type $max_total_letras é o total de caracteres usados.
     * @return type
     */
    public static function cortarTexto($texto = "texto", $max_total_letras = 40) {
        self::$texto = $texto;

        if ($max_total_letras == "AUTO" || $max_total_letras == "ALL" || $max_total_letras == "TUDO") {
            return self::$texto;
        } else {
            if (self::count_letras() >= $max_total_letras) {
                return substr(self::$texto, 0, $max_total_letras) . "...";
            } else {
                return substr(self::$texto, 0, $max_total_letras);
            }
        }
    }

    public static function count_letras() {
        return strlen(self::$texto);
    }

    public static function get_texto() {
        return self::$texto;
    }

    public static function str_word_count_utf8($str) {
        return count(preg_split('~[^\p{L}\p{N}\']+~u', $str));
    }

}
