<!DOCTYPE html>
<html lang="en" <?php
                if (!$this->ion_auth->in_group(array('superadmin'))) {

                  $this->db->where('hospital_id', $this->hospital_id);
                  $settings_lang = $this->db->get('settings')->row()->language;
                  if ($this->language == 'arabic') {
                ?> dir="rtl" <?php } else { ?> dir="ltr" <?php
                                                        }
                                                      } else {
                                                        $this->db->where('hospital_id', 'superadmin');
                                                        $settings_lang = $this->db->get('settings')->row()->language;
                                                        if ($this->language == 'arabic') {
                                                          ?> dir="rtl" <?php } else { ?> dir="ltr" <?php
                                                                                                  }
                                                                                                }
                                                                                                    ?>>

<head>
  <base href="<?php echo base_url(); ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  $class_name = $this->router->fetch_class();
  $class_name_lang = lang($class_name);
  if (empty($class_name_lang)) {
    $class_name_lang = $class_name;
  }
  ?>

  <title> <?php echo $class_name_lang; ?> |
    <?php
    if ($this->ion_auth->in_group(array('superadmin'))) {
      $this->db->where('hospital_id', 'superadmin');
    } else {
      $this->db->where('hospital_id', $this->hospital_id);
    }
    ?>
    <?php
    $settings = $this->db->get('settings')->row();
    echo $settings->system_vendor;
    ?>
  </title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="common/assets/bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- Elite Admin Theme -->
  <link rel="stylesheet" href="common/assets/bootstrap5/css/elite-admin.css">
  <link rel="stylesheet" href="common/assets/bootstrap5/css/elite-utilities.css">
  
  <!-- Migration Helper CSS -->
  <link rel="stylesheet" href="common/assets/bootstrap5/css/bootstrap-migration.css">
  
  <!-- Google Fonts CSS -->
  <link rel="stylesheet" href="common/assets/bootstrap5/css/fonts.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  <!-- Daterange picker -->
  <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
  
  <!-- summernote -->
  <link rel="stylesheet" href="adminlte/plugins/summernote/summernote-bs5.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="adminlte/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="adminlte/plugins/datatables-responsive/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="adminlte/plugins/datatables-buttons/css/buttons.bootstrap5.min.css">

  <link rel="stylesheet" href="adminlte/dist/css/changes.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="adminlte/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css">
  
  <!-- Fullcalendar -->
  <link rel="stylesheet" href="adminlte/plugins/fullcalendar/main.css">
  <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">

  <!-- Legacy datepicker libraries - to be migrated -->
  <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
  <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
  <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
  <link rel="stylesheet" href="common/assets/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
  <link rel="stylesheet" type="text/css" href="common/css/lightbox.css" />

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <!-- Toastr -->
  <link rel="stylesheet" href="adminlte/plugins/toastr/toastr.min.css">

  <!-- dropzonejs -->
  <link rel="stylesheet" href="adminlte/plugins/dropzone/min/dropzone.min.css">

  <?php
  if ($this->language == 'arabic') { ?>
    <link rel="stylesheet" href="common/assets/bootstrap5/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/rtl.css">
  <?php } ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php
    // Define flagIcon based on the current language
    $flagIcon = 'us'; // Default flag
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

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Search Form -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar rounded-pill" type="search" placeholder="Search & enter" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
          <?php if (in_array('chat', $this->modules)) { ?>
            <li class="nav-item">
              <a class="nav-link" href="chat">
                <i class="far fa-comments"></i>
                <span class="badge badge-info rounded-pill navbar-badge" id="chatCount"></span>
              </a>
            </li>
          <?php } ?>
        <?php } ?>
        
        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning rounded-pill navbar-badge">
                <?php
                  $count = 0;
                  if (in_array('finance', $this->modules)) {
                    $this->db->where('hospital_id', $this->hospital_id);
                    $this->db->where('date', date('m/d/y'));
                    $count += $this->db->get('payment')->num_rows();
                  }
                  if (in_array('appointment', $this->modules)) {
                    $this->db->where('hospital_id', $this->hospital_id);
                    $this->db->where('date', date('d-m-Y'));
                    $count += $this->db->get('appointment')->num_rows();
                  }
                  echo $count;
                ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header"><?php echo $count; ?> Notifications</span>
              <div class="dropdown-divider"></div>
              
              <?php if (in_array('finance', $this->modules)) { ?>
                <a href="finance/payment" class="dropdown-item">
                  <i class="fas fa-money-check mr-2"></i> <?php echo lang('payments_today'); ?>
                  <span class="float-right text-muted text-sm">
                    <?php
                      $this->db->where('hospital_id', $this->hospital_id);
                      $this->db->where('date', date('m/d/y'));
                      echo $this->db->get('payment')->num_rows();
                    ?>
                  </span>
                </a>
              <?php } ?>
              
              <?php if (in_array('appointment', $this->modules)) { ?>
                <a href="appointment" class="dropdown-item">
                  <i class="fas fa-calendar-check mr-2"></i> <?php echo lang('appointments_today'); ?>
                  <span class="float-right text-muted text-sm">
                    <?php
                      $this->db->where('hospital_id', $this->hospital_id);
                      $this->db->where('date', date('d-m-Y'));
                      echo $this->db->get('appointment')->num_rows();
                    ?>
                  </span>
                </a>
              <?php } ?>
            </div>
          </li>
        <?php } ?>

        <!-- Language Dropdown Menu -->
        <?php if ($this->ion_auth->in_group(array('admin', 'superadmin'))) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="">
              <i class="flag-icon flag-icon-<?php echo $flagIcon; ?>"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
              <a href="settings/changeLanguageFlag?lang=arabic" class="dropdown-item <?php if ($this->language == 'arabic') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-sa mr-2"></i> عربى
              </a>
              <a href="settings/changeLanguageFlag?lang=english" class="dropdown-item <?php if ($this->language == 'english') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-us mr-2"></i> English
              </a>
              <a href="settings/changeLanguageFlag?lang=spanish" class="dropdown-item <?php if ($this->language == 'spanish') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-es mr-2"></i> Español
              </a>
              <a href="settings/changeLanguageFlag?lang=french" class="dropdown-item <?php if ($this->language == 'french') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-fr mr-2"></i> Français
              </a>
              <a href="settings/changeLanguageFlag?lang=italian" class="dropdown-item <?php if ($this->language == 'italian') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-it mr-2"></i> Italiano
              </a>
              <a href="settings/changeLanguageFlag?lang=portuguese" class="dropdown-item <?php if ($this->language == 'portuguese') {
                                                                                            echo 'active';
                                                                                          } ?>">
                <i class="flag-icon flag-icon-pt mr-2"></i> Português
              </a>
              <a href="settings/changeLanguageFlag?lang=turkish" class="dropdown-item <?php if ($this->language == 'turkish') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-tr mr-2"></i> Türkçe
              </a>
            </div>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a class="nav-link" title="<?php echo lang('full_screen'); ?>" data-widget="fullscreen" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" title="<?php echo lang('log_out'); ?>" href="auth/logout" role="button">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home" class="brand-link">
        <?php if (!$this->ion_auth->in_group(array('superadmin'))) { ?>
          <img src="<?php echo $settings->logo_title; ?>" alt="HMS" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?php echo $settings->title; ?></span>
        <?php } else { ?>
          <img src="<?php echo $settings->logo_title; ?>" alt="HMS" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?php echo $settings->title; ?></span>
        <?php } ?>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <?php if ($this->ion_auth->in_group(array('admin'))) {
              $user = $this->db->get_where('users', array('id' => $this->ion_auth->get_user_id()))->row();
            ?>

            <?php } elseif ($this->ion_auth->in_group(array('superadmin'))) {
              $user = $this->db->get_where('superadmin', array('ion_user_id' => $this->ion_auth->get_user_id()))->row();
            } else {

              $user_id = $this->ion_auth->get_user_id(); // Get the user ID
              $groups = $this->ion_auth->get_users_groups($user_id)->result();
              foreach ($groups as $group) {
                $group_name = strtolower($group->name);
              }
              $user = $this->db->get_where($group_name, array('ion_user_id' => $user_id))->row();
            ?>
            <?php } ?>
            <img src="<?php echo $user->img_url; ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="profile" class="d-block"> <?php
                                                $username = $this->ion_auth->user()->row()->username;
                                                if (!empty($username)) {
                                                  echo $username;
                                                }
                                                ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



            <?php $this->load->view('menu'); ?>

            <?php
            //  $this->load->view('menu_demo');
            ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->