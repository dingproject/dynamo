<?php
/*
ad a class="" if we have anything in the $classes var
this is so we can have a cleaner output - no reason to have an empty <div class="" id=""> 
*/
if($classes){
   $classes = ' class="' . $classes . ' clearfix"';
}

if($id_node){
  $id_node = ' id="' . $id_node . '"';  
}

?>

<!-- node-event.tpl-->
<?php if ($page == 0){ ?>
<div<?php print $id_node . $classes; ?>>

  <div class="picture"><?php print $list_image; ?></div>

  <div class="content">

  	<?php if ($node->title): ?>
      <h3><?php print l($node->title, 'node/'.$node->nid); ?></h3>
  	<?php endif; ?>

  	<div class="meta">
      <?php print $field_datetime_rendered ?>
      <?php print $field_library_ref_rendered ?>          
      <?php print $field_entry_price_rendered ?>
  	</div>
	
		<?php 
			//field_teaser
				if($node->field_teaser[0]['value']){
					print $node->field_teaser[0]['value'];
				}else{
					print strip_tags($node->content['body']['#value']);	
				}
			?>


	<?php
	// adding warning for event that has already occurred
	print $alertbox;
 	?>
    
  </div>

</div>
<?php }else{ 
//Content
?>

<div<?php print $id_node . $classes; ?>>

	<?php if($node->title){	?>	
	  <h2><?php print $title;?></h2>
	<?php } ?>

	<?php
		// adding warning for event that has already occurred
		print $alertbox;
	?>

	<div class="content">
		<div class="event-info">
                  <span class="event-date"><?php print $event_date; ?></span>
                  <?php if($event_time){	?>
                    <span class="time"><?php print $event_time; ?></span>
                  <?php } ?>
			<span class="event-price"><?php print $event_price; ?></span>
		</div>
		<?php print $content ?>
	</div>
		
	<div class="meta">
		<span class="time">
			<?php print t('This event was created'); ?>
			<?php print format_date($node->created, 'custom', "j. F Y") ?> 
		</span>	
		<span class="author">
			<?php print t('by'); ?> <?php print theme('username', $node); ?>
		</span>	

		<?php if (count($taxonomy)){ ?>
		  <div class="taxonomy">
	   	  <?php print t("Tags:") . " " .  $terms ?> 
		  </div>  
		<?php } ?>
	</div>		
		
	<?php if ($links){ ?>
    <?php  print $links; ?>
	<?php } ?>
</div>
<?php } ?>
