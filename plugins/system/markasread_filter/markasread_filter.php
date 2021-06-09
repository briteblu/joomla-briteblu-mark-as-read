<?php
/**
 * @version     $Id: markasread_filter.php 04-05-2021 B. van Wetten $
 * @package     Joomla.Plugin
 * @subpackage  System.markasread_filter
 *
 * @author      B. van Wetten <info@briteblu.com>
 * @copyright   2021 (c) BriteBlu.
 * @license     MIT; see LICENSE
 * @link        https://briteblu.com
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

/**
 * Plugin class
 *
 * @package   MarkAsRead
 * @since     0.0.1
 */
class PlgSystemMarkAsRead_Filter extends CMSPlugin
{

  const PLUGIN_NAME = 'markasread_filter';

  protected $app;
  protected $db;

  /**
   * Valid context where the plugin can be triggered
   *
   * @var  array
   */
  private static $validContexts = array(
    'com_content.article',
    'com_content.category'
  );

  /**
   * Affects constructor behavior. If true, language files will be loaded automatically.
   *
   * @var    boolean
   * @since  1.0.0
   */
  protected $autoloadLanguage = true;

  /**
   * Constructor.
   *
   * @param   object  &$subject  The object to observe
   * @param   array   $config    An optional associative array of configuration settings.
   *
   * @since   3.7.0
   */
  public function __construct(&$subject, $config)
  {
    parent::__construct($subject, $config);
  }

  /**
   * Check if the plugin has to be triggered in the current context
   *
   * @param   string  $context  Plugin context
   *
   * @return  boolean
   */
  private function validateContext($context)
  {
    return in_array($context, self::$validContexts, true);
  }

  public function onContentPrepare($context, &$item, &$params, $page)
	{
    // Ensure frontend application
		if (!$this->app->isClient('site'))
		{
			return true;
		}

    // Validate context
    if (!$this->validateContext($context))
    {
      return true;
    }

    $customFields = [];
    switch ($context)
		{
			case 'com_content.categories':
				$isCategory = true;
				break;
			case 'com_content.category':
			case 'com_content.featured':
			case 'com_content.archive':
			case 'com_content.article':
			case 'com_content.articles':
				$customFields = FieldsHelper::getFields('com_content.article', $item, false);
				break;
			default:
				break;
		}

    return true;
	}
}
