<div class="comment<?php print ' '. $status ?>">
	<blockquote>
    <?php if ($comment->new){ ?>
      <h4 class="new"><?php print $title ?></h4>
    <?php }else{ ?>
      <h4><?php print $title ?></h4>
    <?php } ?>

	  <?php print $content ?>
    <?php print $links ?>    
	</blockquote>

  <div class="meta">
    <?php
      if($comment->picture){
        $image = theme('imagecache', 'user-thumbnail', $comment->picture); 
        print l($image, 'user/'.$comment->uid, $options= array('html'=>TRUE));
      }
    ?>
    <span class="author"><?php print $author ?></span> 
	  <span class="time"><?php print $date ?></span>
    <?php if ($signature){ ?>
      <?php print $signature ?>
    <?php } ?>		  
  </div>	
</div>