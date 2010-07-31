<?php

/**
* Blog installer
*/

require_once "../config.php";

/**
* Generate models
*/
require_once ROOT_PATH . '/Doctrine/Doctrine.php';
spl_autoload_register(array('Doctrine', 'autoload'));

echo "Generating models... ";

//Generate base models
$yaml = ROOT_PATH . "/install/schema";
$models = ROOT_PATH . "/core/models";
$installModels = ROOT_PATH . "/install/models";
$installData = ROOT_PATH . "/install/data";
$classes = array('User', 'Post', 'Comment', 'Role', 'Category', 'RoleUser', 'CategoryPost', 'Session');
Doctrine::generateModelsFromYaml($yaml, $models);
echo "done <br />";

/**
* Generate database tables
*/
echo "Generating tables... ";
Doctrine_Manager::connection(DB_SERVER . '://' . DB_USER . ':' . DB_PASSWORD . '@' . DB_HOST . '/' . DB_NAME);
Doctrine::createTablesFromArray($classes);
echo "done <br />";

/**
* Instal real models over empty dummy models
*/
echo "Installing models... ";
//Delete empty base models
$handle = opendir($models);
while (false != ($file = readdir($handle)))
{
    if ($file != "." && $file != ".." && !is_dir("$models/$file"))
        unlink("$models/$file");
}
//Copy over real models
if (is_dir($installModels))
{
    if ($handle = opendir($installModels)) 
    {
        while (false !== ($file = readdir($handle))) 
        {
            if ($file != "." && $file != "..")
                if (!copy("$installModels/$file", "$models/$file")) 
                    echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;Failed to install $file...<br />";
        }
        closedir($handle);
    }
    else
        throw new Exception("Cannot open model directory $installModels");
}
else
    throw new Exception("Missing install models, looking in $installModels");
echo "done <br />";

/**
 * Loading data
 */
 echo "Populating database... ";
 $data = new Doctrine_Data();
 $data->importData($installData, 'yml');
 echo "done <br />";
?>