<?php
/**
 * File containing the ezcDocumentWikiBlockquoteNode struct
 *
 * @package Document
 * @version 1.1.2
 * @copyright Copyright (C) 2005-2009 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * Struct for Wiki document abstract syntax tree blockquote nodes
 * 
 * @package Document
 * @version 1.1.2
 */
class ezcDocumentWikiBlockquoteNode extends ezcDocumentWikiLineLevelNode
{
    /**
     * Blockquote indentation level
     * 
     * @var int
     */
    public $level = 1;

    /**
     * Construct Wiki node
     * 
     * @param ezcDocumentWikiToken $token
     * @param int $type 
     * @return void
     */
    public function __construct( ezcDocumentWikiToken $token )
    {
        parent::__construct( $token );

        if ( $token instanceof ezcDocumentWikiParagraphIndentationToken )
        {
            $this->level = $token->level;
        }
    }

    /**
     * Set state after var_export
     * 
     * @param array $properties 
     * @return void
     * @ignore
     */
    public static function __set_state( $properties )
    {
        $nodeClass = __CLASS__;
        $node = new $nodeClass( $properties['token'] );
        $node->nodes = $properties['nodes'];
        return $node;
    }
}

?>
