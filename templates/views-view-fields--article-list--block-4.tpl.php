<?php foreach ($fields as $id => $field): ?>

  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>


  <<?php print $field->inline_html;?> class="<?php print $field->class; ?>">
    <?php if ($field->label): ?>
      <label>
        <?php print $field->label; ?>:
      </label>
    <?php endif; ?>

    <?php
      // $field->element_type is either SPAN or DIV depending upon whether or not
      // the field is a 'block' element type or 'inline' element type.
      //if theres not a field label defined then we wont print the span/div
    ?>

    <?php if ($field->label): ?>
      <<?php print $field->element_type; ?>>
    <?php endif; ?>
    
      <?php print $field->content; ?>
    
    <?php if ($field->label): ?>
      </<?php print $field->element_type; ?>>
    <?php endif; ?>

  </<?php print $field->inline_html;?>>

<?php endforeach; ?>
