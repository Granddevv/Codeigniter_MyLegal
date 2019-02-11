<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Legal Advice</title>

	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css"> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/css/bootstrap-theme.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>components/select2/dist/css/select2.css">

  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style2.css"> -->

  <!-- NEW DESIGN CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/design/css/css.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/design/css/css2.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/fortawesome/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/check_radio_master/awesome-bootstrap-checkbox.css">

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>components/select2/dist/js/select2.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-repeater.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>

<body>


<?php 
if($this->session->userdata("user_id")) { 
  $total_unread = $this->messaging->count_unread_message(FALSE, $this->session->userdata("user_id"));
  $inst = get_instance();
?>

  <aside class="main-sidebar" id="smaller_sidebar" style="border:1px solid #F1F1F1;">
        <ul class="sidebar-menu">
          <li class="header main-side-logo text-center"><img src="<?php echo base_url('assets/design/images/sm_logo_only.png'); ?>" alt="LOGO" /></li>
          <?php if($inst->doesHaveAccess("jobs", "index")) { ?>
            <li class="side-logo <?php echo active_link('jobs', ''); ?>"> <a href="<?php echo base_url(); ?>jobs"><img src="<?php echo base_url('assets/design/images/side_home'.active_link('jobs', '', NULL, TRUE).'.png'); ?>" alt="LOGO" /><span class="hide_label" style="display:none;">Dashboard</span></a></li>
          <?php } if($inst->doesHaveAccess("mail", "index")) { ?>
            <li class="side-logo <?php echo active_link('mail', 'index'); ?>"><a href="<?php echo base_url(); ?>mail"><img src="<?php echo base_url('assets/design/images/side_envelope'.active_link('mail', 'index', NULL, TRUE).'.png'); ?>" alt="LOGO" /><span class="hide_label" style="display:none;">Mail</span></a></li>
          <?php } if($inst->doesHaveAccess("messaging", "conversations")) { ?>
            <li class="side-logo <?php echo active_link('messaging', ''); ?>">
              <a href="<?php echo base_url(); ?>conversations"><img src="<?php echo base_url('assets/design/images/side_envelope'.active_link('messaging', '', NULL, TRUE).'.png'); ?>" alt="LOGO" />
                <span class="hide_label" style="display:none;">
                  Messages
                </span>
                <div class="badge has_new_message" style="background-color: #DC3545"><?php if($total_unread > 0) { echo $this->messaging->count_unread_message(FALSE, $this->session->userdata("user_id")); } ?></div>
              </a>
            </li>
          <?php } if($inst->doesHaveAccess("practice_management", "index")) {
              $inst->load->model("practice_management_model", "pm");
              $lawyer_information = $inst->pm->get_lawyer_information($this->session->userdata("user_id"));
              if($lawyer_information && isset($lawyer_information->manager) && $lawyer_information->manager == 1) {
            ?>
              <li class="side-logo <?php echo active_link('practice_management', ''); ?>">
                <a href="<?php echo base_url(); ?>practice_management/index"><img src="<?php echo base_url('assets/design/images/side_envelope'.active_link('practice_management', '', NULL, TRUE).'.png'); ?>" alt="LOGO" />
                  <span class="hide_label" style="display:none;">
                    Manage Practice
                  </span>
                </a>
              </li>
          <?php } // closing inside if ?>
          <?php } if($inst->doesHaveAccess("Admin", "index")) { ?>
              <li class="side-logo">
                <a href="<?php echo base_url(); ?>admin/fee_settings"><img src="<?php echo base_url('assets/design/images/side_envelope'.active_link('practice_management', '', NULL, TRUE).'.png'); ?>" alt="LOGO" />
                  <span class="hide_label" style="display:none;">
                    System Admin
                  </span>
                </a>
              </li>
            <!-- <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Panel <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>admin/fee_settings">System Settings</a></li>
                  <li><a href="<?php // echo base_url(); ?>admin/fee_settings">Fee Settings </li>
                  <li><a href="<?php echo base_url(); ?>admin/billing_settings">Billing List</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/email_template">Email Template</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/access_control">User Access Control</a></li>
                   <li><a href="<?php echo base_url(); ?>admin_law_categories">Categories of Law (frontend)</a></li>
                   <li><a href="<?php echo base_url(); ?>admin_area_options">Manage Job Options (frontend)</a></li>
                   <li><a href="<?php echo base_url(); ?>admin/questions">Job Creation Questions</a></li>
                   <li role="separator" class="divider"></li>
                    <li><a href="<?php echo base_url(); ?>admin_lawyer_profile_categories">Lawyer Profile Categories</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_areas"> <i class="fa fa-angle-right"></i>  Areas of Law</a></li>
                  <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Manage Dropdown</li>
                    <li><a href="<?php echo base_url(); ?>dropdown_manager"><i class="fa fa-angle-right"></i> Languages</a></li>
                    <li><a href="<?php echo base_url("dropdown_manager/ethnicity"); ?>"><i class="fa fa-angle-right"></i> Ethnicity</a></li>
                    <li><a href="<?php echo base_url("dropdown_manager/gender"); ?>"><i class="fa fa-angle-right"></i> Gender</a></li>
                </ul>
              </li>
            </ul> -->
          <?php } ?>
            <li class="side-logo <?php echo active_link('account', 'profile'); ?>"><a href="<?php echo base_url(); ?>account/profile"><img src="<?php echo base_url('assets/design/images/side_profile'.active_link('account', 'profile', NULL, TRUE).'.png'); ?>" alt="LOGO" /><span class="hide_label" style="display:none;">Profile</span></a></li>
            <li class="side-logo"><a href="<?php echo base_url(); ?>auth/logout"><img src="<?php echo base_url('assets/design/images/side_home.png'); ?>" alt="LOGO" /><span class="hide_label" style="display:none;">Logout</span></a></li>
        </ul>
      </section>
  </aside>
  <div id="backdrop" style="display: none"></div>


  <nav class="navbar navbar-default" style="display: none;">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!-- <li><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>-->

          <?php if($inst->doesHaveAccess("jobs", "index")) { ?>
            <li class="<?php echo active_link('jobs', 'index'); ?>">
        			<a href="<?php echo base_url(); ?>jobs">
        				Dashboard
        			</a>
        		</li>
          <?php } if($inst->doesHaveAccess("jobs", "create")) { ?>
        	  <li class="<?php echo active_link('jobs', 'create'); ?>">
              <a href="<?php echo base_url(); ?>jobs/create">
                Create Job
              </a>
            </li>
          <?php } if($inst->doesHaveAccess("jobs", "my_jobs")) { ?>
            <li class="<?php echo active_link('jobs', 'my_jobs'); ?>">
              <a href="<?php echo base_url(); ?>jobs/my_jobs">
                My Jobs
              </a>
            </li>
          <?php } if($inst->doesHaveAccess("mail", "index")) { ?>
        		<li class="<?php echo active_link('mail'); ?>">
        			<a href="<?php echo base_url(); ?>mail">
        				Mail
        			</a>
        		</li>
          <?php } if($inst->doesHaveAccess("practice_management", "index")) {
              $inst->load->model("practice_management_model", "pm");
              $lawyer_information = $inst->pm->get_lawyer_information($this->session->userdata("user_id"));
              if($lawyer_information && isset($lawyer_information->manager) && $lawyer_information->manager == 1) {
            ?>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Practice Management <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>practice_management/index">Lawyers</a></li>
                  <li><a href="<?php echo base_url(); ?>practice_management/billing">Billing</a></li>
                </ul>
              </li>
            </ul>
          <?php 
            }
          } if($inst->doesHaveAccess("messaging", "conversations")) { ?>
            <li class="<?php echo active_link('conversations'); ?>">
              <a href="<?php echo base_url(); ?>conversations">
                Messages
                  <span class="badge has_new_message" style="background-color: #DC3545"><?php if($total_unread > 0) { echo $this->messaging->count_unread_message(FALSE, $this->session->userdata("user_id")); } ?></span>
              </a>
            </li>
          <?php } if($inst->doesHaveAccess("Admin", "index")) { ?>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Panel <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>admin/fee_settings">System Settings</a></li>
                  <!-- <li><a href="<?php // echo base_url(); ?>admin/fee_settings">Fee Settings </li> -->
                  <li><a href="<?php echo base_url(); ?>admin/billing_settings">Billing List</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/email_template">Email Template</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/access_control">User Access Control</a></li>
                   <li><a href="<?php echo base_url(); ?>admin_law_categories">Categories of Law (frontend)</a></li>
                   <li><a href="<?php echo base_url(); ?>admin_area_options">Manage Job Options (frontend)</a></li>
                   <li><a href="<?php echo base_url(); ?>admin/questions">Job Creation Questions</a></li>
                   <li role="separator" class="divider"></li>
                    <li><a href="<?php echo base_url(); ?>admin_lawyer_profile_categories">Lawyer Profile Categories</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_areas"> <i class="fa fa-angle-right"></i>  Areas of Law</a></li>
                  <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Manage Dropdown</li>
                    <li><a href="<?php echo base_url(); ?>dropdown_manager"><i class="fa fa-angle-right"></i> Languages</a></li>
                    <li><a href="<?php echo base_url("dropdown_manager/ethnicity"); ?>"><i class="fa fa-angle-right"></i> Ethnicity</a></li>
                    <li><a href="<?php echo base_url("dropdown_manager/gender"); ?>"><i class="fa fa-angle-right"></i> Gender</a></li>
                </ul>
              </li>
            </ul>
          <?php } ?>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url(); ?>account/profile">Profile</a></li>
              <li><a href="<?php echo base_url(); ?>auth/logout">Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
<?php } ?>

<div class="container">