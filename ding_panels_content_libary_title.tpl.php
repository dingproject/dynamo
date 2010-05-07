<?php if($display_header_image){  ?>
<div class="picture">
  <div class="picture-inner">
  <?php if($node->field_image['0']['filepath']){ ?>
    <?php print theme('imagecache', '680_200_crop', $node->field_image['0']['filepath']); ?>      
  <?php } ?>
  </div>
</div>
<?php } ?>

<h1><?php print $library_title; ?></h1>
<?php  print $library_navigation; ?>