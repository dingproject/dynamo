<?php

/**
 * @file
 * Template to render feature nodes.
 */

if ($page == 0){ ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

  <div class="picture"><?php print $field_list_image[0]['view']; ?></div>
  
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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

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

