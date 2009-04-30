<?php
declare(ENCODING = 'utf-8');
namespace F3\PHPCR;

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
 * @version $Id: ValueInterface.php 1811 2009-01-28 12:04:49Z robert $
 */

/**
 * A generic holder for the value of a property. A Value object can be used
 * without knowing the actual property type (STRING, DOUBLE, BINARY etc.).
 *
 * Any implementation of this interface must adhere to the following behavior:
 *
 * Two Value instances, v1 and v2, are considered equal if and only if:
 * * v1.getType() == v2.getType(), and,
 * * v1.getString().equals(v2.getString())
 *
 * Actually comparing two Value instances by converting them to string form may not
 * be practical in some cases (for example, if the values are very large binaries).
 * Consequently, the above is intended as a normative definition of Value equality
 * but not as a procedural test of equality. It is assumed that implementations
 * will have efficient means of determining equality that conform with the above
 * definition. An implementation is only required to support equality comparisons on
 * Value instances that were acquired from the same Session and whose contents have
 * not been read. The equality comparison must not change the state of the Value
 * instances even though the getString() method in the above definition implies a
 * state change.
 *
 * The deprecated getStream() method and it's related exceptions and rules have been
 * omitted in this PHP port of the API.
 *
 * @package PHPCR
 * @version  $Id: ValueInterface.php 1811 2009-01-28 12:04:49Z robert $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
interface ValueInterface {


	/**
	 * Returns a Binary representation of this value. The Binary object in turn provides
	 * methods to access the binary data itself. Uses the standard conversion to binary
	 * (see JCR specification).
	 *
	 * @return \F3\PHPCR\BinaryInterface A Binary representation of this value.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getBinary();

	/**
	 * Returns a string representation of this value.
	 *
	 * @return string A string representation of the value of this property.
	 * @throws \F3\PHPCR\ValueFormatException if conversion to a String is not possible.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getString();

	/**
	 * Returns a long representation of this value.
	 *
	 * @return string A long representation of the value of this property.
	 * @throws \F3\PHPCR\ValueFormatException if conversion to a long is not possible.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getLong();

	/**
	 * Returns a BigDecimal representation of this value.
	 *
	 * @return string A double representation of the value of this property.
	 * @throws \F3\PHPCR\ValueFormatException if conversion is not possible.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getDecimal();

	/**
	 * Returns a double representation of this value.
	 *
	 * @return string A double representation of the value of this property.
	 * @throws \F3\PHPCR\ValueFormatException if conversion to a double is not possible.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getDouble();

	/**
	 * Returns a \DateTime representation of this value.
	 *
	 * The object returned is a copy of the stored value, so changes to it are
	 * not reflected in internal storage.
	 *
	 * @return \DateTime A \DateTime representation of the value of this property.
	 * @throws \F3\PHPCR\ValueFormatException if conversion to a \DateTime is not possible.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getDate();

	/**
	 * Returns a boolean representation of this value.
	 *
	 * @return string A boolean representation of the value of this property.
	 * @throws \F3\PHPCR\ValueFormatException if conversion to a boolean is not possible.
	 * @throws \F3\PHPCR\RepositoryException if another error occurs.
	 */
	public function getBoolean();

	/**
	 * Returns the type of this Value. One of:
	 * * PropertyType.STRING
	 * * PropertyType.DATE
	 * * PropertyType.BINARY
	 * * PropertyType.DOUBLE
	 * * PropertyType.LONG
	 * * PropertyType.BOOLEAN
	 * * PropertyType.NAME
	 * * PropertyType.PATH
	 * * PropertyType.REFERENCE
	 * * PropertyType.WEAKREFERENCE
	 * * PropertyType.URI
	 *
	 * The type returned is that which was set at property creation.
	 * @return integer The type of the value
	 */
	public function getType();
}

?>