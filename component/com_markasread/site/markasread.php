<?php
/**
 * TODO
 *
 * @package Markasread
 * @author B. van Wetten <bas@vanwetten.com>
 * @copyright 2021 BriteBlu
 * @license MIT https://opensource.org/licenses/MIT
 */

// No direct access to this file
defined('_JEXEC') or die;

JLoader::register('MarkAsReadHelperRoute', JPATH_SITE . '/components/com_markasread/helpers/route.php');

/** @var \Joomla\CMS\Application\CMSApplication $app */
$app = JFactory::getApplication();

// JInput object
$input = $app->input;

$controller = JControllerLegacy::getInstance('markasread');
$controller->execute($input->getCmd('task'), 'featured');
$controller->redirect();
