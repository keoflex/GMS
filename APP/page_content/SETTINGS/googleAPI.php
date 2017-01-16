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



$get_goog_api = "
select * from settings where 
SET_name = 'Google_API_key' OR 
SET_name = 'Google_API_pass'";

$Google_API_key = '';
$Google_API_pass = '';

$get_goog_res = mysqltng_query($get_goog_api);
for($i=0;$i<mysqltng_num_rows($get_goog_res);$i++){
	$goog_array = mysqltng_fetch_assoc($get_goog_res);
	if($goog_array['SET_name'] == 'Google_API_key'){
		$Google_API_key = $goog_array['SET_value'];
	}else if($goog_array['SET_name'] == 'Google_API_pass'){
		$Google_API_pass = $goog_array['SET_value'];
	}
}
?>
 

 <section>
  <h1>Google API stored info</h1>
	 <h2 style="color:red">We have modifeid how this is handled.  We will update this section soon to decrypt the INI file and allow you to edit it</h2>
  <hr>
  <div class="info">
    <p>&nbsp;</p>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <h2 class="panel-title">API details</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <form action="./?P=<?php echo $_GET['P']; ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qrySETTINGS-editGOOAPI_qry",$pg_encrypt_key,"encode") ?>" />
			  <h3>Admin API</h3>
              <label>API Key</label>
              <input name="api_key" type="text" value="<?php echo $Google_API_key; ?>" class="form-control">
              <label>API Pass</label>
              <input name="api_pass" type="text" value="<?php echo $Google_API_pass; ?>" class="form-control">
              
              <button type="submit" class="btn btn-success">EDIT USER</button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

