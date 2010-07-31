<?php

/**
 * Autoloader
 */
 
 class Autoload
 {
    private static $messages = array();
    
    public static function message()
    {
        return self::$messages;
    }
    
 	public static function load($c)
    {
        $paths = explode(',', INCLUDE_PATHS);
        foreach($paths as $path)
        {
            if (is_file("$path/$c.php"))
            {
                include_once "$path/$c.php";
                return;
            }
            else if (is_file($path . strtolower($c) . '.php'))
            {
                include_once $path . strtolower($c) . '.php';
                return;
            }
        }
        array_push(self::$messages, "Cannot find $c, looking in " . implode($paths, ','));
    }
            
    public static function register()
    {
    	spl_autoload_register("Autoload::load");
    }
 }

?>
