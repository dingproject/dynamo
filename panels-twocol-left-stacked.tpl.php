<!--panels-twocol-left-stacked.tpl.php-->
<div class="panel-twocol-left-stacked clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

<!--content-left-->
	<div class="content-left">

		<div class="content-top">
			<?php print $content['top']; ?>
		</div>
		<!--left-->
		<div class="panel-left">
			<?php print $content['left']; ?>
    </div>
		<!--/left-->
		<?php if (!empty($content['bottom'])): ?>
	  <div class="panel-bottom">
	    <?php print $content['bottom']; ?>  
	  </div>
		<?php endif; ?>	

	</div>

<!--//content-left-->
<!--content-right-->
	<div class="content-right">
		<?php print $content['right']; ?>
	</div>  
<!--/content-right-->
</div>  
<!--/panels-twocol-left-stacked.tpl.php-->