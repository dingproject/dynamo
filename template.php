<?php

/**
 * @file
 * Template functions for Dynamo theme.
 */

/**
 * Implementation of hook_theme().
 */
function dynamo_theme($existing, $type, $theme, $path) {
  return array(
    'ting_search_form' => array(
      'arguments'=> array('form' => NULL),
    ),
    'user_login_block' => array(
      'arguments' => array ('form' => NULL),
    ),
    'comment_form' => array(
      'arguments' => array ('form' => NULL),
    ),
  );
}

/**
 * Preprocess page template variables.
 */
function dynamo_preprocess_page(&$vars){
  //adds a class to the body with the last path of the url
  $body_classes = array($vars['body_classes']);
  $path = explode('/', $_SERVER['REQUEST_URI']);

  $args = arg();
  if (isset($args[0])) {
    $body_classes[] = mothership_id_safe('ding-' . $args[0]);
    if (isset($args[1])) {
      $body_classes[] = mothership_id_safe('ding-' . $args[0] . ' ' . $args[1]);
    }
  }
  if (count($args) > 1) {
    $body_classes[] = mothership_id_safe('ding-' . end($args));
    if (isset($args[2]))
    $body_classes[] = mothership_id_safe('ding-' . $args[2]);
  }

  // Concatenate with spaces
  $vars['body_classes'] = implode(' ', $body_classes);
}

/**
 * Preprocess node template variables.
 */
function dynamo_preprocess_node(&$variables) {
  // Added by mikl, since the classes coming from mothership are broken.
  $variables['classes'] .= ' ding-node';

  // FIXME
  // kasperg: This logic does not belong in the theme layer.
  // Consider moving this to a Panels pane and place it on
  // the appropriate pages.
  $similar_nodes = similarterms_list(variable_get('ding_similarterms_vocabulary_id', 0));
  if (count($similar_nodes)) {
    $variables['similarterms'] = theme('similarterms', variable_get('similarterms_display_options', 'title_only'), $similar_nodes);
  }

  // Variables for node-campaign.tpl.php
  if ($variables['type'] == 'campaign') {
    $node = $variables['node'];

    if ($node->campaign_type == "image-only") {
      // Render the image as a link to the campaign destination.
      $variables['campaign_image'] = l($node->field_campaign_image['0']['view'], $node->field_campaign_link['0']['url'], $options = array(
        'html'=>TRUE,
        'query' => $node->field_campaign_link['0']['query'],
      ));
    }
    elseif ($node->campaign_type == "text-only") {
      // Render the text as a link to the campaign destination.
      $variables['campaign_text'] = l(filter_xss($node->content['body']['#value']),  $node->field_campaign_link['0']['url'], $options = array(
        'html'=>TRUE,
        'query' => $node->field_campaign_link['0']['query'],
      ));
    }
    else {
      // Just expose the main body field as a variable.
      $variables['body'] = $node->content['body']['#value'];
    }
  }
}

/**
 * Implementation of theme_breadcrumb().
 */
function dynamo_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    // Remove the last, empty item from the breadcrumb trail.
    if (end($breadcrumb) == NULL) {
      array_pop($breadcrumb);
    }
    // Append the page title to the breadcrumb.
    $breadcrumb[] = menu_get_active_title();
    $output = '<div id="path">' . t('You are here:');
    $output .= ' <div class="breadcrumb">' . implode(' » ', $breadcrumb) . '</div>';
    $output .= '</div>';
    return $output;
  }
}

/*forms*/
function dynamo_user_login_block($form){
  $form['submit']['#type'] = "image_button" ;
  $form['submit']['#src'] = drupal_get_path('theme','dynamo')."/images/accountlogin.png";
  $form['submit']['#attributes']['class'] = '';


  $name = drupal_render($form['name']);
  $pass = drupal_render($form['pass']);
  $submit = drupal_render($form['submit']);
  $remember = drupal_render($form['remember_me']);

  return  $name . $pass . $submit . $remember . drupal_render($form);
}

function dynamo_ting_search_form($form){
  $form['submit']['#type'] = "image_button" ;
  $form['submit']['#src'] = drupal_get_path('theme','dynamo')."/images/searchbutton.png";
  $form['submit']['#attributes']['class'] = '';

  return drupal_render($form);
}

function dynamo_comment_form($form){
  $form['comment_filter']['format']['#collapsed'] = FALSE;
  unset($form['notify_clearit']);
  unset($form['comment_filter']['format']);

  $submit = drupal_render($form['submit']);
  $preview = drupal_render($form['preview']);
  $theform = drupal_render($form);
  return  $theform . '<div class="form-buttons">' . $submit . $preview . '</div>';

  return drupal_render($form);
}

