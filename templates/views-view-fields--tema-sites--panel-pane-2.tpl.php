<?php
/**
 * @file
 * Template to render event teasers on the tema site page.
 */

  // Prepare a couple of variables.
  $start = date_make_date($fields['field_datetime_value']->raw);
  $price = ($fields['field_entry_price_value']->raw < 1) ? t('Free') : intval($fields['field_entry_price_value']->raw) . ' kr.';

  // Set today style
  if( date('d-m-Y') == dynamo_datef($start, "d-m-Y") ){
    $is_today = "today";
  }
?>
<div class="calendar-leafs">

  <div class="leaf <?php print $is_today ?>">
    <div class="day"><?php print dynamo_datef($start, 'l');?></div>
    <div class="date"><?php print dynamo_datef($start, 'j');?></div>
    <div class="month"><?php print dynamo_datef($start, 'M');?></div>
  </div>

  <div class="info">
    <h4><?php print $fields['title']->content; ?></h4>
		<span class="info-library"><?php print $fields['field_library_ref_nid']->content; ?></span>
    <?php if (dynamo_datef($start, 'Hi') != '0000') : ?>
    <span class="time">
			<?php print dynamo_datef($start, 'H:i'); ?> -
    </span>
    <?php endif; ?>
    <?php print $price; ?>
  </div>

</div>  

