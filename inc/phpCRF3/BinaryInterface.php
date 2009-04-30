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
 * @version $Id: BinaryInterface.php 1811 2009-01-28 12:04:49Z robert $
 */

/**
 * The Binary interface allows repositories to provide implementations that
 * handle JCR BINARY values in the most efficient manner, given the specifics
 * of their internal handling of the binary data.
 *
 * @package PHPCR
 * @version $Id: BinaryInterface.php 1811 2009-01-28 12:04:49Z robert $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
interface phpCR_BinaryInterface {

	/**
	 * Returns a stream representation of this value.
	 * Each call to <code>getStream()</code> returns a new stream.
	 * The API consumer is responsible for calling <code>close()</code>
	 * on the returned stream.
	 *
	 * @return resource A stream representation of this value.
	 * @throws phpCR_RepositoryException if another error occurs.
	 */
	public function getStream();

	/**
	 * Reads successive bytes from the specified position in this Binary into
	 * the passed string until the end of the Binary is encountered.
	 *
	 * @param string $bytes the buffer into which the data is read.
	 * @param integer $position the position in this Binary from which to start reading bytes.
	 * @return integer the number of bytes read into the buffer
	 * @throws \RuntimeException if an I/O error occurs.
	 * @throws \InvalidArgumentException if offset is negative.
	 * @throws phpCR_RepositoryException if another error occurs.
	 */
	public function read(&$bytes, $position);

	/**
	 * Returns the size of this Binary value in bytes.
	 *
	 * @return integer the size of this value in bytes.
	 * @throws phpCR_RepositoryException if another error occurs.
	 */
	public function getSize();

}

?>