/**
 * Theming panels panes.
 */
function dynamo_panels_pane($content, $pane, $display) {
  if (!empty($content->content)) {
    $idstr = $classstr = '';
    if (!empty($content->css_id)) {
      $idstr = ' id="' . $content->css_id . '"';
    }
    if (!empty($content->css_class)) {
      $classstr = ' ' . $content->css_class;
    }

    $output = "<div class=\"panel-pane pane-$pane->subtype $classstr \"$idstr>\n";

    if (!empty($content->title)) {
      // Support translation of panel panes.
      // Inspired by http://drupal.org/node/568740#comment-3479074.
      $content->title = t($content->title);

      if($pane->subtype == "event_list-panel_pane_1"  OR $pane->subtype == "recommendation_list"){
        $output .= "<h1>$content->title</h1>\n";
      }
      elseif(
        $pane->subtype == "topic_list" OR
        $pane->subtype == "event_list" OR
        $pane->subtype == "library_feature_detail_list" OR
        $pane->subtype == "node_content"
      ) {
        $output .= '<h2 class="panel-title">'. $content->title .'</h2>';
      }
      else {
        $output .= "<h3>$content->title</h3>\n";
      }
    }

    if (!empty($content->feeds)) {
      $output .= "<div class=\"feed\">" . implode(' ', $content->feeds) . "</div>\n";
    }

    $output .= $content->content;

    if (!empty($content->links)) {
      $output .= "<div class=\"links\">" . theme('links', $content->links) . "</div>\n";
    }

    if (!empty($content->more)) {
      if (empty($content->more['title'])) {
        $content->more['title'] = t('more');
      }
      $output .= "<div class=\"panels more-link\">" . l($content->more['title'], $content->more['href']) . "</div>\n";
    }
    if (user_access('view pane admin links') && !empty($content->admin_links)) {
      $output .= "<div class=\"admin-links panel-hide\">" . theme('links', $content->admin_links) . "</div>\n";
    }

    $output .= "</div>\n";
    return $output;
  }
}


function dynamo_panels_default_style_render_panel($display, $panel_id, $panes, $settings) {
  $output = '';

  $print_separator = FALSE;
  foreach ($panes as $pane_id => $content) {
    // Add the separator if we've already displayed a pane.
    if ($print_separator) {
      // $output .= '<div class="panel-separator"></div>';
    }
    $output .= $text = panels_render_pane($content, $display->content[$pane_id], $display);

    // If we displayed a pane, this will become true; if not, it will become
    // false.
    $print_separator = (bool) $text;
  }

  return $output;
}


//Taxonomy
//returns the terms from a given  vocab
function return_terms_from_vocabulary($node, $vid){
  $terms = taxonomy_node_get_terms_by_vocabulary($node, $vid, $key = 'tid');

  $vocabulary = taxonomy_vocabulary_load($vid);

  $termslist = '';
  if ($terms) {
    $content .= '<div class="terms">';
    foreach ($terms as $term) {
      $termslist = $termslist.l($term->name, 'taxonomy/term/'.$term->tid) . ' | ';
    }
    $content.= trim ($termslist," |").'</div>';
  }

  return $content;
}


/**
 * Implementation of theme_username().
 */
function dynamo_username($object) {
  // We might get passed node objects or other strangeness, so if object
  // doesn’t look like a user, try and load the user instead.
  if ($object->uid && (!isset($object->pass) || !isset($object->login))) {
    $account = user_load($object->uid);
    if ($account) {
      $object = $account;
    }
  }

  if ($object->uid && $object->name) {
    if (!empty($object->display_name)) {
      $name = $object->display_name;
    }
    else {
      $name = $object->name;
    }

    // Prevent extremely long names of non-trusted users from breaking the
    // design.
    if (drupal_strlen($name) > 20 && empty($object->has_secure_role)) {
      $name = drupal_substr($name, 0, 100) .'…';
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('attributes' => array('title' => t('View user profile.'))));
    }
    else {
      $output = check_plain($name);
    }
  }
  elseif ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= ' ('. t('not verified') .')';
  }
  else {
    $output = check_plain(variable_get('anonymous', t('Anonymous')));
  }

  return $output;
}



/**
 * Implementation of theme_pager().
 */
