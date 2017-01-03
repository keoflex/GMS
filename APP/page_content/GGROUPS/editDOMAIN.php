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

if(isset($_POST['domain_id'])){
	$domain_id_edit_post = $conn->real_escape_string($_POST['domain_id']);
	$domain_id_edit = pg_encrypt($domain_id_edit_post,$pg_encrypt_key,"decode");
	//get smart group info
	$get_domain = "select * from google_domains where id = ".$domain_id_edit;
	$get_domain_res = mysqltng_query($get_domain);
	$domain_name = mysqltng_result($get_domain_res,0,"name");
?>
<section>
  <h1>Edit Google Domain</h1>
  <a class="btn btn-primary"  href="./?P=<?php echo pg_encrypt("GGROUPS-domain",$pg_encrypt_key,"encode") ?>" />Go Back to List</a>
  <hr>
  <div class="info">
    <p>&nbsp;</p>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-green">
        <div class="panel-heading">
          <h2 class="panel-title">Google Domain Details</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <form action="./?P=<?php echo $_GET['P']; ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryDOMAIN-editDOMAIN_qry",$pg_encrypt_key,"encode") ?>" />
              <input type="hidden" name="domain_id" value="<?php echo $domain_id_edit_post; ?>">

              <div class="form-group">
						<div class="row">
							 <label class="col-md-2 control-label">Name</label>
							<div class="col-md-5">
								 <input name="name" type="text" value="<?php echo $domain_name; ?>" class="form-control" required>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				<div class="form-group mt20">
					<div class="col-md-offset-2 col-md-6">
						<button type="submit" id="submit" class="btn btn-success">EDIT GOOGLE DOMAIN</button>
					</div>
				</div>
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
<h1>No google domain was selected</h1>
<?php
}
?>
<link href="./ASSETS/querybuilder/css/query-builder.default.min.css" rel="stylesheet">
<script src="./js/bootstrap.min.js"></script>
<script src="./ASSETS/querybuilder/js/query-builder.standalone.min.js"></script>
<script src="./ASSETS/querybuilder/js/basic.js"></script>

