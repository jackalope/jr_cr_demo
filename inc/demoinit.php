<?php

class demoinit {

    static function initApp() {

        ini_set("include_path", JACK_PROJECT_DIR . "/inc/:" . JACK_PROJECT_DIR . "/vendor/:" . ini_get("include_path"));
        include_once("demowiki.php");
        spl_autoload_register(array('demowiki', 'autoload'));

        include_once ("ezc/Base/base.php");
        spl_autoload_register(array("ezcBase", "autoload"));

    }


   static function initAppAndGetSession($conf) {
        self::initApp();
        return self::getSession($conf);
   }

    static function getSession($config) {
        if (empty($config['url'])) {
            return false;
        }
        if (empty($config['workspace'])) {
            $config['workspace'] = "default";
        }

        $repository = jr_cr::lookup($config['url'], $config['transport']);
        if (isset($config['user'])) {
            $credentials = new jr_cr_simplecredentials($config['user'], $config['pass']);
            return $repository->login($credentials, $config['workspace']);

        } else {
            return $repository->login(null, $config['workspace']);
        }
    }
}
