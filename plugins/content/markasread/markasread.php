<?php
/**
 * @version     $Id: markasread.php 04-05-2021 B. van Wetten $
 * @package     Joomla.Plugin
 * @subpackage  Content.markasread
 *
 * @author      B. van Wetten <info@briteblu.com>
 * @copyright   2021 (c) BriteBlu.
 * @license     MIT; see LICENSE
 * @link        https://briteblu.com
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

JLoader::register('MarkAsReadHelperRoute', JPATH_SITE . '/components/com_markasread/helpers/route.php');

/**
 * Plugin class
 *
 * @package   MarkAsRead
 * @since     0.0.1
 */
class PlgContentMarkAsRead extends JPlugin
{

  const PLUGIN_NAME = 'markasread';

  private $_params = null;

  // URLs
  private $_urlPlugin    = null;
  private $_urlPluginJs  = null;
  private $_urlPluginCss = null;

  /**
   * Valid context where the plugin can be triggered
   *
   * @var  array
   */
  private $validContexts = array(
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

    // Load plugin parameters
    $this->_plugin = JPluginHelper::getPlugin('content', self::PLUGIN_NAME);
    $this->_params = new JRegistry($this->_plugin->params);

    // Init folder structure
    $this->initFolders();

    // Add current user id to plugin parameters
    $this->_params->user = Factory::getUser();

    // Load jQuery
    JHtml::_('jquery.framework');

    // Load plugin css & scripts
    $document = Factory::getDocument();
    $document->addStyleSheet($this->_urlPluginCss . "/style.css", array('version'=>'auto'));
    $document->addScript($this->_urlPluginJs . "/script.js", array(), array());
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
    return in_array($context, $this->validContexts);
  }

  /**
   * Initialize folder structure
   *
   * @return void
   */
  private function initFolders()
  {
    // URLs
    $this->_urlPlugin    = JURI::root() . "plugins/content/" . self::PLUGIN_NAME;
    $this->_urlPluginJs  = $this->_urlPlugin . "/js";
    $this->_urlPluginCss = $this->_urlPlugin . "/css";
  }

  /**
   * Private helper method to determine if debugging mode is enabled for this plugin
   *
   * @return  boolean	True when debugging mode is enabled for plugin.
   */
  private function debug()
  {
    return $this->_params->get('debug', 'disabled') === 'enabled';
  }

  /**
   * Private helper method to determine if article has been read by a user
   *
   * @param   mixed    &$params       Additional parameters. See {@see PlgContentEmailcloak()}.
   * @param   integer  $article_id    Article ID
   * @param   integer  $user_id       User ID
   *
   * @return  boolean	True on when article has been read.
   */
  private static function hasBeenRead(&$params, $article_id, $user_id)
  {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('COUNT(*)');
    $query->from('#__markasread');
    $query->where($db->quoteName('content_id') . ' = '. (int)$article_id);
    $query->where($db->quoteName('user_id') . ' = ' . (int)$user_id);
    $db->setQuery($query);
    try
    {
      $count = $db->loadResult();
    }
    catch (RuntimeException $e)
    {
      JError::raiseError(500, $e->getMessage());
      return false;
    }
    return $count == 1;
  }

  /**
   * Helper method that modfies article content if required
   *
   * @param   object   &$article  An object with a "text" property or the string to be cloaked.
   * @param   mixed    &$params   Additional parameters. See {@see PlgContentEmailcloak()}.
   *
   * @return  mixed    true if there is an error. Void otherwise.
   */
  private function modifyContent(&$article, &$params)
  {
    return;
  }
  /**
   * Display mark as read toggle
   *
   * @param   string   $context   The context of the content being passed to the plugin
   * @param   object   &$article  The article object
   * @param   object   &$params   The article params
   * @param   integer  $page      The 'page' number
   *
   * @return  string|boolean  HTML string containing code for the mark as read toggle if in com_content else boolean false
   */
  private function displayMarkAsRead($context, &$article, &$params, $page)
  {
    // Get the path for the rating summary layout file
    $path = JPluginHelper::getLayoutPath('content', 'markasread', 'read');

    // Render the layout and wrap inside container div
    ob_start();
    include $path;
    $html = '<div id="joomla_plugin_content_markasread_container">' . ob_get_clean();

    return $html;
  }

  /**
   * TODO: Description
   *
   * @param   string   $context   The context of the content being passed to the plugin
   * @param   object   &$article  The article object
   * @param   object   &$params   The article params
   * @param   integer  $page      The 'page' number
   *
   * @return  string|boolean  HTML string containing code if valid context else boolean false
   */
  public function onContentBeforeDisplay($context, &$article, &$params, $page = 0)
  {
    // Don't run if there user is not logged in (i.e. guest)
    if ($this->_params->user->guest !== 0 || $this->_params->user->id === 0)
    {
      return;
    }

    // Validate context
    if (!$this->validateContext($context))
    {
      return false;
    }

    return $this->displayMarkAsRead($context, $article, $params, $page);
  }

  /**
   * TODO: Description
   *
   * @param   string   $context   The context of the content being passed to the plugin
   * @param   object   &$article  The article object
   * @param   object   &$params   The article params
   * @param   integer  $page      The 'page' number
   *
   * @return  string|boolean  HTML string containing code if valid context else boolean false
   */
  public function onContentAfterDisplay($context, &$article, &$params, $page = 0)
  {
    // Don't run if there user is not logged in (i.e. guest)
    if ($this->_params->user->guest !== 0 || $this->_params->user->id === 0)
    {
      return;
    }

    // Validate context
    if (!$this->validateContext($context))
    {
      return;
    }

    return '</div>';
  }
  
  /**
   * Plugin that loads module positions within content
   *
   * @param   string   $context   The context of the content being passed to the plugin.
   * @param   object   &$article  An object with a "text" property or the string to be cloaked.
   * @param   mixed    &$params   Additional parameters. See {@see PlgContentEmailcloak()}.
   * @param   integer  $page      Optional page number. Unused. Defaults to zero.
   *
   * @return  mixed    true if there is an error. Void otherwise.
   */
  public function onContentPrepare($context, &$article, &$params, $page = 0)
  {
    // Validate context
    if (!$this->validateContext($context))
    {
      return;
    }

    $this->hasBeenRead = self::hasBeenRead($params, $article->id, $this->_params->user->id);
    
    if ($this->debug()) {
      if ($this->hasBeenRead) {
        JFactory::getApplication()->enqueueMessage('DEBUG :: Article has been read');
      } else {
        JFactory::getApplication()->enqueueMessage('DEBUG :: Article has not been read');
      }
    }
    
    if (is_object($article))
    {
      return $this->modifyContent($article->text, $params);
    }

    return $this->modifyContent($article, $params);
  }
}
