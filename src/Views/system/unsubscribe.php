<?php require __DIR__ . "/../layout/header.php";?>


<section class="small-container">
  <h2 class="mb-2">
    Unsubscribe
  </h2>
  <?php if ($unsubscribed): ?>
    <p>
      You are now unsubscribed from all our emails and should not receive any more of them!
    </p>
  <?php else: ?>
    <p class="mb-4">
      You are on this page, because do not want to get any more emails from this website. We try to not deliver any unwanted emails. Please confirm by clicking the button below and you never will hear again from us. Promise!
    </p>

    <form method="POST">
      <footer>
        <header>

        </header>
        <input type="hidden" name="token" value="<?php e($token);?>">
        <button type="submit" name="a" value="unsubscribe" class="btn">
          Unsubscribe From All Emails
        </button>
      </footer>

    </form>
  <?php endif;?>


</section>



<?php require __DIR__ . "/../layout/footer.php";?>
