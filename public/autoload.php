<?php

require_once 'configuration/Database.php';

function loaderEntities($className){

    require_once 'controllers/' . $className . '.php';
}

spl_autoload_register('loaderEntities');