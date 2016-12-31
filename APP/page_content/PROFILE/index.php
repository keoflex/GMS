<?php
/************************************
Edited 12/28/2016

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
************************************/

include_once("page_content/header.php");
?>

      <form action="./?pg=<?php echo pg_encrypt("PROFILE-index",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryPROFILE-update_qry",$pg_encrypt_key,"encode") ?>" />


  <div class="row">
    <div class="col-lg-6">
      <h1>User Information</h1>
      <div class="form-group">
        <label>First name</label>
        <input name="user_first_name" type="text" value="<?php echo $fname; ?>" class="form-control">
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input name="user_last_name" type="text" value="<?php echo $lname; ?>" class="form-control">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input name="user_email" type="text" value="<?php echo $_SESSION['username']; ?>" class="form-control">
        <p class="help-block"><b style="color:red;">NOTE:  If you change this field you will be logged out!</b></p>
      </div>
    </div>
    <div class="col-lg-6">
      <h1>User Password</h1>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="set_pass" placeholder="*****" class="form-control">
        <p class="help-block">Use this section to change your password</p>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="set_pass_conf" placeholder="*****" class="form-control">
        <p class="help-block">confirm your password here.</p>
      </div>
            

    </div>
  </div><button type="submit" class="btn btn-primary">Update Profile</button>
</form>
