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

/**
 * Layout variables
 * -----------------
 * @var   string   $context  The context of the content being passed to the plugin
 * @var   object   &$row     The article object
 * @var   object   &$params  The article params
 * @var   integer  $page     The 'page' number
 * @var   array    $parts    The context segments
 * @var   string   $path     Path to this file
 */

?>
<!-- Top-right corner -->
<!-- <div class="container__corner container__corner--tr"></div> -->
<div class="btn-group pull-right">
	<form>
		<button type="button" class="btn btn-light" <?php if ($this->_hasBeenRead) { echo 'disabled'; } ?>><span class="icon-checkmark" aria-hidden="true"></span></button>
</form>
</div>
