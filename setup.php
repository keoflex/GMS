<?php
require_once ("APP/globals.php");  # for $ETC_DIR
$config_file = "$ETC_DIR/config.ini";
if(file_exists($config_file)){
   header("Location: index.php");
   }
?>
<!--

*** Date modified 12-29-2016
***

GSuite Management System
    Copyright (C) 2017  Michael Keough (Keoflex.com, MichaelKeough.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<?php
 require_once("APP/globals.php");
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
   <script src="APP/js/jquery.js"></script>
   <script src="APP/js/jquery.validate.js"></script>
    <title>Setup Form</title>
    

    <!-- Bootstrap Core CSS -->
    <link href="APP/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="APP/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="APP/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="APP/ASSETS/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
    
    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <body>
	<div class="setup">
		<div class="setup-screen">
			<div  class="app-title">
				<h1 >
				<b style="color:#848484; margin-left:10px; font-size: 30px">[</b>
    <b style="color:#3C78F1; margin-left:10px; font-size: 30px">G</b>
    <b style="color:#F70408; margin-left:10px;font-size: 30px">M</b>
    <b style="color:#f1b500; margin-left:10px;font-size: 30px">S</b>
    <b style="color:#848484; margin-left:10px; font-size: 30px">]</b>
				</h1>
				<h2><span>GSuite Management System</h2>
			</div>


<div id="notes">
The system does not have a config file. Use the form to create a config file.  Then log in.
<br/>
</div>

<div class="panel-body">
 <div class="form-group">
			<form id="setup_form" method="post" action="setup_process.php" enctype="multipart/form-data" method="POST">

			<div class="control-group">
    			<div class="row">
							<label class="col-md-3 control-label">Database Host</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="localhost" name="db_host" placeholder="DB host" id="db_host">
						</div>
					</div>
			</div>
						<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Database Name</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="gms_dev" name="db_name" placeholder="DB name" id="db_name">
					  	</div>
					  	</div>
					  	</div>
					  	<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Database User</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="gms_dev" name="db_user" placeholder="username" id="db_user">
						</div>
						</div>
						</div>
					  	<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Database Password</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="gms_dev!" name="db_pw" placeholder="password" id="db_password">
						</div>
						</div>
						</div>

						<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Login Seed</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="11111" name="login_seed" placeholder="any random value" id="login_seed">
						</div>
						</div>
					  	</div>
<!--
						<div class="control-group">
    						<div class="row">
							<label class="" for="login-pass">Encrypt Key</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="4Txy1m2kics" name="encrypt_key" placeholder="any random value" id="encrypt_key">
						</div>
						</div>
					  	</div>
-->

					  	<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Google Admin User Name</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="admin@dumasschools.net" name="google_admin_user" placeholder="admin@domain.com" id="google_admin_user">
						</div>
						</div>
						</div>

					  	<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Google Service Account Name</label>
                  <div class="col-md-5">
							<input type="text" class="setup-field login-field" value="rhc1-888@dumas-1470212397620.iam.gserviceaccount.com" name="google_service_account_name" placeholder="name@project-1470212397620.iam.gserviceaccount.com" id="google_service_account_name">
						</div>
						</div>
						</div>

					  	<div class="control-group">
    						<div class="row">
							<label class="col-md-3 control-label">Google Service Account Key File</label>
                  <div class="col-md-5">
							<input type="file" class="setup-field login-field" accept=".json, .p12" name="google_service_account_key_file"  id="google_service_account_key_file">
						</div>
						</div>
						</div>
 
    						<div class="row">
					  <input type="submit" class="btn btn-primary btn-large btn-block" value="Submit" />
						</div>
			</form
		</div>
		</div>
		</div>
	</div>
</body>
    
    
    
<script>
$(document).ready(function() {


    // process the form
    $('form').submit(function(event) {

        var valid = $('#setup_form').valid();
        if (!valid) return;



			var jForm = new FormData();
			jForm.append("db_host", $('input[name=db_host]').val());
			jForm.append("db_name", $('input[name=db_name]').val());
			jForm.append("db_user", $('input[name=db_user]').val());
			jForm.append("db_pw", $('input[name=db_pw]').val());
			jForm.append("login_seed", $('input[name=login_seed]').val());
			//jForm.append("encrypt_key", $('input[name=encrypt_key]').val());
			jForm.append("google_admin_user", $('input[name=google_admin_user]').val());
			jForm.append("google_service_account_name", $('input[name=google_service_account_name]').val());
			jForm.append("google_service_account_key_file", $('input[name=google_service_account_key_file]').get(0).files[0]);

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'setup_process.php', // the url where we want to POST
            data        : jForm, // our data object
				mimeType: "multipart/form-data",
            cache: false,
            contentType: false,
            processData: false,
            dataType    : 'json' // what type of data do we expect back from the server
        })
            // using the done promise callback
            .done(function(data) {

			if (data.status != "success") {
				alert(data.message);
				return;
				}

			// all ok, so go to login page
			window.location.href = "index.php";;


				
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

 $('#setup_form').validate(
             {
              rules: {
                db_host: {
                  minlength: 2,
                  required: true
                },
                db_name: {
                  minlength: 2,
                  required: true
                },
                db_user: {
                  minlength: 2,
                  required: true,
                },
                db_pw: {
                  minlength: 6,
                  required: true
                },
                login_seed: {
                  minlength: 5,
                  required: true
                },
                google_admin_user: {
                  minlength: 6,
                  email: true,
                  required: true
                },
                google_service_account_name: {
                  minlength: 6,
                  email: true,
                  required: true
                },
                google_service_account_key_file: {
                  required: true
                }
              },
              highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
              },
              success: function(element) {
                element
                .text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
              }
             });

});
</script>
    
    
</html>