function dynamo_pager($tags = array(), $limit = 10, $element = 0, $parameters = array(), $quantity = 3) {
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', (isset($tags[0]) ? $tags[0] : t('« first')), $limit, $element, $parameters);
  $li_previous = theme('pager_previous', (isset($tags[1]) ? $tags[1] : t('‹ previous')), $limit, $element, 1, $parameters);
  $li_next = theme('pager_next', (isset($tags[3]) ? $tags[3] : t('next ›')), $limit, $element, 1, $parameters);
  $li_last = theme('pager_last', (isset($tags[4]) ? $tags[4] : t('last »')), $limit, $element, $parameters);

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => 'pager-first',
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => 'pager-previous',
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
/*
      if ($i > 1) {
        $items[] = array(
          'class' => 'pager-ellipsis',
          'data' => '…',
        );
      }
 */
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => 'pager-item',
            'data' => theme('pager_previous', $i, $limit, $element, ($pager_current - $i), $parameters),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => 'pager-current',
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => 'pager-item',
            'data' => theme('pager_next', $i, $limit, $element, ($i - $pager_current), $parameters),
          );
        }
      }
      /*
      if ($i < $pager_max) {
        $items[] = array(
          'class' => 'pager-ellipsis',
          'data' => '…',
        );
      }
       */
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => 'pager-next',
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => 'pager-last',
        'data' => $li_last,
      );
    }
    return theme('item_list', $items, NULL, 'ul', array('class' => 'pager'));
  }
}



/**
 * Crudely format danMARC2 data.
 *
 * Documentation: http://www.kat-format.dk/danMARC2/Danmarc2.5c.htm#pgfId=1575053
 */
function format_danmarc2($string){
  $string = str_replace('Indhold:','',$string);
  $string = str_replace(' ; ','<br/>',$string);
  $string = str_replace(' / ','<br/>',$string);

  return $string;
}

/**
 * Implementation of theme rss feed icon
 *
 * @param string $url
 * @return string
 */
function dynamo_feed_icon($url,$title='') {
  if(!isset($title)) {
    $title=t('RSS feed');
  }
  if ($image = theme('image', drupal_get_path('theme', 'dynamo').'/images/feed.png', $title, $title)) {
    // Transform view expose query string in to drupal style arguments -- ?library=1 <-> /1
    if ($pos = strpos($url, '?')) {
      $base = substr($url, 0, $pos);
      $parm = '';
      foreach ($_GET as $key => $value) {
        if ($key != 'q') {
          $parm .= '/' . strtolower($value);
        }
      }

      // Extra fix for event arrangementer?library=x, as it wants taks. id/lib. id
      if (isset($_GET['library'])) {
        if (arg(1) == '') {
          $parm = '/all'.$parm;
        }
      }
      $url = $base.$parm;
    }
    // Use plain HTML here just like in theme_feed_icon().
    // We already have a working url. If we use l() it will be converted twice.
    return '<a href="' . check_url($url) . '" title="' . $title . '" class="feed-icon">' .
             $image .
             '<span>'. t('RSS') .'</span>' .
           '</a>';
  }
}

/**
 * Overrides table theme function with support for colgroups
 * based on Drupal 7 theme function.
 */
