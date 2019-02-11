<link rel="stylesheet" href="<?php echo base_url('assets/js/autocomplete/easy-autocomplete.min.css'); ?>">
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/js/autocomplete/easy-autocomplete.themes.min.css'); ?>"> -->
<script src="<?php echo base_url('assets/js/autocomplete/jquery.easy-autocomplete.min.js'); ?>"></script>

<form method="post" enctype="multipart/form-data" style="margin-left:20px;">
    <div class="container">
        <section id="lawyer_signup_section">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="light_font">Lawyer Sign Up</h1>
                    <h2>Sign up for an account</h2>
                </div>
            </div>
        </section>

        <?php echo validation_errors(); ?>
        <?php echo ((!empty($message)) ? $message : ''); ?>


        <section id="section_signup_tabs">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div id="tabs_container">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#about_you" aria-controls="about_you" role="tab" data-toggle="tab">1. About You</a></li>
                            <li role="presentation"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">2. Address</a></li>
                            <li role="presentation"><a href="#qualifications" aria-controls="qualifications" role="tab" data-toggle="tab">3. Qualifications</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="about_you">
                                <div class="form">
                                    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="">What's your first name?</label>
                                                    <input type="text" id="first_name" name="first_name" placeholder="" value="<?php echo set_value('first_name'); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="">What's your last name?</label>
                                                    <input type="text" id="last_name" name="last_name" placeholder="" value="<?php echo set_value('last_name'); ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="">What's your e-mail address?</label>
                                                    <input type="text" id="email" name="email" required value="<?php echo set_value('email'); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password" class="">Password</label>
                                                    <input type="password" id="password" name="password" required value="" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                                
                                                <div class="form-group">
                                                    <label for="user_type">What kind of user are you?</label><br />
                                                    <div class="switch-field">
                                                        <input type="radio" id="part_of" name="user_type" value="1" checked />
                                                        <label class="switch-label" for="part_of"><i class="fa fa-users fa-2x"></i><br /> I am part of an <br />existing practice</label>
                                                        <input type="radio" id="manager_sole" name="user_type" value="2"/>
                                                        <label class="switch-label" for="manager_sole"><i class="fa fa-user fa-2x"></i><br /> I am a Practice Manager<br /> or Sole Operator</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">What's your gender?</label><br />
                                                    <div class="switch-field">
                                                        
                                                        <?php
                                                        foreach($gender_option as $gender) { ?>
                                                            <input type="radio" id="<?php echo $gender->gender; ?>" name="gender" value="2" <?php echo set_radio('gender', $gender->id); ?> />
                                                            <label class="switch-label" for="<?php echo $gender->gender; ?>"><i class="fa fa-men fa-2x"></i><?php echo $gender->gender; ?></label>

                                                            <!-- <input type="radio" id="Gender" name="gender" value="<?php echo $gender->id; ?>" <?php echo set_radio('gender', $gender->id); ?>><?php echo $gender->gender; ?>  -->
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="ptext">
                                                    <label for="usr"> Practice Name:</label>
                                                    <input type="text" class="form-control" id="pname" name="pname" value="<?php echo set_value('pname'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="ptext">
                                                    <label for="file"> Upload a profile photo:</label>
                                                    <input type="file" class="form-control" id="file" name="file">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="language">What languages do you speak?</label>
                                                    <select class="form-control" id="Language" name="language[]" multiple>
                                                        <?php foreach($language_dropdown as $lang) { ?>
                                                            <option value="<?php echo $lang->id; ?>" <?php echo set_select('language[]', $lang->id); ?>><?php echo $lang->language; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>  
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ethnicity">What is your ethnicity?</label>
                                                    <select class="form-control" id="Ethnicity" name="ethnicity[]" multiple>
                                                        <?php foreach($ethnicity_dropdown as $eth) { ?>
                                                            <option value="<?php echo $eth->id; ?>" <?php echo set_select('ethnicity[]', $eth->id); ?>><?php echo $eth->ethnicity; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                <div>
                                    <a class="btn inverted pull-right next_tab">Next</a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="address">
                                <div class="form">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address" class="">What's your practicing address?</label>
                                                    <input type="text" id="address" name="address" placeholder="Address line 1" value="<?php echo set_value('address'); ?>" class="form-control">
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address2">&nbsp;</label>
                                                    <input type="text" name="address2" id="address2" class="form-control" value="<?php echo set_value('address2'); ?>" placeholder="Address line 2">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="suburb" id="suburb" value="<?php echo set_value('suburb'); ?>" placeholder="Suburb">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city'); ?>" placeholder="City">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo set_value('zip_code'); ?>" placeholder="Post Code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <div>
                                    <a class="btn inverted pull-right next_tab">Next</a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="qualifications">
                                <div class="form">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="about" class="">Tell us about you as a lawyer?</label>
                                                    <textarea class="form-control" id="Alawyer" row="3" name="alawyer"><?php echo set_value('alawyer'); ?></textarea>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pcertificate">List of Certificates</label>
                                                    <textarea type="text" name="pcertificate" class="form-control"><?php echo set_value('pcertificate'); ?></textarea>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="about" class="">Tell us your work experience?</label>
                                                    <textarea class="form-control" id="Experience" row="3" name="experience"><?php echo set_value('experience'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="user_type">Proof of Qualification</label>
                                                    <input type="text" class="form-control" id="proof_qualification" name="proof_qualification" value="<?php echo set_value('proof_qualification'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                             <div class="col-md-8">
                                                <div class="form-group">
                                                   <label for="usr">Areas of Specialty:</label>
                                                   <input type="text" class="form-control" id="Specialty" name="specialty" value="<?php echo set_value('specialty'); ?>">
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Signup Fee :</label>
                                                    <input type="text" class="form-control" readonly id="SignFee" name="signFee" value="<?php echo $fees[0]->signup_fee; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="usr">Monthly Fee:</label>
                                                   <input type="text" class="form-control" readonly id="Mfee" name="mfee" value="<?php echo $fees[0]->monthly_fee; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                   <input type="checkbox" id="approved" name="approved" value="1" <?php echo set_checkbox('approved', 1); ?>><b>Agree to all site terms and Conditions which will include first hour consultation free, agree to a budget and weekly reporting on active jobs</b><br>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">&nbsp;</div>
                                            <div class="col-md-6 text-right">
                                                <input type="submit" class="btn black" value="Sign Up" />
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

<script>
    var slug = function(str) {
                var $slug = '';
                var trimmed = $.trim(str);
                $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
                return $slug.toLowerCase();
            }
    $(document).ready(function(){
        $("#manager_sole").change(function() {
            if($(this).is(":checked")) {
                $('#pname').val(slug($("#first_name").val()+" "+$("#last_name").val()));
            } else {
                $("#pname").val("");
            }

            // if($("#user_type").val() == 1) {
            //     $('#pname').val(slug($("#first_name").val()+" "+$("#last_name").val()));
            // } else {
            //     $("#pname").val("");
            // }
        });

        $("#part_of").click(function() {
            if($(this).is(":checked")) {
                $("#pname").val("");
            } else {
                $('#pname').val(slug($("#first_name").val()+" "+$("#last_name").val()));
            }
        });

        $('#qualify').change(function(){
            if($('#qualify').val()==1)
                $('#qualify').val(0);
            else
                $('#qualify').val(1);
        });

        $('#Language').select2({'placeholder': 'Select Language', allowClear: true});
        $('#Ethnicity').select2({'placeholder': 'Select Ethnicity', allowClear: true});

        var options = {
            url: "<?php echo base_url('lawyer/json'); ?>",

            getValue: "name",

            template: {
                type: "description",
                fields: {
                    description: "email"
                }
            },

            list: {
                match: {
                    enabled: true
                }
            }

            // theme: "plate-dark"
        };

        $("#pname").easyAutocomplete(options);

        $('.next_tab').click(function(){
          $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });

    });
</script>