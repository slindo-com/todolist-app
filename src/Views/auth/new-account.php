<?php require __DIR__ . "/../layout/header.php"; ?>


<section class="small-container">
  <h2 class="mb-2">
    Create New Account
  </h2>

  <?php if (!empty($error)): ?>
    <p class="err">
      Die Kombination aus Benutzername und Passwort ist falsch.
    </p>
  <?php endif; ?>

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
        Create New Account
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



<?php require __DIR__ . "/../layout/footer.php"; ?>
