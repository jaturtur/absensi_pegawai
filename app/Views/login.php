<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Sign In | PlainAdmin Demo</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css')  ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader End =========== -->

    <!-- ========== Signin Section Start ========== -->
    <section class="signin-section">
      <div class="container-fluid">
        <div class="row g-0 auth-row">
          <div class="col-lg-6">
            <div class="auth-cover-wrapper bg-primary-100">
              <div class="auth-cover">
                <div class="title text-center">
                  <h1 class="text-primary mb-10">Selamat Datang</h1>
                  <p class="text-medium">Silahkan login dengan akun Anda</p>
                </div>
                <div class="cover-image">
                  <img src="<?= base_url('assets/images/auth/signin-image.svg') ?>">
                </div>
                <div class="shape-image">
                  <img src="<?= base_url('assets/images/auth/shape.svg') ?>">
                </div>
              </div>
            </div>
          </div>

          <!-- Login Form -->
          <div class="col-lg-6">
            <div class="signin-wrapper">
              <div class="form-wrapper">
                <h6 class="mb-15">Login Form</h6>
                <p class="text-sm mb-25">Jangan lupa login terlebih dahulu</p>

                <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif ?>

                <form method="POST" action="<?= base_url('login'); ?>">
                  <div class="row">
                    <!-- Username Input -->
                    <div class="col-12">
  <div class="input-style-1 position-relative d-flex align-items-center">
 
    <div class="position-relative w-100">
      <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
             placeholder="Username" name="username" id="username"/>
      <span class="position-absolute top-50 end-0 translate-middle-y me-3 d-flex align-items-center">
        <i class="ti ti-user-circle fs-5"></i>
      </span>
    </div>
    <div class="invalid-feedback">
      <?= $validation->getError('username') ?>
    </div>
  </div>
</div>


                    <!-- Password Input -->
                    <div class="col-12">
  <div class="input-style-1 position-relative d-flex align-items-center">
   
    <div class="position-relative w-100">
      <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
             placeholder="Password" name="password" id="password"/>
      <span class="position-absolute top-50 end-0 translate-middle-y me-3 d-flex align-items-center" onclick="togglePassword()" style="cursor:pointer;">
        <i id="eyeIcon" class="ti ti-eye fs-5"></i>
      </span>
    </div>
    <div class="invalid-feedback">
      <?= $validation->getError('password') ?>
    </div>
  </div>
</div>
                    <!-- Submit Button -->
                    <div class="col-12">
                      <div class="button-group d-flex justify-content-center flex-wrap">
                        <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                          Log In
                        </button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <!-- End Login Form -->
        </div>
      </div>
    </section>
    <!-- ========== Signin Section End ========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- Toggle Password Visibility -->
    <script>
      function togglePassword() {
        let passwordInput = document.getElementById("password");
        let eyeIcon = document.getElementById("eyeIcon");
        
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("ti-eye");
          eyeIcon.classList.add("ti-eye-off");
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("ti-eye-off");
          eyeIcon.classList.add("ti-eye");
        }
      }
    </script>
  </body>
</html>
