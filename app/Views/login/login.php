<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIDUDCHA | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.css">
</head>

<body class="hold-transition login-page ">
  <div class="login-box shadow">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">

        <a href="<?= base_url('login') ?>" class="h2" style="color:black"><i class="fas fa-warehouse"></i>
          <br>
          <b>INVENTORY DUDCHA</b>
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg" style="color:black">Sign in to start your session</p>

        <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-ban"></i>
            <?php echo session()->getFlashdata('error'); ?>
          </div>
        <?php endif; ?>

        <form id="formLogin" action="<?= base_url('login/process') ?>" method="post">
          <?= csrf_field(); ?>
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
  <!-- jquery-validation -->
  <script src="<?= base_url() ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?= base_url() ?>/plugins/jquery-validation/additional-methods.min.js"></script>
  <script>
    $(function() {
      $.validator.setDefaults({
        submitHandler: function() {
          e.preventDefault(); // avoid to execute the actual submit of the form.

          var form = $(this);
          var url = form.attr('action');

          $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
          });
        }
      });
      $('#formLogin').validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 8,
          },
        },
        messages: {
          email: {
            required: "Email tidak boleh kosong",
            email: "Format email tidak sesuai"
          },
          password: {
            required: "Password tidak boleh kosong",
            minlength: "Password kurang dari 8 karakter"
          },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
</body>

</html>