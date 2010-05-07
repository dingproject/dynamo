<?php
// $Id$

/**
 * @file ding_event_similar_events.tpl.php
 * Template to display similar events, usually in the context of a Panel.
 */
?>

<h4><?php print t('Other events you may like'); ?></h4>
<ul id="event-similar" class="jcarousel-skin-events">
<?php foreach ($events as $node): ?>
  <li>
    <h4><?php print l($node->title, 'node/' . $node->nid); ?></h4>


    <?php if($node->field_list_image['0']['filepath']){ ?>
        <?php print theme('imagecache', '120_120', $node->field_list_image['0']['filepath']); ?>      
    <?php } 
    	  else
    	  {
    	  	print "<div>" . $node->teaser . "</div>";
    	  }
    ?>


  	<?php 
		  $date = strtotime($node->field_datetime[0]['value'] . 'Z');
		  $date2 = strtotime($node->field_datetime[0]['value2'] . 'Z');

		  if (format_date($date, 'custom', 'Ymd') == format_date($date2, 'custom', 'Ymd')) {
		  	print '<div class="date">' . format_date($date, 'custom', "j. F Y") . '</div>';
		  }
		  elseif (format_date($date, 'custom', 'Ym') == format_date($date2, 'custom', 'Ym')) {
		  	print '<div class="date">' . format_date($date, 'custom', "j.") . "-" . format_date($date2, 'custom', "j. F Y") . '</div>';
		  }
		  else {
		  	print '<div class="date">' . format_date($date, 'custom', "j. M.") . " - " . format_date($date2, 'custom', "j. M. Y") . '</div>';
		  }
		  
		//  print format_date($date, 'custom', "H:i") ." - ";
		//  print format_date($date2, 'custom', "H:i");		  
	 ?> 


		 <?php //print t('pris:') . $node->field_entry_price[0]['value']; ?>
  
		<?php //print $node->teaser; ?> 

  </li>
<?php endforeach; ?>
</ul>

