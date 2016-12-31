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
              <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryUSER-new_qry",$pg_encrypt_key,"encode") ?>" />
              <label>User First Name</label>
              <input name="first_name" type="text" value="" class="form-control">
              <label>User Last Name</label>
              <input name="last_name" type="text" value="" class="form-control">
              <label>User email (also username)</label>
              <input name="user_email" type="email" value="" class="form-control">
              <hr>
              <label>User Password</label>
              <input name="user_password" type="password" value="" class="form-control">
              <label>Password Confirm</label>
              <input name="user_password_confirm" type="password" value="" class="form-control">
              
              <button type="submit" class="btn btn-success">CREATE USER</button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
