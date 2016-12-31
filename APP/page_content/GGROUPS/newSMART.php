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
  <h1>Create New Smart Group</h1>
  <a class="btn btn-primary"  href="./?P=<?php echo pg_encrypt("GGROUPS-smart",$pg_encrypt_key,"encode") ?>" />Back to Smart Groups</a>
  <hr>
  <div class="info">
    <p>&nbsp;</p>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-green">
        <div class="panel-heading">
          <h2 class="panel-title">Smart Group DETAILS</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <form action="./?P=<?php echo $_GET['P']; ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryUSER-new_qry",$pg_encrypt_key,"encode") ?>" />
              <label>Groups Name</label>
              <input name="first_name" type="text" value="" class="form-control">
              <label>Groups Email</label>
              <input name="last_name" type="text" value="" class="form-control">
              
              <hr>
        
		<h2>Search Query</h2>       
   <div id="builder-basic"></div>

    <div class="btn-group">
    <button type="submit" class="btn btn-success">CREATE USER</button>      
    <button class="btn btn-warning reset" data-target="basic">Reset</button>

     <!--
      <button class="btn btn-success set-json" data-target="basic">Set rules</button>
      <button class="btn btn-primary parse-json" data-target="basic">Get rules</button>
      -->
    </div>

              

         </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
   


 




<script src="./js/bootstrap.min.js"></script>
<script src="./ASSETS/querybuilder/js/query-builder.standalone.min.js"></script>
<script src="./ASSETS/querybuilder/js/basic.js"></script>



