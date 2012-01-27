<!--views-view-fields--library-list--page.tpl.php-->
<div class="clearfix">
  <div class="picture">
    <?php print $fields['field_image_fid']->content; ?>  
  </div>
  <div class="info">
    <h3><?php print $fields['title']->content; ?></h3>
    <?php print $fields['address']->content;?>
  </div>
</div>
