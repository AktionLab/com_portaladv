<?php
/**
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the com_portaladv helper library
require_once (JPATH_COMPONENT.DS.'constants.php');
require_once (JPATH_COMPONENT.DS.'controller.php');
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'idx.php');
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'layout.php');
require_once(JPATH_COMPONENT.DS.'sortFunctions.php');

// Create the controller
$controller = new PortalAdvController();

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
