<?php
$output = preg_replace('/- 00:00/', '('. date_t('All day', 'datetime') .')', $output);
?>
<?php print $output; ?>
