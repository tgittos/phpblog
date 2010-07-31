<?php

/**
* Blog installer
*/

/**
* Generate models
*/
require_once 'Doctrine/Doctrine.php';
spl_autoload_register(array('Doctrine', 'autoload'));

echo "Generating models... ";
$yaml = "core/yaml/";
$models = "core/models/";
$classes = array('User', 'Post', 'Comment', 'Role', 'Category', 'RoleUser', 'CategoryPost');
foreach($classes as $class)
{
    Doctrine::generateModelsFromYaml($yaml . strtolower($class) . '.yml', $models);
}
echo "done <br />";

/**
* Generate database tables
*/
echo "Generating tables... ";
Doctrine_Manager::connection('mysql://root:@localhost/blog');
Doctrine::createTablesFromArray($classes);
echo "done <br />";
?>