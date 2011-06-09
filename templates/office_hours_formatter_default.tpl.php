<?php
/**
 * Template for the default format of office hours.
 *
 * Displays a full week of hours.
 */
?>
<div class="office-hours-week node-<?php print $node->nid; ?>">
  <div class="week-info">
    <strong>
      <span class="week-num"><?php print $week_num_text; ?></span> – 
      <span class="from-date"><?php print $start_day; ?></span> –
      <span class="to-date"><?php print $end_day; ?></span>
    </strong>
  </div>
<?php foreach ($day_abbr as $num => $day) {
  if (isset($week[$day])) {
    print theme('office_hours_format_day', $day_names[$num], $week[$day], $num);
  }
} ?>
</div>

