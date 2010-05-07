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

<!-- node.tpl-->
<?php if ($page == 0){ ?>
<div<?php print $id_node . $classes; ?>>

  <div class="picture">
    <?php
 		if($field_image_rendered){
			print $field_image_rendered; 	
		}
	?>
  </div>

  <div class="content">

    <div class="subject">
      <?php print return_terms_from_vocabulary($node, "1"); ?> 
    </div>

  	<?php if($node->title){	?>	
      <h3><?php print l($node->title, 'node/'.$node->nid); ?></h3>
  	<?php } ?>

  	<div class="meta">
  		<span class="time">
  			<?php print format_date($node->created, 'custom', "j F Y") ?> 
  		</span>	
  		<span class="author">
  			af <?php print theme('username', $node); ?>
  		</span>	

			<?php print $node->field_library_ref[0]['view'];  ?>

			
  		<?php if (count($taxonomy)){ ?>
  		  <div class="taxonomy">
  	   	  <?php print $terms ?> 
  		  </div>  
  		<?php } ?>
  	</div>

    <?php print $node->content['body']['#value'];?>
    
  </div>

</div>
<?php }else{ 
//Content
?>

<div<?php print $id_node . $classes; ?>>

  <div class="subject">
    <?php print return_terms_from_vocabulary($node, "1"); ?> 
  </div>

	<?php if($node->title){	?>	
	  <h1><?php print $title;?></h1>
	<?php } ?>

	<?php if (count($taxonomy)){ ?>
	  <div class="taxonomy">
   	  <?php print $terms ?> 
	  </div>  
	<?php } ?>

	<div class="content">
    <div class="teaser">
      <?php print check_plain($node->field_teaser[0]['value']); ?>
    </div>

    <?php foreach ($field_flexifield_topic as $field) { ?>
      <?php if ($field['type'] == 'flexifield_link') { ?>
        <div class="topic-field-link">
          <?php print l($field['value']['field_link'][0]['title'], $field['value']['field_link'][0]['url']); ?><br />
          <?php print check_plain($field['value']['field_teaser'][0]['value']); ?>
        </div>
      <?php } else if ($field['type'] == 'flexifield_text') { ?>
        <div class="topic-field-text">
          <h4><?php print check_plain($field['value']['field_title'][0]['value']); ?></h4>
          <p><?php print check_plain($field['value']['field_teaser'][0]['value']); ?></p>
        </div>
      <?php } else if ($field['type'] == 'flexifield_ting_refs') { ?>
        <div class="topic-field-ting-refs">

          <?php print $field['view'] ?>
	      </div>
      <?php } else { ?>
        <div class="topic-field">
          <?php print $field['view'] ?>
	      </div>
      <?php } ?>
    <?php } ?>
	</div>


  <?php if ($similarterms) { ?>
    <div class="ding-box-wide similar">
      <h3><?php print t('Similar'); ?></h3>
      <?php print $similarterms; ?>
    </div>
  <?php } ?>

</div>
<?php } ?>
<!-- /node.tpl-->
