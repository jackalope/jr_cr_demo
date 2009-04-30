<?php
declare(ENCODING = 'utf-8');






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
 * @version $Id: NodeIteratorInterface.php 1811 2009-01-28 12:04:49Z robert $
 */

/**
 * Allows easy iteration through a list of Nodes with nextNode as well as a skip method
 * inherited from RangeIterator.
 *
 * @package PHPCR
 * @version $Id: NodeIteratorInterface.php 1811 2009-01-28 12:04:49Z robert $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
interface phpCR_NodeIteratorInterface extends phpCR_RangeIteratorInterface {

	/**
	 * Returns the next Node in the iteration.
	 *
	 * @return phpCR_NodeInterface
	 * @throws OutOfBoundsException if the iterator contains no more elements.
	 */
	public function nextNode();

}

?>