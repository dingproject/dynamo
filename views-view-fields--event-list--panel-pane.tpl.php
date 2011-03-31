<?php
// $Id$

/**
 * Template to render a row from the event_list view.
 */

// Prepare a couple of variables.
$start = date_make_date($fields['field_datetime_value']->raw);
$price = ($fields['field_entry_price_value']->raw < 1) ? t('Free') : intval($fields['field_entry_price_value']->raw) . ' kr.';
?>
<div class="node-teaser clearfix">

  <div class="picture">

    <?php print $fields['field_list_image_fid']->content; ?>
  </div>

  <div class="info">

		<h2><?php print $fields['title']->content; ?></h2>

		<div class="meta">
      <?php print dynamo_datef($start, 'j. F Y'); ?>
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

