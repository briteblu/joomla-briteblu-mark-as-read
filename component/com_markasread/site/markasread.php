<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_markasread
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

// Perform the Request task
$input = JFactory::getApplication()->input;
$user  = JFactory::getUser();

if($user->guest === 1){
  throw new RuntimeException(JText::sprintf('COM_MARKASREAD_USERNOTLOGGEDIN'), 500);
}

JLoader::register('MarkAsReadHelperRoute', JPATH_SITE . '/components/com_markasread/helpers/route.php');

// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('markasread');
$controller->registerDefaultTask('markread');

$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
