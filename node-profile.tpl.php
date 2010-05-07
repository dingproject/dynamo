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

<!-- node-profile .tpl-->
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

  	<?php if($node->title){	?>	
      <h3><?php print l($node->title, 'node/'.$node->nid); ?></h3>
  	<?php } ?>


    <div class="subject">
      <?php print return_terms_from_vocabulary($node, "1"); ?> 
    </div>

  	<div class="meta">
  		<span class="time">
  			<?php print format_date($node->created, 'custom', "j F Y") ?> 
  		</span>	
  		<span class="author">
				<?php print t('by') . ' ' . theme('username', $node); ?>
  		</span>	

			<?php print $node->field_library_ref[0]['view'];  ?>

			
  	</div>

    <p><?php print strip_tags($node->content['body']['#value']);?></p>

		<?php if (count($taxonomy)){ ?>
		  <div class="taxonomy">
	   	  <?php print $terms ?> 
		  </div>  
		<?php } ?>



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
	  <h2><?php print $title;?></h2>
	<?php } ?>

	<div class="content">
		<?php print $content ?>
	</div>

	<?php // print l(t('contact'), 'user/' . $node->uid . '/contact', $options= array('attributes' => array('class' =>'contact')) );?>	
		





</div>
<?php } ?>
<!-- /node.tpl-->
