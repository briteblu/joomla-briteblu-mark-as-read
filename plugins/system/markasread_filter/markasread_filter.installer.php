<?php
/**
 * @version     $Id: markasread_filter.installer.php 04-05-2021 B. van Wetten $
 * @package     Joomla.Plugin
 * @subpackage  System.markasread_filter
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
 * @since     0.0.1
 */
class PlgSystemMarkAsReadFilterInstallerScript
{
  /**
   * Constructor
   *
   * @param   JAdapterInstance  $adapter  The object responsible for running this script
   */
  public function __construct(JAdapterInstance $adapter) {}

  /**
   * Called before any type of action
   *
   * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
   * @param   JAdapterInstance  $adapter  The object responsible for running this script
   *
   * @return  boolean  True on success
   */
  public function preflight($route, JAdapterInstance $adapter) {}

  /**
   * Called after any type of action
   *
   * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
   * @param   JAdapterInstance  $adapter  The object responsible for running this script
   *
   * @return  boolean  True on success
   */
  public function postflight($route, JAdapterInstance $adapter) {}

  /**
   * Called on installation
   *
   * @param   JAdapterInstance  $adapter  The object responsible for running this script
   *
   * @return  boolean  True on success
   */
  public function install(JAdapterInstance $adapter) {}

  /**
   * Called on update
   *
   * @param   JAdapterInstance  $adapter  The object responsible for running this script
   *
   * @return  boolean  True on success
   */
  public function update(JAdapterInstance $adapter) {}

  /**
   * Called on uninstallation
   *
   * @param   JAdapterInstance  $adapter  The object responsible for running this script
   */
  public function uninstall(JAdapterInstance $adapter) {}
}
