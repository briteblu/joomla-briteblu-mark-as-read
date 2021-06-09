<?php
/**
 * TODO
 *
 * @package Markasread
 * @author B. van Wetten <bas@vanwetten.com>
 * @copyright 2021 BriteBlu
 * @license MIT https://opensource.org/licenses/MIT
 */

/**
 * Layout variables
 * -----------------
 * @var   string   $context   The context of the content being passed to the plugin
 * @var   object   &$article  The article object
 * @var   object   &$params   The article params
 * @var   integer  $page      The 'page' number
 * @var   string   $path      Path to this file
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$uri = clone JUri::getInstance();
$lang = JFactory::getLanguage();

?>
<!-- Top-right corner -->
<!-- <div class="container__corner container__corner--tr"></div> -->
<?php // @codingStandardsIgnoreStart ?>
<div class="btn-group pull-right">
	<form id="markasread_form_<?=$article->id?>" method="post" action="<?=htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" class="form-inline markasread_form <?=$this->hasBeenRead ? 'read' : 'unread'?>">
		<button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-light hasTooltip" value="<?=$article->id?>" title="Toggle read/unread"><span class="icon-eye-<?=$this->hasBeenRead ? 'close' : 'open'?>" aria-hidden="true"></span></button>
		<input type="hidden" name="task" value="<?=$this->hasBeenRead ? 'unread' : 'read'?>" />
		<input type="hidden" name="url" value="<?=htmlspecialchars($uri->toString(), ENT_COMPAT, 'UTF-8'); ?>" />
		<input type="hidden" name="article" value="<?= $article->id ?>" />
		<input type="hidden" name="format" value="json" />
		<input type="hidden" name="option" value="com_markasread" />
		<?php echo JHtml::_( 'form.token' ); ?>
</form>
</div>
<?php // @codingStandardsIgnoreEnd ?>
