<?php

class demowiki {

    /**
     * Enter description here...
     *
     * @var phpCR_Session
     */
    protected $session = null;

    /**
     *
     */
    function __construct($config) {
        $this->session = $this->getJRsession($config);
    }

    static function initApp() {
        ini_set("include_path", JACK_PROJECT_DIR . "/inc/:" . ini_get("include_path"));
        spl_autoload_register(array('demowiki', 'autoload'));
        include_once ("ezc/Base/base.php");
        spl_autoload_register(array("ezcBase", "autoload"));
    }

    public function viewAction($path) {

        $doc = $this->getSource($path);
        $document = new ezcDocumentConfluenceWiki();
        $document->options->errorReporting = E_PARSE | E_ERROR | E_WARNING;
        $document->loadString($doc);

        $docbook = $document->getAsDocbook();
        $converter = new ezcDocumentDocbookToHtmlConverter();
        $converter->options->styleSheet = null;

        // Add custom CSS style sheets
        $converter->options->styleSheets = array('/styles/screen.css');
        $html = $converter->convert($docbook);
        $xml = $html->save();
        $doc = new DOMDocument();
        $doc->loadXML($xml);

        $xp = new DOMXPath($doc);
        $xp->registerNamespace("xhtml", "http://www.w3.org/1999/xhtml");
        $res = $xp->query("/xhtml:html/xhtml:body/node()");
        $html = "";
        foreach ($res as $node) {
            $html .= $doc->saveXML($node);
        }
        return $html;

    }

    public function editAction($path) {
        if (isset($_POST['content'])) {
            $n = $this->getNode($path);
            $n->setProperty("jcr:data", $_POST['content'], phpCR_PropertyType::STRING);
        }
        $doc = $this->getSource($path);
        $html = "<h2>Edit $path </h2>";
        $html .= '<form method="post">';
        $html .= "<textarea name='content' cols='80' rows='40'>";
        $html .= $doc;
        $html .= "</textarea><br/>";
        $html .= '<input type="submit"/>';
        $html .= '</form>';
        return $html;
    }

    protected function getSource($path) {
        $n = $this->getNode($path);
        return $n->getProperty("jcr:data")->getString();

    }

    /**
     * Enter description here...
     *
     * @param string $path
     * @return phpCR_Node
     */
    protected function getNode($path) {
        $rn = $this->session->getRootNode();

        return $rn->getNode("wiki$path/index.txt/jcr:content");

    }
    /**
     * Enter description here...
     *
     * @param unknown_type $config
     * @return phpCR_Session
     */
    function getJRSession($config) {
        if (empty($config['url'])) {
            return false;
        }
        if (empty($config['workspace'])) {
            $config['workspace'] = "default";
        }

        $repository = jr_cr::lookup($config['url'], $config['transport']);
        if (isset($config['pass'])) {
            $credentials = new jr_cr_simplecredentials($config['user'], $config['pass']);
            return $repository->login($credentials, $config['workspace']);

        } else {
            return $repository->login(null, $config['workspace']);
        }
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