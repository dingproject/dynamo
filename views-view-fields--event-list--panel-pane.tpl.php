<?php 
// $Id$

/**
 * Template to render a row from the event_list view.
 */

$start = date_make_date($fields['field_datetime_value']->raw);
$price = ($fields['field_entry_price_value']->raw == 0) ? t('Free') : $fields['field_entry_price_value']->raw;
?>
<div class="node-teaser clearfix">

  <div class="picture">

    <?php print $fields['field_list_image_fid']->content; ?>
  </div>

  <div class="info">
  
		<h2><?php print $fields['title']->content; ?></h2>

		<div class="meta">
      <?php print $start->format('j. F Y'); ?>
		  <span class="library-tag"><?php print $fields['field_library_ref_nid']->content; ?></span>, 
		  <span class="price"><?php print $price; ?></span>
		</div>    
    
		<p> 
		 <?php 
	 			if ($fields['field_teaser_value']->content) {
					print $fields['field_teaser_value']->content; 
        }
        else {
					print $fields['body']->content;       
	 			}
 			?>
		</p> 
		
    <?php print $fields['edit_node']->content; ?>  
  </div>
</div>

