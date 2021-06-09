<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// JLoader::register('ContentModelArticles', JPATH_ROOT . '/components/com_content/models/articles.php');
JLoader::register('ContentModelArticles', '/var/www/html/components/com_content/models/articles.php');

class MarkAsReadModelArticles extends ContentModelArticles
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JControllerLegacy
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}
}
