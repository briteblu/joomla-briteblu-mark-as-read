<?php
defined('_JEXEC') or die;
?>
<div class="mypreview">
 <?php foreach ($this->items as $item) : ?>
 <div class="myfolio">
 <div class="folio_title">
 <?php echo $item->title; ?>
 </div>
 <div class="folio_element">
 <a href="<?php echo $item->url; ?>" target="_blank"><img 
src="<?php echo $item->image; ?>" width="150"></a>
 </div>
 <div class="folio_element">
 <strong><?php echo JText::_('COM_FOLIO_COMPANY');?></
strong><?php echo $item->company; ?>
 </div>
 <div class="folio_element">
 <strong><?php echo JText::_('COM_FOLIO_PHONE');?></
strong><?php echo $item->phone; ?>
 </div>
 <div class="folio_element">
 <?php echo $item->description; ?>
 </div>
 </div>
 <?php endforeach; ?>
</div>
