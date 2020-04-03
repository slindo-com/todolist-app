<?php require __DIR__ . "/../layout/header.php"; ?>

<?php if (empty($tokenSent)): ?>
  <section class="small-container">
    <h2>
      Reset Password
    </h2>
    <small class="mb-4">
      Provide your email address below and we will send you instructions on how to reset your password.
    </small>

    <?php if (!empty($error)): ?>
      <p class="err">
        Something went wrong.
      </p>
    <?php endif; ?>

    <form method="POST" class="shadow">

      <label for="e">
        E-Mail:
      </label>
      <input placeholder="Type here…" type="email" name="email" id="e" required autofocus>

      <footer>
        <button type="submit" name="a" value="send-instructions" class="btn">
          Send Reset Instructions
        </button>
        <span>
          or
          <a href="/sign-in/">
            sign in to account
          </a>
        </span>
      </footer>

    </form>

  </section>
<?php else: ?>
  <section class="small-container">
    <h2>
      Instructions sent!
    </h2>
    <p class="mt-2">
      We have emailed you a link to reset your password. Don't forget to check your spam folder.
    </p>
    <a href="/sign-in/" class="mt-2">
      Back to sign in
    </a>
  </section>
<?php endif; ?>



<?php require __DIR__ . "/../layout/footer.php"; ?>
