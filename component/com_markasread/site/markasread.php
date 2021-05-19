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

/** @var \Joomla\CMS\Application\CMSApplication $app */
$app = JFactory::getApplication();
$app->allowCache(false);

// Prevent the api url from being indexed
$app->setHeader('X-Robots-Tag', 'noindex, nofollow');

// JInput object
$input = $app->input;
$user  = JFactory::getUser();

if ($user->guest === 1 || $user->id === 0)
{
	throw new RuntimeException(JText::sprintf('COM_MARKASREAD_USERNOTLOGGEDIN'), 500);
}

JLoader::register('MarkAsReadHelperRoute', JPATH_SITE . '/components/com_markasread/helpers/route.php');

$controller = JControllerLegacy::getInstance('markasread');

$controller->execute($input->getCmd('task'));
