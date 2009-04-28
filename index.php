<?php
define("JACK_PROJECT_DIR", dirname(__FILE__) . '/');
define("JACK_WEBROOT", "http://" . $_SERVER['HTTP_HOST'] . str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']));


include_once (JACK_PROJECT_DIR . "/inc/demoinit.php");

/* traditionally without dependency injection */
/*
$config = array('transport' => 'davex', 'url' => 'http://localhost:8080/server', 'workspace' => 'default', 'user' => 'admin', 'pass' => 'admin');
$session = demoinit::initAppAndGetSession($config);
*/

/* With dependency injection */
include_once (JACK_PROJECT_DIR . "/inc/demoinitWithDI.php");
$config = 'conf/config.xml';
$session = demoinitWithDI::initAppAndGetSession($config);

try {

    $wiki = new demowiki($session);

    if (isset($_SERVER['PATH_INFO'])) {
        $path = "/" . trim($_SERVER['PATH_INFO'], "/");
    } else {
        $path = "";
    }
    include (JACK_PROJECT_DIR . "tmpl/head.php");

    try {
        if (! isset($_GET['action'])) {
            print $wiki->viewAction($path);
        } else {
            $method = $_GET['action'] . "Action";
            if (method_exists($wiki, $method)) {
                print $wiki->$method($path);
            } else {
                print $wiki->viewAction($path);
            }

        }
    } catch (phpCR_PathNotFoundException $e) {
        $wiki->initPages($path);
        header("Location: " . JACK_WEBROOT . $path . '?action=edit');
    }

    include (JACK_PROJECT_DIR . "tmpl/foot.php");

} catch (Exception $e) {
    print "<pre>";
    var_dump($e);
}



