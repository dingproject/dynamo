<<?php print $options['type']; ?>>
  <?php foreach ($rows as $id => $row): ?>
    <li class="clearfix <?php print $classes[$id]; ?>">
      <?php print $row; ?>
    </li>
  <?php endforeach; ?>
</<?php print $options['type']; ?>>
