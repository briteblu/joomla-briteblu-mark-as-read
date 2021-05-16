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
 * @var   string   $context   The context of the content being passed to the plugin
 * @var   object   &$article  The article object
 * @var   object   &$params   The article params
 * @var   integer  $page      The 'page' number
 * @var   string   $path      Path to this file
 */

$uri = clone JUri::getInstance();
$lang = JFactory::getLanguage();

?>
<!-- Top-right corner -->
<!-- <div class="container__corner container__corner--tr"></div> -->
<div class="btn-group pull-right">
  <form method="post" action="<?php echo htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" class="form-inline">
    <?php if ($this->_hasBeenRead) { ?>
      <button type="submit" class="btn btn-light"><span class="icon-eye-close" aria-hidden="true"></span></button>
      <input type="hidden" name="task" value="unread" />
    <?php } else { ?>
      <button type="submit" class="btn btn-light"><span class="icon-eye-open" aria-hidden="true"></span></button>
      <input type="hidden" name="task" value="read" />
    <?php } ?>
    <input type="hidden" name="url" value="<?php echo htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" />
    <input type="hidden" name="article" value="<?=$article->id?>" />
    <input type="hidden" name="option" value="com_markasread" />
    <?php echo JHtml::_( 'form.token' ); ?>
</form>
</div>
