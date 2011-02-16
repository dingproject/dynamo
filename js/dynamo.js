/**
 * @file
 * JavaScript bindings and behaviors for the Dynamo theme for Ding.
 */

// To do when the document is ready.
jQuery(function($) {
  // Button for hiding messages.
  $("#messages-hide a").click(function (event) {
    $('#drupal-messages').slideUp();
  });

  // In-field labels for the login form.
  $("#pageheader label").inFieldLabels({
    fadeOpacity:"0.2",
    fadeDuration:"100"
  });

  // jCarousel for the front page.
  if ($('#event-similar')) {
    $('#event-similar').jcarousel({
       vertical: false, //
       scroll: 1, //amount of items to scroll by
       animation: "slow", // slow - fast
       auto: "0", //autoscroll in secunds
       wrap: "last"
    });
  }
});

