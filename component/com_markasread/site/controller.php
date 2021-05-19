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
		$this->application = JFactory::getApplication();

		parent::__construct($config);
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

		// Perform the Request task
		$input = $this->application->input;
		$user  = JFactory::getUser();
		$url = $this->input->getString('url', '');
		$articleId = $this->input->getInt('article', null);

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

		// Perform the Request task
		$input = JFactory::getApplication()->input;
		$user  = JFactory::getUser();
		$url = $this->input->getString('url', '');
		$articleId = $this->input->getInt('article', null);

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
