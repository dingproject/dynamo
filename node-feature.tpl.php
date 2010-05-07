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
<!-- node-feature.tpl-->
<?php if ($page == 0){ ?>
<div<?php print $id_node . $classes; ?>>
  <?php 

  if($list_image !="&nbsp;"){ ?>
    <div class="picture"><?php print $list_image; ?></div>
  <?php } ?>
  
  <div class="content">
    <div class="subject">
      <?php print return_terms_from_vocabulary($node, "1"); ?> 
    </div>

  	<?php if($node->title){	?>	
      <h3><?php print l($node->title, 'node/'.$node->nid); ?></h3>
  	<?php } ?>

    <?php 
    		//field_teaser
    		if($node->field_teaser[0]['view']){
    			print $node->field_teaser[0]['view'];
    		}else{
    			print strip_tags($node->content['body']['#value']);	
    		}
     ?>

    <?php // print strip_tags($node->content['body']['#value']);?>

  </div>

</div>
<?php }else{ 
//Content
?>

<div<?php print $id_node . $classes; ?>>

  <div class="subject">
    <?php print return_terms_from_vocabulary($node, "1"); ?> 
  </div>

	<div class="content">
		<?php  print $content ?>
	</div>

	<?php if (count($taxonomy)){ ?>

	  <div class="taxonomy">
   	  <?php print $terms ?> 
	  </div>  
	<?php } ?>

</div>
<?php } ?>
