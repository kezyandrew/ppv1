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

  <!-- <link rel="stylesheet" href="common/css/bootstrap-select.min.css"> -->

  <!-- Google Fonts -->




  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="adminlte/plugins/summernote/summernote-bs4.min.css">


  <link rel="stylesheet" href="adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


  <link rel="stylesheet" href="adminlte/dist/css/changes.css">

  <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">


  <link rel="stylesheet" href="adminlte/plugins/fullcalendar/main.css">
  <link rel="stylesheet" href="adminlte/plugins/flag-icon-css/css/flag-icon.min.css">

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
    <link rel="stylesheet" href="adminlte/dist/css/rtl.css">
  <?php } ?>

  <!-- <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css"> -->

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>


        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->


        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <?php echo lang('quick_links'); ?>
              <span class="badge badge-info navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                <?php if (in_array('finance', $this->modules)) { ?>
                  <a href="finance/addPaymentView" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('add_payment'); ?>
                          <span class="float-right text-sm text-danger"><i class="fas fa-money-check"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>



              <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                <?php if (in_array('appointment', $this->modules)) { ?>
                  <a href="appointment/addNewView" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('add_appointment'); ?>
                          <span class="float-right text-sm text-danger"><i class="fas fa-calendar-check"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>



              <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                <?php if (in_array('patient', $this->modules)) { ?>
                  <a href="patient/addNewView" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('add_patient'); ?>
                          <span class="float-right text-sm text-danger"><i class="fas fa-user"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>



              <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <?php if (in_array('doctor', $this->modules)) { ?>
                  <a href="doctor/addNewView" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('add_doctor'); ?>
                          <span class="float-right text-sm text-danger"><i class="fas fa-user"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>



              <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                <?php if (in_array('prescription', $this->modules)) { ?>
                  <a href="prescription/addPrescriptionView" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('add_prescription'); ?>
                          <span class="float-right text-sm text-danger"><i class="fas fa-user"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>

              <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                <?php if (in_array('lab', $this->modules)) { ?>
                  <a href="lab" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('lab'); ?> <?php echo lang('reports'); ?>
                          <span class="float-right text-sm text-danger"><i class="fa fa-flask"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>

              <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                <?php if (in_array('finance', $this->modules)) { ?>
                  <a href="finance/dueCollection" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php echo lang('due_collection'); ?>
                          <span class="float-right text-sm text-danger"><i class="fas fa-money-check"></i></span>
                        </h3>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                <?php } ?>
              <?php } ?>




            </div>
          </li>
        <?php } ?>



        <!-- Messages Dropdown Menu -->

        <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
          <?php if (in_array('chat', $this->modules)) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link" href="chat">
                <i class="far fa-comments"></i>
                <span class="badge badge-info navbar-badge" id="chatCount"></span>
              </a>
            </li>
          <?php } ?>
        <?php } ?>
        <!-- Notifications Dropdown Menu -->


        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse'))) : ?>
          <?php if (in_array('bed', $this->modules)) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-procedures"></i>
                <?php
                $this->db->where('hospital_id', $this->hospital_id);
                $query = $this->db->get('bed')->result();
                $available_bed = 0;
                foreach ($query as $bed) {
                  $last_a_time = explode('-', $bed->last_a_time);
                  $last_d_time = explode('-', $bed->last_d_time);
                  if (!empty($last_d_time[1])) {
                    $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                    $last_d_h = explode(':', $last_d_h_am_pm[1]);
                    if ($last_d_h_am_pm[2] == 'AM') {
                      $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                    } else {
                      $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                    }
                    $last_d_time_s = strtotime($last_d_time[0]) + $last_d_m;
                    if (time() > $last_d_time_s) {
                      $available_bed = $available_bed + 1;
                    }
                  } else {
                    $available_bed = $available_bed + 1;
                  }
                }
                ?>
                <span class="badge badge-success navbar-badge"><?= $available_bed; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?= $available_bed; ?>
                  <?php if ($available_bed <= 1) {
                    echo lang('bed_is_available');
                  } else {
                    echo lang('beds_are_available');
                  } ?>
                </span>
                <div class="dropdown-divider"></div>
                <a href="bed/bedAllotment" class="dropdown-item">
                  <?php if ($available_bed > 0) : ?>
                    <?= lang('add_a_allotment'); ?>
                  <?php else : ?>
                    <?= lang('no_bed_is_available_for_allotment'); ?>
                  <?php endif; ?>
                  <span class="float-right text-muted text-sm"><?= ($available_bed > 0) ? 'Available' : 'Not Available'; ?></span>
                </a>
                <!-- Add more notifications or a footer link similar to "See All Notifications" if needed -->
              </div>
            </li>
          <?php endif; ?>
        <?php endif; ?>


        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) : ?>
          <?php if (in_array('finance', $this->modules)) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-money-check"></i>
                <?php
                $this->db->where('hospital_id', $this->hospital_id);
                $query = $this->db->get('payment');
                $query = $query->result();
                $payment_number = 0;
                foreach ($query as $payment) {
                  $payment_date = date('y/m/d', $payment->date);
                  if ($payment_date == date('y/m/d')) {
                    $payment_number++;
                  }
                }
                ?>
                <span class="badge badge-danger navbar-badge"><?= $payment_number; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?= $payment_number; ?>
                  <?php if ($payment_number <= 1) {
                    echo lang('payment_today');
                  } else {
                    echo lang('payments_today');
                  } ?>
                </span>
                <div class="dropdown-divider"></div>
                <a href="finance/payment" class="dropdown-item">
                  <?= lang('see_all_payments'); ?>
                  <span class="float-right text-muted text-sm"><?= ($payment_number > 0) ? 'Available' : 'Not Available'; ?></span>
                </a>
                <!-- Add more notifications or a footer link similar to "See All Notifications" if needed -->
              </div>
            </li>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($this->ion_auth->in_group(['admin', 'Accountant', 'Doctor', 'Nurse', 'Laboratorist'])) : ?>
          <?php if (in_array('patient', $this->modules)) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user"></i>
                <?php
                $this->db->where('hospital_id', $this->hospital_id);
                $this->db->where('add_date', date('m/d/y'));
                $query = $this->db->get('patient');
                $query = $query->result();
                $patient_number = count($query);
                ?>
                <span class="badge badge-warning navbar-badge"><?= $patient_number; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                  <?= $patient_number; ?>
                  <?php if ($patient_number <= 1) : ?>
                    <?= lang('patient_registerred_today'); ?>
                  <?php else : ?>
                    <?= lang('patients_registerred_today'); ?>
                  <?php endif; ?>
                </span>
                <div class="dropdown-divider"></div>
                <a href="patient" class="dropdown-item">
                  <?= lang('see_all_patients'); ?>
                  <span class="float-right text-muted text-sm"><?= ($patient_number > 0) ? 'Available' : 'Not Available'; ?></span>
                </a>
                <!-- Add more notifications or a footer link similar to "See All Notifications" if needed -->
              </div>
            </li>
          <?php endif; ?>
        <?php endif; ?>

        <?php

        if ($this->language == 'arabic') {
          $flagIcon = 'sa';
        }
        if ($this->language == 'english') {
          $flagIcon = 'us';
        }
        if ($this->language == 'spanish') {
          $flagIcon = 'es';
        }
        if ($this->language == 'french') {
          $flagIcon = 'fr';
        }
        if ($this->language == 'italian') {
          $flagIcon = 'it';
        }
        if ($this->language == 'portuguese') {
          $flagIcon = 'pt';
        }
        if ($this->language == 'turkish') {
          $flagIcon = 'tr';
        }
        ?>

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

        <?php if ($this->ion_auth->in_group(array('Patient', 'Doctor'))) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="">
              <i class="flag-icon flag-icon-<?php echo $flagIcon; ?>"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
              <a href="profile/changeLanguageFlag?lang=arabic" class="dropdown-item <?php if ($this->language == 'arabic') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-sa mr-2"></i> عربى
              </a>
              <a href="profile/changeLanguageFlag?lang=english" class="dropdown-item <?php if ($this->language == 'english') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-us mr-2"></i> English
              </a>
              <a href="profile/changeLanguageFlag?lang=spanish" class="dropdown-item <?php if ($this->language == 'spanish') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-es mr-2"></i> Español
              </a>
              <a href="profile/changeLanguageFlag?lang=french" class="dropdown-item <?php if ($this->language == 'french') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-fr mr-2"></i> Français
              </a>
              <a href="profile/changeLanguageFlag?lang=italian" class="dropdown-item <?php if ($this->language == 'italian') {
                                                                                        echo 'active';
                                                                                      } ?>">
                <i class="flag-icon flag-icon-it mr-2"></i> Italiano
              </a>
              <a href="profile/changeLanguageFlag?lang=portuguese" class="dropdown-item <?php if ($this->language == 'portuguese') {
                                                                                            echo 'active';
                                                                                          } ?>">
                <i class="flag-icon flag-icon-pt mr-2"></i> Português
              </a>
              <a href="profile/changeLanguageFlag?lang=turkish" class="dropdown-item <?php if ($this->language == 'turkish') {
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