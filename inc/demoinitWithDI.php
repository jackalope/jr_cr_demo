<?php

class demoinitWithDI extends demoinit {

    public static $sc = null;

    static function initApp() {
        parent::initApp();
        include_once ('sfService/sfServiceContainerAutoloader.php');
        sfServiceContainerAutoloader::register();

    }

   static function initAppAndGetSession($conf = 'config/conf.xml') {
        self::initApp();
        return self::getSession($conf);
   }

    static function getSession($conf = 'config/conf.xml') {
        $sc = self::getServiceContainer($conf);
        $repository = $sc->getService("jcr.repository");
        $workspace = $sc->getParameter("jcr.workspace");
        $user = $sc->getParameter("jcr.user");
        if ($user) {
            $credentials = $sc->getService("jcr.credentials");
        } else {
            $credentials = null;
        }
        return $repository->login($credentials, $workspace);
    }

    static function getServiceContainer($conf = 'config/conf.xml') {
        if (! self::$sc) {
            self::$sc = new sfServiceContainerBuilder();
            $loader = new sfServiceContainerLoaderFileXml(self::$sc);
            $loader->load(JACK_PROJECT_DIR . $conf);
        }
        return self::$sc;
    }
}
