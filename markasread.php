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

/**
 * Plugin class
 *
 * @package   MarkAsRead
 * @since     0.0.1
 */
class PlgContentMarkAsRead extends JPlugin
{
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

    // $this->votingPosition = $this->params->get('position', 'top');
  }

  /**
   * TODO: Description
   *
   * @param   string   $context  The context of the content being passed to the plugin
   * @param   object   &$row     The article object
   * @param   object   &$params  The article params
   * @param   integer  $page     The 'page' number
   *
   * @return  string|boolean  HTML string containing code if in com_content else boolean false
   *
   * @since   1.6
   */
  public function onContentBeforeDisplay($context, &$row, &$params, $page = 0)
  {
    return $this->displayMarkAsRead($context, $row, $params, $page);
  }

  /**
   * TODO: Description
   *
   * @param   string   $context  The context of the content being passed to the plugin
   * @param   object   &$row     The article object
   * @param   object   &$params  The article params
   * @param   integer  $page     The 'page' number
   *
   * @return  string|boolean  HTML string containing code if in com_content else boolean false
   *
   * @since   3.7.0
   */
  public function onContentAfterDisplay($context, &$row, &$params, $page = 0)
  {
    return false;
  }
  
  /**
   * TODO: Description
   *
   * @param   string   $context  The context of the content being passed to the plugin.
   * @param   mixed    &$row     An object with a "text" property or the string to be cloaked.
   * @param   mixed    &$params  Additional parameters. See {@see PlgContentEmailcloak()}.
   * @param   integer  $page     Optional page number. Unused. Defaults to zero.
   *
   * @return  boolean	True on success.
   */
  public function onContentPrepare($context, &$article, &$params, $page = 0)
  {
    // Don't run this plugin when the content is being indexed
    if ($context === 'com_finder.indexer')
    {
      return true;
    }

    $user = Factory::getUser();

    $hasBeenRead = $this->_hasBeenRead($params, $article->id, $user->id);
    if ($hasBeenRead) {
      JFactory::getApplication()->enqueueMessage('Article has already been read');
    } else {
      JFactory::getApplication()->enqueueMessage('Article has not yet been read');
    }
    

    // if (is_object($article))
    // {
    //   return $this->modifyContent($article->text, $params);
    // }

    // return $this->modifyContent($article, $params);
  }

  /**
   * Display mark as read toggle
   *
   * @param   string   $context  The context of the content being passed to the plugin
   * @param   object   &$row     The article object
   * @param   object   &$params  The article params
   * @param   integer  $page     The 'page' number
   *
   * @return  string|boolean  HTML string containing code for the mark as read toggle if in com_content else boolean false
   *
   * @since   3.7.0
   */
  private function displayMarkAsRead($context, &$row, &$params, $page)
  {
    JFactory::getApplication()->enqueueMessage($context);
    $parts = explode('.', $context);

    if ($parts[0] !== 'com_content' || $parts[1] !== 'article')
    {
      return false;
    }
    return '';

    // // Load plugin language files only when needed (ex: they are not needed if show_vote is not active).
    // $this->loadLanguage();

    // // Get the path for the rating summary layout file
    // $path = JPluginHelper::getLayoutPath('content', 'vote', 'rating');

    // // Render the layout
    // ob_start();
    // include $path;
    // $html = ob_get_clean();

    // if ($this->app->input->getString('view', '') === 'article' && $row->state == 1)
    // {
    //   // Get the path for the voting form layout file
    //   $path = JPluginHelper::getLayoutPath('content', 'vote', 'vote');

    //   // Render the layout
    //   ob_start();
    //   include $path;
    //   $html .= ob_get_clean();
    // }

    // return $html;
  }

  private static function _hasBeenRead(&$params, $article_id, $user_id)
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
}
