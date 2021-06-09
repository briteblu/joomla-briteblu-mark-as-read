<?php
/**
 * TODO
 *
 * @package Markasread
 * @author B. van Wetten <bas@vanwetten.com>
 * @copyright 2021 BriteBlu
 * @license MIT https://opensource.org/licenses/MIT
 */

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller;

/**
 * TODO
 *
 * @package Markasread
 * @since v0.0.1
 */
class MarkasreadController extends JControllerLegacy
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 * Recognized key values include 'name', 'default_task', 'model_path', and
	 * 'view_path' (this list is not meant to be comprehensive).
	 *
	 * @since v0.0.1
	 */
	public function __construct($config = array())
	{
		// Get a handle to the Joomla! application object
		$this->app = JFactory::getApplication();

		$this->input = $this->app->input;

		parent::__construct($config);
	}

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   boolean  $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController  This object to support chaining.
	 *
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$cachable = true;

		/**
		 * Set the default view name and format from the Request.
		 * Note we are using a_id to avoid collisions with the router and the return page.
		 * Frontend is a bit messier than the backend.
		 */
		$vName = $this->input->getCmd('view', 'articles');
		$this->input->set('view', $vName);

		parent::display($cachable, null);

		return $this;
	}

	/**
	 * TODO
	 *
	 * @return 	boolean
	 */
	public function read()
	{
		// Check for request forgeries.
		$this->checkToken();

		// Prevent the api url from being indexed
		$this->app->allowCache(false);
		$this->app->setHeader('X-Robots-Tag', 'noindex, nofollow');

		// Perform the Request task
		$input = $this->app->input;
		$user  = JFactory::getUser();
		$url = $input->getString('url', '');
		$articleId = $input->getInt('article', null);

		if ($user->guest === 1 || $user->id === 0)
		{
			echo new JResponseJson(JText::sprintf('COM_MARKASREAD_USERNOTLOGGEDIN'), null, true);
			// throw new RuntimeException(JText::sprintf('COM_MARKASREAD_USERNOTLOGGEDIN'), 500);
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->insert($db->quoteName('#__markasread'))
			->columns(array($db->quoteName('content_id'), $db->quoteName('user_id')))
			->values(implode(',', array((int) $articleId, (int) $user->id)));

		// Set the query and execute the insert.
		// If the record exists, just update the `modified` field
		$db->setQuery($query . " ON DUPLICATE KEY UPDATE `modified`=NOW()");

		try
		{
			$result = $db->execute();
			echo new JResponseJson([ 'result' => $result, 'read' => true ]);
		}
		catch (Exception $e)
		{
			echo new JResponseJson($e, null, true);

			return false;
		}
	}

	/**
	 * TODO
	 *
	 * @return 	boolean
	 */
	public function unread()
	{
		// Check for request forgeries.
		$this->checkToken();

		// Prevent the api url from being indexed
		$this->app->allowCache(false);
		$this->app->setHeader('X-Robots-Tag', 'noindex, nofollow');

		// Perform the Request task
		$user  = JFactory::getUser();
		$input = $this->app->input;
		$url = $input->getString('url', '');
		$articleId = $input->getInt('article', null);

		if ($user->guest === 1 || $user->id === 0)
		{
			echo new JResponseJson(JText::sprintf('COM_MARKASREAD_USERNOTLOGGEDIN'), null, true);
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Prepare conditions for DELETE query
		$conditions = array(
			$db->quoteName('content_id') . ' = ' . (int) $articleId,
			$db->quoteName('user_id') . ' = ' . (int) $user->id
		);

		$query->delete($db->quoteName('#__markasread'));
		$query->where($conditions);

		// Set the query and execute the insert.
		$db->setQuery($query);

		try
		{
			$result = $db->execute();
			echo new JResponseJson([ 'result' => $result, 'read' => false ]);
		}
		catch (Exception $e)
		{
			echo new JResponseJson($e, null, true);

			return false;
		}
	}
}
