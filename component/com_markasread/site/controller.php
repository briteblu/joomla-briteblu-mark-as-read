<?php

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller;

class MarkasreadController extends JControllerLegacy
{
  /**
   * Constructor.
   *
   * @param   array  $config  An optional associative array of configuration settings.
   * Recognized key values include 'name', 'default_task', 'model_path', and
   * 'view_path' (this list is not meant to be comprehensive).
   *
   * @since   3.0.1
   */
  public function __construct($config = array())
  {
    parent::__construct($config);
  }

  /**
   * TODO
   *
   * @return  void
   */
  public function read()
  {
    // Check for request forgeries.
    $this->checkToken();

    // Perform the Request task
    $input = JFactory::getApplication()->input;
    $user  = JFactory::getUser();
    $url = $this->input->getString('url', '');
    $article_id = $this->input->getInt('article', null);

    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->insert($db->quoteName('#__markasread'))
      ->columns(array($db->quoteName('content_id'), $db->quoteName('user_id')))
      ->values(implode(',', array((int) $article_id, (int) $user->id)));

      
      // Set the query and execute the insert.
    $db->setQuery($query);
    
    try
    {
      $db->execute();
    }
    catch (RuntimeException $e)
    {
      JError::raiseWarning(500, $e->getMessage());
      
      return false;
    }

    $this->setRedirect('http://localhost/index.php');
  }
}
