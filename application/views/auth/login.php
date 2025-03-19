<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?php echo base_url(); ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo lang('login'); ?> - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>

  <!-- Google Fonts: Nunito Sans for Elite Admin -->
  <link rel="stylesheet" href="common/assets/bootstrap5/fonts.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="common/assets/bootstrap5/bootstrap.min.css">
  <!-- Elite Admin Theme -->
  <link rel="stylesheet" href="common/assets/bootstrap5/elite-admin.css">
  <!-- Migration Helper CSS -->
  <link rel="stylesheet" href="common/assets/bootstrap5/bootstrap-migration.css">
  <!-- Elite Utilities -->
  <link rel="stylesheet" href="common/assets/bootstrap5/elite-utilities.css">
  
  <style>
    body {
      background-color: #eef5f9;
      font-family: 'Nunito Sans', sans-serif;
    }
    
    .login-box {
      max-width: 400px;
      margin: 0 auto;
      padding-top: 100px;
    }
    
    .login-logo {
      text-align: center;
      margin-bottom: 25px;
    }
    
    .login-logo a {
      color: #263238;
      font-size: 24px;
      font-weight: 700;
      text-decoration: none;
    }
    
    .login-card {
      border-radius: 4px;
      box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
      border: none;
    }
    
    .login-card-body {
      padding: 30px;
    }
    
    .login-box-msg {
      text-align: center;
      margin-bottom: 20px;
      font-size: 16px;
      color: #54667a;
    }
    
    .input-group-text {
      background-color: #f8f9fa;
      border-color: #e9ecef;
    }
    
    .language-selector {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
    }
  </style>
</head>

<body>
  <!-- Language Dropdown Menu -->
  <div class="language-selector">
    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        if ($this->language == 'arabic') {
          $flagIcon = 'sa';
        } elseif ($this->language == 'english') {
          $flagIcon = 'us';
        } elseif ($this->language == 'spanish') {
          $flagIcon = 'es';
        } elseif ($this->language == 'french') {
          $flagIcon = 'fr';
        } elseif ($this->language == 'italian') {
          $flagIcon = 'it';
        } elseif ($this->language == 'portuguese') {
          $flagIcon = 'pt';
        } elseif ($this->language == 'turkish') {
          $flagIcon = 'tr';
        }
        ?>
        <span class="text-capitalize me-2"><?php echo $this->language; ?></span>
        <i class="flag-icon flag-icon-<?php echo $flagIcon; ?> ms-1"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
        <li><a href="frontend/changeLanguageFlag?lang=arabic" class="dropdown-item <?php if ($this->language == 'arabic') echo 'active'; ?>">
          <i class="flag-icon flag-icon-sa me-2"></i> عربى
        </a></li>
        <li><a href="frontend/changeLanguageFlag?lang=english" class="dropdown-item <?php if ($this->language == 'english') echo 'active'; ?>">
          <i class="flag-icon flag-icon-us me-2"></i> English
        </a></li>
        <li><a href="frontend/changeLanguageFlag?lang=spanish" class="dropdown-item <?php if ($this->language == 'spanish') echo 'active'; ?>">
          <i class="flag-icon flag-icon-es me-2"></i> Español
        </a></li>
        <li><a href="frontend/changeLanguageFlag?lang=french" class="dropdown-item <?php if ($this->language == 'french') echo 'active'; ?>">
          <i class="flag-icon flag-icon-fr me-2"></i> Français
        </a></li>
        <li><a href="frontend/changeLanguageFlag?lang=italian" class="dropdown-item <?php if ($this->language == 'italian') echo 'active'; ?>">
          <i class="flag-icon flag-icon-it me-2"></i> Italiano
        </a></li>
        <li><a href="frontend/changeLanguageFlag?lang=portuguese" class="dropdown-item <?php if ($this->language == 'portuguese') echo 'active'; ?>">
          <i class="flag-icon flag-icon-pt me-2"></i> Português
        </a></li>
        <li><a href="frontend/changeLanguageFlag?lang=turkish" class="dropdown-item <?php if ($this->language == 'turkish') echo 'active'; ?>">
          <i class="flag-icon flag-icon-tr me-2"></i> Türkçe
        </a></li>
      </ul>
    </div>
  </div>

  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url(); ?>"><b><?php echo $this->db->get('settings')->row()->title; ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card login-card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><?php echo lang('Sign in to start your session') ?></p>

        <?php if (!empty($message)) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>

        <form method="post" action="auth/login">
          <div class="input-group mb-3">
            <input type="email" name="identity" class="form-control" placeholder="<?php echo lang('email') ?>">
            <span class="input-group-text">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
          <div class="input-group mb-4">
            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password') ?>">
            <span class="input-group-text">
              <i class="fas fa-lock"></i>
            </span>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100"><?php echo lang('sign_in') ?></button>
            </div>
          </div>
        </form>
        
        <div class="text-center mt-3">
          <a data-bs-toggle="modal" href="#forgotPasswordModal" class="text-decoration-none">
            <?php echo lang('forgot_your_password') ?>?
          </a>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- Forgot Password Modal -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="auth/forgot_password">
          <div class="modal-header">
            <h5 class="modal-title" id="forgotPasswordModalLabel"><?php echo lang('forgot_your_password') ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><?php echo lang('enter_your_email_address_to_reset_your_password') ?></p>
            <div class="mb-3">
              <input type="email" name="email" class="form-control" placeholder="<?php echo lang('email') ?>" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo lang('cancel') ?></button>
            <button type="submit" class="btn btn-primary" name="submit"><?php echo lang('submit') ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 5 Bundle JS -->
  <script src="common/assets/bootstrap5/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap 5 Migration Helper -->
  <script src="common/assets/bootstrap5/bootstrap-migrate.js"></script>
</body>

</html>