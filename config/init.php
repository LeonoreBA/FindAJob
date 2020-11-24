<?php

    // Session
    session_start();


    // Fichier config
    require_once 'config.php';

    // Include helpers
    require_once 'helpers/system_helper.php';

    // enlever erreur autoload
    

    //Autoloader
    function __autoload($class_name) {
        error_reporting(E_ALL ^ E_DEPRECATED);
        require_once 'lib/'.$class_name.'.php';
    }
?>  