function dynamo_table($header, $rows, $attributes = array(), $caption = NULL) {

  // Get colgroups out if attributes
  $colgroups = $attributes['colgroups'];
  if (!empty($attributes['colgroups'])) {
    unset($attributes['colgroups']);
  }

  // Add sticky headers, if applicable.
  if (count($header)) {
    drupal_add_js('misc/tableheader.js');

    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    if (isset($attributes['class'])) {
      $attributes['class'] .= ' sticky-enabled';
    }
    else {
      $attributes['class'] = 'sticky-enabled';
    }
  }

  $output = '<table' . drupal_attributes($attributes) . ">\n";

  if (isset($caption)) {
    $output .= '<caption>' . $caption . "</caption>\n";
  }

  // Format the table columns:
  if (count($colgroups)) {
    foreach ($colgroups as $number => $colgroup) {
      $attributes = array();

      // Check if we're dealing with a simple or complex column
      if (isset($colgroup['data'])) {
        foreach ($colgroup as $key => $value) {
          if ($key == 'data') {
            $cols = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cols = $colgroup;
      }

      // Build colgroup
      if (is_array($cols) && count($cols)) {
        $output .= ' <colgroup' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cols as $col) {
          $output .= ' <col' . drupal_attributes($col) . ' />';
        }
        $output .= " </colgroup>\n";
      }
      else {
        $output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
      }
    }
  }

  // Format the table header:
  if (count($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it followed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      $output .= _theme_table_cell($cell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there are rows
    $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (count($rows)) {
    $output .= "<tbody>\n";
    $flip = array('even' => 'odd', 'odd' => 'even');
    $class = 'even';
    foreach ($rows as $number => $row) {
      $attributes = array();

      // Check if we're dealing with a simple or complex row
      if (isset($row['data'])) {
        foreach ($row as $key => $value) {
          if ($key == 'data') {
            $cells = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cells = $row;
      }
      if (count($cells)) {
        // Add odd/even class
        $class = $flip[$class];

        if (is_array($attributes['class'])) {
          array_push($attributes['class'], $class);
        } else {
          $attributes['class'] .= ' '.$class;
        }

        // Build row
        $output .= ' <tr' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  $output .= "</table>\n";
  return $output;
}

/**
 * Override mothership form element to add class to wrapper if the
 * form element has triggered a validation error.
 */
function dynamo_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // Add an error class to the .form-item wrapper
  // Inspired by http://fourkitchens.com/blog/2009/06/10/advanced-drupal-form-theming-take-control-error-styling-form-item-error-class
  $error = '';
  $exempt_elements = array('checkbox', 'radio', 'password_confirm');
  if (dynamo_get_error($element) && !in_array($element['#type'], $exempt_elements)) {
    $error .= 'form-item-error';
    $error .= ' form-item-error-'. $element['#type']; // Optional
  }

  //add a more specific form-item-$type and error state
  $output = "<div class=\"form-item form-item-" . $element['#type'] .' '.$error." \" ";
  // TODO cant this be dublicated on a page?
  //and then its not unique
  if (!empty($element['#id'])) {
    $output .= ' id="'. $element['#id'] .'-wrapper"';
  }

  $output .= ">\n";
  $required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }

  //TODO test to see if this is clean text - then we might need a <span>
  //if we need to catch the content with
  $output .= "$value\n";

  if (!empty($element['#description'])) {
    $output .= '<div class="form-description">'. $element['#description'] ."</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}

/**
 * Overrides mothership filefield icon which in versions up to 1.2
 * contains an errorneous " before the alt attribute.
 *
 * This causes Drupal search to not index all content after the icon.
 */
function dynamo_filefield_icon($file) {
  if (is_object($file)) {
    $file = (array) $file;
  }
  $mime = check_plain($file['filemime']);

  $dashed_mime = strtr($mime, array('/' => '-'));

  if ($icon_url = filefield_icon_url($file)) {
    $icon = '<img alt="'. $mime .' icon" src="'. $icon_url .'" />';
  }
  return $icon;
}

function dynamo_checkbox($element) {
  if (!$element['#disabled']) {
    _form_set_class($element, array('checkbox'));
    $checkbox = '<input ';
    $checkbox .= 'type="checkbox" ';
    $checkbox .= 'name="'. $element['#name'] .'" ';
    $checkbox .= 'id="'. $element['#id'] .'" ' ;
    $checkbox .= 'value="'. $element['#return_value'] .'" ';
    $checkbox .= $element['#value'] ? ' checked="checked" ' : ' ';
    $checkbox .= drupal_attributes($element['#attributes']) .' />';

    if (!is_null($element['#title'])) {
      $checkbox = '<label class="form-option" for="'. $element['#id'] .'">'. $checkbox .' '. $element['#title'] .'</label>';
    }
  }
  else {
    $alt = (isset($element['#disabled_text'])) ? $element['#disabled_text'] : '';

    $checkbox = theme('image', path_to_theme() . '/images/checkbox-blocked.jpg', $alt, $alt);
    if (!is_null($element['#title'])) {
      $checkbox = '<span class="form-option form-label">'. $checkbox .' '. $element['#title'] .'</span>';
    }
  }

  unset($element['#title']);

  return theme('form_element', $element, $checkbox);
}

/**
 * Overrides default date popup implementation by removing the id attribute
 * from the parent label. It generates a for="[id]" attribute refering to
 * a non-existing element. This is invalid XHTML.
 *
 * @see theme_date_popup
 */
function dynamo_date_popup($element) {
  $element['#id']=$element['date']['#id'];
  //Run default date popup implementation.
  return theme_date_popup($element);
}


/**
 * Variation of form_get_error which will check child elements for some element types.
 * @see form_get_error
 */
function dynamo_get_error($element) {
  if ($element['#type'] == 'date_popup') {
    foreach(element_children($element) as $child) {
      if ($errors = form_get_error($element[$child])) {
        return $errors;
      }
    }
  } else {
    return form_get_error($element);
  }
}

/**
 * Shortcut function to help with the laborious date_format_date syntax.
 *
 * @param $date
 *   DateTime object.
 * @param $format
 *   Custom time format.
 * @param $langcode
 *   Language for use when formatting. Defaults to Danish.
 * @return
 *   Formatted date string.
 */
function dynamo_datef($date, $format, $langcode = 'da') {
  return date_format_date($date, 'custom', $format, $langcode);
}

