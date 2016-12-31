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

if(isset($_POST['user_id'])){
	$USR_id_edit_post = $conn->real_escape_string($_POST['user_id']);
	$USR_id_edit = pg_encrypt($USR_id_edit_post,$pg_encrypt_key,"decode");
	$get_user = "select * from users where USR_id = ".$USR_id_edit;
	$get_user_res = mysqltng_query($get_user);
	$USR_username = mysqltng_result($get_user_res,0,"USR_username");
	$USR_fname = mysqltng_result($get_user_res,0,"USR_fname");
	$USR_lname = mysqltng_result($get_user_res,0,"USR_lname");
?>
<section>
  <h1>Create New User</h1>
  <a class="btn btn-primary"  href="./?P=<?php echo pg_encrypt("USER-list",$pg_encrypt_key,"encode") ?>" />Go Back to List</a>
  <hr>
  <div class="info">
    <p>&nbsp;</p>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <h2 class="panel-title">USER DETAILS</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <form action="./?P=<?php echo $_GET['P']; ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryUSER-editUSER_qry",$pg_encrypt_key,"encode") ?>" />
              <input type="hidden" name="user_id" value="<?php echo $USR_id_edit_post; ?>">

              <label>User First Name</label>
              <input name="first_name" type="text" value="<?php echo $USR_fname; ?>" class="form-control">
              <label>User Last Name</label>
              <input name="last_name" type="text" value="<?php echo $USR_lname; ?>" class="form-control">
              <label>User email (also username)</label>
              <input name="user_email" type="email" value="<?php echo $USR_username; ?>" class="form-control">
              
              <hr>
              <label>User Password</label>
              <input name="user_password" type="password" value="" class="form-control">
              <label>Password Confirm</label>
              <input name="user_password_confirm" type="password" value="" class="form-control">
              <button type="submit" class="btn btn-success">EDIT USER</button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}else{
?>
<h1>No user was selected</h1>
<?php

}
?>
