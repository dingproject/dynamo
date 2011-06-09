<?php
// $Id$

/**
 * @file
 * Template to render nodes.
 */

if ($page == 0) { ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

  <div class="picture"><?php print $list_image; ?></div>

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
				<?php print t('by') . ' ' . theme('username', $node); ?>
  		</span>	

			<?php print $node->field_library_ref[0]['view'];  ?>

  	</div>

    <p>
		<?php 
			//field_teaser
				if($node->field_teaser[0]['value']){
					print $node->field_teaser[0]['value'];
				}else{
					print strip_tags($node->content['body']['#value']);	
				}
			?>
		</p>

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

	<div class="meta">
	  
		<?php print format_date($node->created, 'custom', "j F Y") ?> 
    <i><?php print t('by'); ?></i> 
		<span class="author"><?php print theme('username', $node); ?></span>	
	</div>

	<div class="content">
		<?php print $content ?>
	</div>

	<?php if (count($taxonomy)){ ?>

	  <div class="taxonomy">
   	  <?php print $terms ?> 
	  </div>  
	<?php } ?>
		

  <?php if ($similarterms) { ?>
    <div class="ding-box-wide similar">
      <h3><?php print t('Similar'); ?></h3>
      <?php print $similarterms; ?>
    </div>
  <?php } ?>


	<?php if ($links){ ?>
    <?php  print $links; ?>
	<?php } ?>

</div>
<?php } ?>

