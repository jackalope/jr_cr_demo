<?php
/**
 * File containing the inline literal handler
 *
 * @package Document
 * @version 1.1.2
 * @copyright Copyright (C) 2005-2009 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * Visit inline literals
 *
 * @package Document
 * @version 1.1.2
 */
class ezcDocumentDocbookToRstLiteralHandler extends ezcDocumentDocbookToRstBaseHandler
{
    /**
     * Handle a node
     *
     * Handle / transform a given node, and return the result of the
     * conversion.
     * 
     * @param ezcDocumentElementVisitorConverter $converter 
     * @param DOMElement $node 
     * @param mixed $root 
     * @return mixed
     */
    public function handle( ezcDocumentElementVisitorConverter $converter, DOMElement $node, $root )
    {
        $marker = '``';
        return $root . ' ' . $marker . $converter->visitChildren( $node, '' ) . $marker;
    }
}

?>
