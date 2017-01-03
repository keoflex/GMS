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
<?php
if(isset($_POST['smart_google_group_id'])){
	 $google_group_id = pg_encrypt($_POST['smart_google_group_id'],$pg_encrypt_key,"decode");
	 $email = pg_encrypt($_POST['email'],$pg_encrypt_key,"decode");
     $type = pg_encrypt($_POST['type'],$pg_encrypt_key,"decode");
}
$domain_query = "SELECT * FROM google_domains";
$result = mysqltng_query($domain_query);

$domains = array();
for($i=0;$i<mysqltng_num_rows($result);$i++){
   $data = mysqltng_fetch_assoc($result);
   $domains[] = array("name"=> $data['name'], "id" => $data['id']);
   }
?>

<section>
  <h1><?php echo (($type=="make_smart")?'Make Smart Group':'Create New Smart Group');?></h1>
  <a class="btn btn-primary"  href="./?P=<?php echo pg_encrypt('GGROUPS-domain',$pg_encrypt_key,"encode") ?>" />Back to Google Domain</a>
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
				  <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryDOMAIN-newDOMAIN_qry",$pg_encrypt_key,"encode") ?>" />
				  <div class="form-group">
						<div class="row">
							 <label class="col-md-2 control-label">Name</label>
							<div class="col-md-5">
								 <input name="name" type="text" value="" class="form-control" required>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>


				<div class="form-group mt20">
					<div class="col-md-offset-2 col-md-6">
						<button type="submit" id="submit" class="btn btn-success">CREATE GOOGLE DOMAIN</button>
						<button class="btn btn-warning reset" type="reset" value="Reset">Reset</button>
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

<script src="./js/bootstrap.min.js"></script>
<script src="./ASSETS/querybuilder/js/query-builder.standalone.min.js"></script>
<script src="./ASSETS/querybuilder/js/basic.js"></script>



