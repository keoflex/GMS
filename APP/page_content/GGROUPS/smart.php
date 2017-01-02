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
			<h1>GOOGLE Smart Groups</h1>

			<a class="btn btn-success"  href="./index.php?P=<?php echo pg_encrypt("GGROUPS-newSMART",$pg_encrypt_key,"encode") ?>">Create Smart Group</a>
			<HR>
			<div class="info">
				<p>&nbsp;</p>
			</div>
			<table id="matrixDT" class="display" cellspacing="0" width="100%">
				<?php
				$th_fields = "
				<th>Name</th>
				<th>Google Group ID</th>
				<th>Smart Group Email</th>
				<th>Action</th>
				";
				?>
                <thead>
					<tr>
						<?php echo $th_fields; ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<?php echo $th_fields; ?>
					</tr>
				</tfoot>
				<tbody>

                    <?php
						//call google API\
						$get_Smart_groups = "SELECT * FROM smart_groups";
						$SMART_res = mysqltng_query($get_Smart_groups);

						for($i=0;$i<mysqltng_num_rows($SMART_res);$i++){
							$SMART_array = mysqltng_fetch_assoc($SMART_res);
							$SMART_name = $SMART_array['name'];
							$SMART_email = $SMART_array['email'];
							$SMART_google_group_id = $SMART_array['google_group_id'];
							$SMART_id = stripcslashes( $SMART_array['id']);
							$SMART_description = $SMART_array['description'];
							?>
                            <tr>
                                <td><h4><?php echo $SMART_name; ?></h4></td>
                                <td><h3><?php echo $SMART_google_group_id; ?></h3></td>
								<td><?php echo $SMART_email; ?></td>
								<td>
								<!-- <a href="#" class="btn btn-primary">Edit</a> -->
								<form role="form" action="./?P=<?php echo pg_encrypt("GGROUPS-editSMART",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data" style="display: inline-block; margin:0;">
                                <input type="hidden" name="smart_group_id" value="<?php echo pg_encrypt($SMART_id,$pg_encrypt_key,"encode"); ?>">
                                <input type="submit" class="btn btn-primary" target="new" Value="EDIT">
                                </form>
								<form role="form" action="./?P=<?php echo pg_encrypt("GGROUPS-smart",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data" style="display: inline-block; margin:0;">
								<input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qrySMARTGROUP-deleteGROUP",$pg_encrypt_key,"encode") ?>" />
								<input type="hidden" name="" value="<?php echo pg_encrypt($SMART_id.$general_seed,$pg_encrypt_key,"encode"); ?>">

                                <input type="submit" id="delete_btn" class="btn btn-danger" style="width:100%" Value="DELETE">
                                </form>

							   </td>

</td>
							</tr>
                            <?php

						}
					?>
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
