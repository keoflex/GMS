<?php
/*
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
*/
?>
<!-- Navigation -->

<style>
.sublink{
	color: lightskyblue !important;
}
</style>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button  tabindex="-1" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <a  tabindex="-1" class="navbar-brand" href="./"><span style="margin-left:10px;">
    <b style="color:#848484; margin-left:10px; font-size: 30px">[</b>
    <b style="color:#3C78F1; margin-left:10px; font-size: 30px">G</b>
    <b style="color:#F70408; margin-left:10px;font-size: 30px">M</b>
    <b style="color:#f1b500; margin-left:10px;font-size: 30px">S</b>
    <b style="color:#848484; margin-left:10px; font-size: 30px">]</b>
    </a> </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">

    <li class="dropdown"> <a  tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
      <ul class="dropdown-menu alert-dropdown">


        <li> <a  tabindex="-1" href="./index.php?pg=<?php echo pg_encrypt("FUNDS-allocate",$pg_encrypt_key,"encode"); ?>">Un-Allocated <span class="label label-success">$<?php echo $USR_unAllocated; ?></span></a> </li>
        <!--
        <li> <a  tabindex="-1" href="#">Alert Name <span class="label label-success">Alert Badge</span></a> </li>
        <li> <a  tabindex="-1" href="#">Alert Name <span class="label label-info">Alert Badge</span></a> </li>
        <li> <a  tabindex="-1" href="#">Alert Name <span class="label label-warning">Alert Badge</span></a> </li>
        <li> <a  tabindex="-1" href="#">Alert Name <span class="label label-danger">Alert Badge</span></a> </li>
        <li class="divider"></li>
        <li> <a  tabindex="-1" href="#">View All</a> </li>
        -->
              </ul>
    </li>
    <li class="dropdown"> <a  tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $fname." ".$lname; ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li> <a  tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("PROFILE-index",$pg_encrypt_key,"encode") ?>"><i class="fa fa-fw fa-user"></i> Profile</a> </li>
        <li class="divider"></li>
        <li> <a  tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("SETTINGS-license",$pg_encrypt_key,"encode") ?>"><i class="fa fa-file-text"></i> License</a> </li>
        <li> <a  tabindex="-1" href="index.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a> </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
<?php
if(!isset($folder)){
	$folder = "";
}
?>
      <li <?php if($folder == "") echo "class='active'"; ?>> <a  tabindex="-1" href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a> </li>

  <!-- Google Groups-->
       <li  <?php if($folder == "GGROUPS") echo "class='active'"; ?>> <a  tabindex="-1" href="javascript:;" data-toggle="collapse" data-target="#googlegroups"><i class="fa fa-fw fa-group"></i>Google Groups<i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="googlegroups" class="<?php if($folder == "GGROUPS") echo "expand"; else echo "collapse"; ?>">

			<li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("GGROUPS-newSMART",$pg_encrypt_key,"encode") ?>">Create Smart Group</a> </li>

			<hr style="width: 70%; border: 1px solid darkorange; ">

			<li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("GGROUPS-smart",$pg_encrypt_key,"encode") ?>">SMART Groups</a>
			</li>

			<li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("GGROUPS-standard",$pg_encrypt_key,"encode") ?>">Standard Groups</a> </li>
			<li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("GGROUPS-domain",$pg_encrypt_key,"encode") ?>">Google Domains</a> </li>


        </ul>
      </li>
 <!-- User Management - non google -->
      <li  <?php if($folder == "USER") echo "class='active'"; ?>> <a  tabindex="-1" href="javascript:;" data-toggle="collapse" data-target="#UserManager"><i class="fa fa-fw fa-user"></i>Manage Users<i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="UserManager" class="<?php if($folder == "USER") echo "expand"; else echo "collapse"; ?>">
          <li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("USER-newUSER",$pg_encrypt_key,"encode") ?>">Add User</a> </li>
          <li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("USER-list",$pg_encrypt_key,"encode") ?>">User List</a> </li>



    </ul>

      <!-- Settings -->
      <li  <?php if($folder == "SETTINGS") echo "class='active'"; ?>> <a  tabindex="-1" href="javascript:;" style="color: darkorange;" data-toggle="collapse" data-target="#SettingsManager"><i class="fa fa-fw fa-cog"></i>SETTINGS<i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="SettingsManager" class="<?php if($folder == "SETTINGS") echo "expand"; else echo "collapse"; ?>">
          <li> <a class="sublink" tabindex="-1" href="./index.php?P=<?php echo pg_encrypt("SETTINGS-googleAPI",$pg_encrypt_key,"encode") ?>">Google API</a> </li>



       </ul>
	   </li>
  </div>
  <!-- /.navbar-collapse -->
</nav>
