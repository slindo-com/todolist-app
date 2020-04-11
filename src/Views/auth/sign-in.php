<?php require __DIR__ . "/../layout/header.php";?>


<section class="small-container">
  <h2 class="mb-2">
    Sign In
  </h2>

  <?php if (!empty($error)): ?>
    <p class="err">
      Die Kombination aus Benutzername und Passwort ist falsch.
    </p>
  <?php endif;?>

  <form method="POST" class="form shadow">

    <label for="e">
      E-Mail:
    </label>
    <input placeholder="Type here…" type="email" name="email" id="e" required autofocus>

    <label for="p">
      Password:
    </label>
    <input placeholder="The password for your account" type="password" name="password" id="p" minlength="6" required>

    <footer>
      <button type="submit" name="a" value="sign-in" class="btn">
        Sign In
      </button>
      <span>
        or
        <a href="/new-account/">
          create a new account
        </a>
      </span>
    </footer>

  </form>

  <a href="/new-password/" class="mt-2">
    Get a new password
  </a>

</section>



<?php require __DIR__ . "/../layout/footer.php";?>
