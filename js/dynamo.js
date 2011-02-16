/**
 * @file
 * JavaScript bindings and behaviors for the Dynamo theme for Ding.
 */

$(document).ready(function() {

  //hide messages
  $("#messages-hide a").click(function (event) {
      $('#drupal-messages').slideUp();
  });

  //label
  $("#pageheader label").inFieldLabels({
    fadeOpacity:"0.2",
    fadeDuration:"100"
  });

  //carousel
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

