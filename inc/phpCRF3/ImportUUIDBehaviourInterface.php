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
 * @version $Id: ImportUUIDBehaviourInterface.php 1811 2009-01-28 12:04:49Z robert $
 */

/**
 * The possible actions specified by the uuidBehavior parameter in
 * Workspace->importXML(), Session->importXML(),
 * Workspace->getImportContentHandler() and
 * Session->getImportContentHandler().
 * *
 * @package PHPCR
 * @version $Id: ImportUUIDBehaviourInterface.php 1811 2009-01-28 12:04:49Z robert $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
interface ImportUUIDBehaviourInterface {

	/**
	 * The supported behaviors.
	 */
	const IMPORT_UUID_COLLISION_REMOVE_EXISTING = 1;
	const IMPORT_UUID_COLLISION_REPLACE_EXISTING = 2;
	const IMPORT_UUID_COLLISION_THROW = 3;
	const IMPORT_UUID_CREATE_NEW = 0;

}

?>