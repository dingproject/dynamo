<?php
/**
 * @file
 * Template to render library nodes.
 */

// Teaser view.
if ($page == 0): ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

  <div class="picture"><?php print $field_list_image[0]['view']; ?></div>

  <div class="content">
  
    <div class="library-openstatus <?php print $node->field_opening_hours_processed['status'];?>">
        <?php print $node->field_opening_hours_processed['status_local'];?>
    </div>

    <div class="vcard">
      <h2 class="fn org"><?php print l($node->title, 'node/'.$node->nid); ?></h2>
      <div class="adr">
        <div class="street-address"><?php print $node->location['street']; ?></div>
        <span class="postal-code"><?php print $node->location['postal_code']; ?></span>
        <span class="locality"><?php print $node->location['city']; ?></span>
      </div>

      <div class="link-card">
        <a class="view-on-map-link" href="/biblioteker?lat=<?php echo $node->location['latitude'] ?>&amp;lon=<?php echo $node->location['longitude'] ?>" id="biblo-<?php print $node->nid ?>">Se på kort</a>
      </div>

      <?php if ($node->location['phone']): ?>
      <div class="tel">
        <span class="type"><?php print t('Phone'); ?>:</span> <span><?php print $node->location['phone']; ?></span>
      </div>
      <?php endif; ?>

      <?php if ($node->location['fax']): ?>
      <div class="tel">
        <span class="type"><?php print t('Fax'); ?>:</span> <span><?php print $node->location['fax']; ?></span>
      </div>
      <?php endif; ?>

      <?php if ($node->field_email['0']['view']): ?>
      <div class="email">
        <span class="type"><?php print t('E-mail'); ?>:</span> <span><?php print $node->field_email['0']['view']; ?></span>
      </div>
      <?php endif; ?>

      <div class="geo">
      	<?php print t('Position'); ?>:
      	<span class="latitude"><?php echo $node->location['latitude'] ?></span>, 
 				<span class="longitude"><?php echo $node->location['longitude'] ?></span>
      </div>
    </div>

  </div>
  
  <?php print $node->field_opening_hours['0']['view'];?>
</div>

<?php else: 
//Content
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

	<h1><?php print $title;?></h1>
		
	<div class="meta">
  	<?php if ($picture): ;?>
			<span class="author-picture">
		  		<?php print $picture; ?>  
			</span>
		<?php endif; ?>


		<span class="time">
			<?php print format_date($node->created, 'custom', "j F Y") ?> 
		</span>	
		<span class="author">
			af <?php print theme('username', $node); ?>
		</span>	



		<?php if (count($taxonomy)): ?>
		  <div class="taxanomy">
	   	  <?php print $terms ?> 
		  </div>  
		<?php endif; ?>
	</div>

	<div class="content">
		<?php print $content ?>
	</div>
		
	<?php if ($links): ?>
    <?php print $links; ?>
	<?php endif; ?>
</div>
<?php endif; ?>

