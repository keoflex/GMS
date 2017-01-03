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


$keyfile = "lib/SmartGroupsProject-c4d49f17ff48.p12";
$google = new Google($keyfile);

$query = "SELECT * FROM google_domains";
$result = mysqltng_query($query);

$domains = array();
for($i=0;$i<mysqltng_num_rows($result);$i++){
   $data = mysqltng_fetch_assoc($result);
   $domains[] = array("name"=> $data['name'], "id" => $data['id']);
   }
?>

		<section>
			<h1>Standard Google Groups</h1>






         <HR>
         <div class="info">
            Google Domain: <select id=domain>
<?php
$i=0;
foreach ($domains as $domain) {
   $domain_name=$domain['name'];
	$selected="";
	if ($i==0) { $selected="SELECTED"; $selected_domain_name=$domain_name; }
	echo "<option value=$domain_name $selected>$domain_name</option>";
	$i++;
}

   $results=$google->getGoogleGroups($selected_domain_name);
   $groups = $results->getGroups();

?>
				</select>
         </div>






			<table id="matrixDT" class="display" cellspacing="0" width="100%">
                <thead>
					<tr>
				<th>Group ID</th>
				<th>Group Name</th>
				<th>Group Email</th>
				<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
				<th>Group ID</th>
				<th>Group Name</th>
				<th>Group Email</th>
				<th>Action</th>
					</tr>
				</tfoot>
				<tbody>

                    <?php

foreach($groups as $group) {

$glist[] = array("google_group_id"=>$group->getId(), "name"=>$group->getName(), "smart"=>$smart, "id"=>$id, "email"=>$group->getEmail());
							$id = $group->getId();
							$name = $group->getName();
							$email = $group->getEmail();

$query = sprintf("SELECT * FROM smart_groups where google_group_id='%s'", $id);
$result = mysqltng_query($query);
$data = mysqltng_fetch_assoc($result);
$smart=0;
if ($data) $smart=1;

							?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
								<td><?php echo $email;  ?></td>
								<td>
<?php if (!$smart) { ?>
								<form role="form" action="./?P=<?php echo pg_encrypt("GGROUPS-editSMART",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data" style="display: inline-block; margin:0;">
                                <input type="hidden" name="smart_group_id" value="<?php echo pg_encrypt($id,$pg_encrypt_key,"encode"); ?>">
                                <input type="hidden" name="email" value="<?php echo pg_encrypt($email,$pg_encrypt_key,"encode"); ?>">
                                <input type="submit" class="btn btn-primary" target="new" Value="Make Smart">
							
                                </form>
                            <?php } else {?>

								<form role="form" action="./?P=<?php echo pg_encrypt("GGROUPS-editSMART",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data" style="display: inline-block; margin:0;">
                                <input type="hidden" name="smart_group_id" value="<?php echo pg_encrypt($id,$pg_encrypt_key,"encode"); ?>">
                                <input type="submit" class="btn btn-primary" target="new" Value="Edit">
							
                                </form>
                            <?php } ?>


							   </td>

</td>
							</tr>
                            <?php } ?>
				</tbody>
			</table>

<script type="text/javascript">
$(document).ready(function(){
  $("#delete_btn").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});
</script>
