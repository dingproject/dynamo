 <!-- views-view-fields  event-list  page.tpl.php  (panel pane)-->
<?php 
  // Convert the date value to timestamp
  $date = theme('event_information',
                strtotime($fields['field_datetime_value']->raw . 'Z'),
                strtotime($fields['field_datetime_value']->raw . 'Z'),
                $fields['field_entry_price_value']->raw);
  //$date = strtotime($fields['field_datetime_value']->raw . 'Z');
?>
<div class="node-teaser clearfix">

  <div class="picture">

    <?php print $fields['field_list_image_fid']->content; ?>
  </div>

  <div class="info">
  
		<h2><?php print $fields['title']->content; ?></h2>

		<div class="meta">
		  <?php print $date['date']; ?>
		  <span class="libary-tag"><?php print $fields['field_library_ref_nid']->content; ?></span>, 
		  <span class="price"><?php print $date['price']; ?></span>
		</div>    
    
		<p> 
		 <?php 
	 			if($fields['field_teaser_value']->content){
					print $fields['field_teaser_value']->content; 

				}else{
					print $fields['body']->content;       
	 			}
 			?>
		</p> 
		
    <?php print $fields['edit_node']->content; ?>  
  </div>
</div>

