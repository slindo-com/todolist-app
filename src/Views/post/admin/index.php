<?php require(__DIR__ . "/../../layout/header.php"); ?>

<br /> <br />

<h3>Posts verwalten</h3>

<ul>
  <?php foreach ($all AS $entry): ?>
    <li>
      <a href="posts-edit?id=<?php echo e($entry->id); ?>">
        <?php echo e($entry->title); ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<?php require(__DIR__ . "/../../layout/footer.php"); ?>
