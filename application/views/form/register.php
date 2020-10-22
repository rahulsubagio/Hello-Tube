<body class="text-center">
  <form class="form-signin" action="<?= base_url('auth/register') ?>" method="POST">
    <img class="mb-4" src="<?= base_url('assets/') ?>gambar/logo.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 font-weight-normal">Create Account</h1>
    <?php if ($this->session->flashdata('failed')) : ?>
      <?= $this->session->flashdata('failed') ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('failed1')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata('failed1') ?>
      </div>
    <?php endif; ?>
    <div class="form-row">
      <input type="text" id="name" name="name" class="form-control" placeholder="Name" required autofocus>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
      <input type="password" id="password" name="password" class="form-control col-md-6" placeholder="Password" required>
      <input type="password" id="password1" name="password1" class="form-control col-md-6" placeholder="Repeat Password" required>
    </div>
    <div class="text-center">
      <a class="note text-decoration-none" href="<?= base_url('auth') ?>">Already have an account? <b>Login!</b></a>
    </div>
    <hr>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
  </form>
</body>

</html>