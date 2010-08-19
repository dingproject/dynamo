<?php
// $Id$

/**
 * @file
 * Template to render profile nodes.
 */

if ($page == 0){ ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">


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

