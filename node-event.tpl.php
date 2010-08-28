<?php
// $Id$

/**
 * @file
 * Template to render event nodes.
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">

<?php if ($page == 0): ?>


  <div class="picture"><?php print $field_list_image[0]['view']; ?></div>

  <div class="content">

    <?php if ($node->title): ?>
      <h3><?php print l($node->title, 'node/' . $node->nid); ?></h3>
    <?php endif; ?>

    <div class="meta">
      <?php print $field_datetime_rendered ?>
      <?php print $field_library_ref_rendered ?>
      <?php print $field_entry_price_rendered ?>
    </div>

    <?php
      //field_teaser
      if ($node->field_teaser[0]['value']) {
        print $node->field_teaser[0]['value'];
      }
      else {
        print strip_tags($node->content['body']['#value']);
      }
    ?>


  <?php // adding warning for event that has already occurred
  if ($event_info['past_event']): ?>
    <div class="alert"><?php print t('NB! This event occurred in the past.'); ?></div>
  <?php endif; ?>
  </div>

<?php else:
//Content
?>
  <?php if($node->title){ ?>
    <h2><?php print $title;?></h2>
  <?php } ?>

  <?php
    // adding warning for event that has already occurred
    print $alertbox;
  ?>

  <div class="content">
    <div class="meta">
      <?php print $field_datetime_rendered ?>
      <?php print $field_entry_price_rendered ?>
    </div>

    <?php print $content ?>
  </div>

  <div class="meta">
    <span class="time">
      <?php print t('This event was created'); ?>
      <?php print format_date($node->created, 'custom', "j. F Y") ?>
    </span>
    <span class="author">
      <?php print t('by'); ?> <?php print theme('username', $node); ?>
    </span>

    <?php if (count($taxonomy)){ ?>
      <div class="taxonomy">
        <?php print t("Tags:") . " " .  $terms ?>
      </div>
    <?php } ?>
  </div>

  <?php if ($links){ ?>
    <?php print $links; ?>
  <?php } ?>
<?php endif; ?>
</div>

