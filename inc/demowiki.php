<?php

class demowiki {

    /**
     *
     */
    function __construct() {

    }

    static function initApp() {
        ini_set("include_path", JACK_PROJECT_DIR . "/inc/:" . ini_get("include_path"));

        spl_autoload_register(array('demowiki', 'autoload'));
    }

    static function autoload($class) {

            $incFile = str_replace("_", DIRECTORY_SEPARATOR, $class) . ".php";

            if (@fopen($incFile, "r", TRUE)) {
                include ($incFile);
                return $incFile;
            }

            return FALSE;

        }

}