<?php

class demowiki {

    /**
     * @var phpCR_Session
     */
    protected $session = null;

    /**
     *
     */
    function __construct(phpCR_Session $session) {
        $this->session = $session;
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
        $html .= '<div id="action"><a href="?action=edit" accesskey="e">Edit</a></div>';
        return $html;
    }

    public function editAction($path) {
        if (isset($_POST['content'])) {
            $n = $this->getNode($path);
            $n->setProperty("jcr:data", $_POST['content'], phpCR_PropertyType::BINARY);
            $this->session->save();
            header('Location: ' . JACK_WEBROOT . $path . '');
            die();
        } else {
            $doc = $this->getSource($path);
            $html = "<h2>Edit $path </h2>";
            $html .= '<form method="post">';
            $html .= "<textarea name='content' cols='80' rows='40'>";
            $html .= $doc;
            $html .= "</textarea><br/>";
            $html .= '<input type="submit" accesskey="s"/>';
            $html .= '</form>';
        }
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

    static function autoload($class) {

        $incFile = str_replace("_", DIRECTORY_SEPARATOR, $class) . ".php";
        if (@fopen($incFile, "r", TRUE)) {
            include ($incFile);
            return $incFile;
        }
        return FALSE;
    }

    public function initPages($path = '') {
        $rn = $this->session->getRootNode();
        try {
            $n = $rn->getNode("wiki/index.txt");
        } catch (phpCR_PathNotFoundException $e) {
            $w = $rn->addNode("wiki", "nt:folder");
        }
        if ($path == '') {
            $path = '/';
        }
        $this->addPage($path, "h1. Placeholder for $path\n Here comes some content");
        return true;

    }

    protected function addPage($path, $content) {
        $rn = $this->session->getRootNode();
        //$w = $rn->getNode("wiki");
        $w = $rn->addNode("wiki" . $path, "nt:folder");
        $f = $w->addNode("index.txt", "nt:file");
        $c = $f->addNode("jcr:content", "nt:unstructured");
        $c->setProperty("jcr:data", $content, phpCR_PropertyType::BINARY);
        $this->session->save();
    }
}

