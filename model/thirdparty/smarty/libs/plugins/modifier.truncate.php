<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';
 
 	$string = str_replace("&atilde;","�",$string);
 	$string = str_replace("&Atilde;","�",$string);
 	$string = str_replace("&otilde;","�",$string);
 	$string = str_replace("&Otilde;","�",$string);
 	$string = str_replace("&aacute;","�",$string);
 	$string = str_replace("&Aacute;","�",$string);
 	$string = str_replace("&eacute;","�",$string);
 	$string = str_replace("&Eacute;","�",$string);
 	$string = str_replace("&iacute;","�",$string);
 	$string = str_replace("&Iacute;","�",$string);
 	$string = str_replace("&oacute;","�",$string);
 	$string = str_replace("&Oacute;","�",$string);
 	$string = str_replace("&uacute;","�",$string);
 	$string = str_replace("&Uacute;","�",$string);
 	$string = str_replace("&acirc;","�",$string);
 	$string = str_replace("&Acirc;","�",$string);
 	$string = str_replace("&ecirc;","�",$string);
 	$string = str_replace("&Ecirc;","�",$string);
 	$string = str_replace("&ocirc;","�",$string);
 	$string = str_replace("&Ocirc;","�",$string);

 	$string = str_replace("&ccedil;","�",$string);
 	$string = str_replace("&Ccedil;","�",$string);

    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
        }
        if(!$middle) {
            return substr($string, 0, $length) . $etc;
        } else {
            return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
        }
    } else {
        return $string;
    }
}

/* vim: set expandtab: */

?>
