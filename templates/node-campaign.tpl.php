<?php
/**
 * @file
 * Template to render campaign nodes.
 */

if ($node->campaign_type == "image-only"): ?>

<div class="campaign-image campaign-type-<?php print $node->campaign_type;  ?> clearfix">
  <?php print $campaign_image; ?>
</div>

<?php elseif ($node->campaign_type == "text-only"): ?>

<div class="campaign-text clearfix">
  <div class="campaign-inner">
    <div class="campaign-type-<?php print $node->campaign_type;?>">
      <div class="campaign-theme campaign-theme-<?php print $node->campaign_theme; ?>">
        <?php print $campaign_text; ?>
      </div>
    </div>
  </div>
</div>

<?php else: ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">
  <h4 class="title"><?php print $title; ?></h4>
  <div class="body"><?php print $body; ?></div>
</div>

<?php endif; ?>

