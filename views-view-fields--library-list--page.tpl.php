<!--views-view-fields--library-list--page.tpl.php-->
<div class="clearfix">
  <div class="picture">
    <?php print $fields['field_image_fid']->content; ?>  
  </div>
  <div class="info">
    <?php $fields['field_opening_hours_processed']->status;?>

    <div class="library-status open">open</div>
    <div class="library-status close">close</div>    
    
    <h3><?php print $fields['title']->content; ?></h3>
    <?php print $fields['address']->content;?>
  </div>
    <?php print $fields['field_opening_hours_scope']->content;?>
</div>
