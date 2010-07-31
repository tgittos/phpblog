<?php
/**
 * Configuration file
 */

/**
* Constants
*/
define ("VERSION", "1.0");
 
 /**
 * Paths
 */
 define ("ROOT_URL", "http://www.example.com/");
 define ("ROOT_PATH", "/home/example/public_html");
 define ("INCLUDE_PATHS",   ROOT_PATH . "/" . "core," . 
                            //ROOT_PATH . "/" . "core/models," .
                            //ROOT_PATH . "/" . "core/models/generated," .
                            ROOT_PATH . "/" . "core/admin/commands");
 
 /**
 * Database
 */
 define ("DB_SERVER", "mysql");
 define ("DB_HOST", "localhost");
 define ("DB_USER", "root");
 define ("DB_PASSWORD", "");
 define ("DB_NAME", "phpblog");
 
?>
