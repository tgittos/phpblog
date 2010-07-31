<?php

class TalesExtensions implements PHPTAL_Tales
{
    public static function date($src, $nothrow)
 	{
 	    return 'date("d/m/Y", strtotime(' . phptal_tales($src, $nothrow) . '))';
 	}
}

?>
