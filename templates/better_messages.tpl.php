<?php
/**
 * @file
 * Template for rendering system messages via the better messages module.
 *
 * Available variables are:
 *  $content  The messages to put inside Better Messages. Drupal originally
 *            calls theme_status_messages() to theme this output.
 *
 * With this module enabled you'll always have to call
 * theme_better_messages_content() instead of theme_status_messages().
 */
?><div id="better-messages-dynamo">
  <div id="messages-inner">
    <?php print $content ?>
    <div class="footer clear-block">
      <span class="message-timer"></span>
      <a class="message-close" href="#"><?php print t('Close'); ?></a>
    </div>
  </div>
</div>

