<?php
	function smarty_modifier_utf8 ($string)
	{
		$utf = utf8_encode ($string);
		return $utf;
	}
?> 