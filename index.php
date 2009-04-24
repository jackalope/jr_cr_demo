<?php
define("JACK_PROJECT_DIR", dirname(__FILE__) . '/');
include_once (JACK_PROJECT_DIR . "/inc/demowiki.php");
demowiki::initApp();

try {

    $config = array('transport' => 'davex', 'url' => 'http://localhost:8080/server', 'user' => 'admin', 'pass' => 'admin');
    $wiki = new demowiki($config);
    if (isset($_SERVER['PATH_INFO'])) {
        $path = "/".trim($_SERVER['PATH_INFO'],"/");
    } else {
        $path = "";
    }
 print    $wiki->view($path);

} catch (Exception $e) {
    print "<pre>";
    var_dump($e);
}



