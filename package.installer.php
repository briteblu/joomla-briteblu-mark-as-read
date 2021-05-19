<?php
/**
 * @version     $Id: package.installer.php 04-05-2021 B. van Wetten $
 *
 * @author      B. van Wetten <info@briteblu.com>
 * @copyright   2021 (c) BriteBlu.
 * @license     MIT; see LICENSE
 * @link        https://briteblu.com
 */
defined('_JEXEC') or die;

/**
 * Installer script file.
 *
 * @package   markasread
 * @since     0.0.3
 */
class pkg_markasreadInstallerScript {

	public function update($parent) { }

	public function install($parent) { }

	public function uninstall($parent) { }

	public function preflight($type, $parent) { }

	public function postflight($type, $parent)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->update('#__extensions')
					->set('enabled=1')
					->where('element=' . $db->quote('markasread'))
					->where('type=' . $db->quote('plugin'))
					->where('folder=' . $db->quote('content'));
			$db->setQuery($query)->execute();
	}

	public function uninstallLanguage($tag, $name) { }
}
