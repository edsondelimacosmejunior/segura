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
 * Name:     mb_truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 *           This version also supports multibyte strings.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Guy Rutenberg <guyrutenberg@gmail.com> based on the original 
 *           truncate by Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_mb_truncate($string, $length = 80, $etc = '...', $charset='UTF-8',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';
 
 	$string = str_replace("&atilde;","ã",$string);
 	$string = str_replace("&Atilde;","Ã",$string);
 	$string = str_replace("&otilde;","õ",$string);
 	$string = str_replace("&Otilde;","Õ",$string);
 	$string = str_replace("&aacute;","á",$string);
 	$string = str_replace("&Aacute;","Á",$string);
 	$string = str_replace("&eacute;","é",$string);
 	$string = str_replace("&Eacute;","É",$string);
 	$string = str_replace("&iacute;","í",$string);
 	$string = str_replace("&Iacute;","Í",$string);
 	$string = str_replace("&oacute;","ó",$string);
 	$string = str_replace("&Oacute;","Ó",$string);
 	$string = str_replace("&uacute;","ú",$string);
 	$string = str_replace("&Uacute;","Ú",$string);
 	$string = str_replace("&acirc;","â",$string);
 	$string = str_replace("&Acirc;","Â",$string);
 	$string = str_replace("&ecirc;","ê",$string);
 	$string = str_replace("&Ecirc;","Ê",$string);
 	$string = str_replace("&ocirc;","ô",$string);
 	$string = str_replace("&Ocirc;","Ô",$string);

 	$string = str_replace("&ccedil;","ç",$string);
 	$string = str_replace("&Ccedil;","Ç",$string);
	
 
    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length+1, $charset));
        }
        if(!$middle) {
            return mb_substr($string, 0, $length, $charset) . $etc;
        } else {
            return mb_substr($string, 0, $length/2, $charset) . $etc . mb_substr($string, -$length/2, $charset);
        }
    } else {
        return $string;
    }
}
 
/* vim: set expandtab: */
?>