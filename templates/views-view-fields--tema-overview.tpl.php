<?php
/**
 * @file
 * Template to render tema site teasers on the overview page.
 */
?>
<div class="clearfix">
  <div class="picture">
    <?php if ($fields['field_list_image_fid']->content) {
      print $fields['field_list_image_fid']->content;
    } ?>
  </div>
  <div class="info">
    <h2><?php print $fields['title']->content; ?></h2>

    <?php if($fields['field_teaser_value']->content OR $fields['body']->content) : ?>
      <p>
      <?php print $fields['field_teaser_value']->content; ?>
      <?php print $fields['body']->content; ?>
      <span class="more-link"><?php print $fields['view_node']->content; ?></span>
      </p>
    <?php endif; ?>

    <?php if($fields['edit_node']->content) {
      print $fields['edit_node']->content;
    } ?>
  </div>
</div>

