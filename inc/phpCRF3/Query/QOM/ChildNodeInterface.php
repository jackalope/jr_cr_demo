<?php
declare(ENCODING = 'utf-8');
namespace F3\PHPCR\Query\QOM;

/*                                                                        *
 * This script belongs to the FLOW3 package "PHPCR".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * @package PHPCR
 * @subpackage Query
 * @version $Id: ChildNodeInterface.php 1979 2009-03-09 15:44:15Z k-fish $
 */

/**
 * Tests whether the selector node is a child of a node reachable by absolute
 * path path.
 *
 * A node-tuple satisfies the constraint only if
 *  selectorNode.getParent().isSame(session.getNode(path))
 * would return true, where selectorNode is the node for the specified selector.
 *
 * @package PHPCR
 * @subpackage Query
 * @version $Id: ChildNodeInterface.php 1979 2009-03-09 15:44:15Z k-fish $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
interface ChildNodeInterface extends \F3\PHPCR\Query\QOM\ConstraintInterface {

	/**
	 * Gets the name of the selector against which to apply this constraint.
	 *
	 * @return string the selector name; non-null
	 */
	public function getSelectorName();

	/**
	 * Gets the absolute path.
	 *
	 * @return string the path; non-null
	 */
	public function getParentPath();

}

?>