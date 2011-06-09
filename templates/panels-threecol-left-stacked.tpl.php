<!--panels-threecol-left-stacked.tpl.php-->
<div class="panel-threecol-left-stacked clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div class="content-left">

      <div class="content-top">
        <?php print $content['top']; ?>
      </div>

      <div class="content-middle">

        <div class="panel-left">
            <?php print $content['left']; ?>
        </div>

        <div class="panel-middle">
            <?php print $content['middle']; ?>
        </div>

      </div>

      <div class="panel-bottom">
        <?php print $content['bottom']; ?>
      </div>

  </div>

  <div class="content-right">
      <?php print $content['right']; ?>
  </div>

</div>

<!--/panels-threecol-left-stacked.tpl.php-->