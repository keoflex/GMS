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
$google_group_email = pg_encrypt($_POST['google_group_email'],$pg_encrypt_key,"decode");


$domain_query = "SELECT * FROM google_domains";
$result = mysqltng_query($domain_query);
$domains = array();
for($i=0;$i<mysqltng_num_rows($result);$i++){
   $data = mysqltng_fetch_assoc($result);
   $domains[] = array("name"=> $data['name'], "id" => $data['id']);
   }
?>
<link href="./ASSETS/querybuilder/css/query-builder.default.min.css" rel="stylesheet">
<section>
  <h1>Make Smart Group</h1>
  <a class="btn btn-primary"  href="./?P=<?php echo pg_encrypt('GGROUPS-standard',$pg_encrypt_key,"encode") ?>" />Back to Standard Groups</a>
  <hr>
  <div class="info">
    <p>&nbsp;</p>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-green">
        <div class="panel-heading">
          <h2 class="panel-title">Smart Group Details</h2>
        </div>
        <div class="panel-body">
          <div class="form-group">
				<form action="./?P=<?php echo $_GET['P']; ?>" method="post" enctype="multipart/form-data">
				  <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qrySTANDARDGROUP-makeGROUP_qry",$pg_encrypt_key,"encode") ?>" />
				   <input type="hidden" name="smart_google_group_id" value="<?php echo $_POST['smart_google_group_id']; ?>">
				  <div class="form-group">
						<div class="row">
							 <label class="col-md-2 control-label">Name</label>
							<div class="col-md-5">
								 <input name="name" type="text" value="" class="form-control" required>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

				   <div class="form-group">
						<div class="row">
							 <label class="col-md-2 control-label">Google Domain</label>
							<div class="col-md-5">
							<select style="width: 100%" name="google_domain_id" id="google_domain_id" class="form-control">
								<?php
								foreach ($domains as $domain) {
								   $domain_name=$domain['name'];
								   $domain_id=$domain['id'];
									echo "<option value=$domain_id>$domain_name</option>";
								}
								?>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

				 <div class="form-group">
					<div class="row">
						 <label class="col-md-2 control-label">Smart Group Email</label>
						<div class="col-md-5">
							<input name="email" type="text" value="<?php echo $google_group_email; ?>" email class="form-control">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				 <div class="form-group">
					<div class="row">
						 <label class="col-md-2 control-label">Smart Group Description</label>
						<div class="col-md-5">
							<input name="description" type="text" value="" class="form-control">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="form-group">
					<div class="row">
						 <label class="col-md-2 control-label">Google Group ID</label>(Leave blank if you want to create it in Google now)
						<div class="col-md-5">
							<input name="google_group_id" type="text" value="<?php echo $google_group_id; ?>" class="form-control">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="form-group">
					<div class="row">
						 <label class="col-md-2 control-label">Help</label>
						<div class="col-md-10">
                    For Org Unit Path use a forward slash ("/") to divide the OUs. Format: /&lt;OU1&gt;/&lt;OU2&gt; <br/>
                    Org Unit Path example value:  /Staff/test <br/>
                    &nbsp; <br/>

						</div>
					</div>
					<div class="clearfix"></div>
				</div>

			<h4>Smart Group Condition</h4>
				 <div id="builder"></div>
				 <div class="btn-group">
<!--
							  <button class="btn btn-primary parse-json" data-stmt="false" type="button">View Json</button>
-->
				</div>
				<!-- For reference and review sql statement -->
					<div id="result" class="hide">
					  <h3>Output</h3>
					  <pre></pre>
					</div>
				<input type="text" id="pattern_condition" name="pattern_condition">


				<div class="form-group mt20">
					<div class="col-md-offset-2 col-md-6">
						<button type="submit" id="submit" class="btn btn-success">CREATE SMART GROUP</button>
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
<?php
}else{
?>
<h1>No standard smart group was selected</h1>
<?php
}
?>

<script src="./js/bootstrap.min.js"></script>
<script src="./ASSETS/querybuilder/js/query-builder.standalone.min.js"></script>
<script src="./ASSETS/querybuilder/js/basic.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	var rules_basic = {
	};

$('#builder').queryBuilder({
  plugins: ['bt-tooltip-errors'],

  filters: [{
    id: 'email_value',
    label: 'Email',
    type: 'string',
	operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  }, {
    id: 'employee_type',
    label: 'Employee Type',
     type: 'string',
    operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  },
  {
    id: 'department',
    label: 'Department',
    type: 'string',
	operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  },{
    id: 'manager_email',
    label: 'Manager Email',
   type: 'string',
	operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  }, {
    id: 'org_unit',
    label: 'Org Unit Path (OU)',
   type: 'string',
	operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  }, {
    id: 'cost_center',
    label: 'Cost Center',
   type: 'string',
	operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  }, {
    id: 'employee_title',
    label: 'Emplyee Title',
   type: 'string',
	operators: ['begins_with','ends_with','contains','equal', 'not_equal']
  }],

 // rules: rules_basic
});

$('#btn-reset').on('click', function() {
  $('#builder-basic').queryBuilder('reset');
});

// reset builder
$('.reset').on('click', function() {
  $('#builder').queryBuilder('reset');
  $('#result').addClass('hide').find('pre').empty();
});

// get rules
$('.parse-json').on('click', function() {
  $('#result').removeClass('hide')
    .find('pre').html(JSON.stringify(
      $('#builder').queryBuilder('getRules', {get_flags: true}),
      undefined, 2
    ));
});

$('.parse-sql').on('click', function() {
  var res = $('#builder').queryBuilder( 'getSQL', false, true);
  $('#result').removeClass('hide')
    .find('pre').html(
      res.sql + (res.params ? '\n\n' + JSON.stringify(res.params, undefined, 2) : '')
    );
});


$('#submit').on('click', function() {
   //var res = $('#builder').queryBuilder('getSQL', $(this).data('stmt'), false);
   //var sql=res.sql;
   var res =  $('#builder').queryBuilder('getRules',{get_flags: true});
   if($.isEmptyObject(res)){
	alert("Problem in pattern type selection");
	return false;
   }
   var json_string = JSON.stringify(res);
   $('#pattern_condition').val(json_string);
});
});
    </script>


