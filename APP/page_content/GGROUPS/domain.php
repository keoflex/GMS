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
			<h1>GOOGLE Domains</h1>
			<a class="btn btn-success"  href="./index.php?P=<?php echo pg_encrypt("GGROUPS-newDOMAIN",$pg_encrypt_key,"encode") ?>">Create Google Domain</a>
			<HR>
			<div class="info">
				<p>&nbsp;</p>
			</div>
			<table id="domain_list" class="display" cellspacing="0" width="100%">
				<?php
				$th_fields = "
				<th>Name</th>
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
						//get google domains
						$get_google_domains = "SELECT * FROM google_domains";
						$domain_res = mysqltng_query($get_google_domains);

						for($i=0;$i<mysqltng_num_rows($domain_res);$i++){
							$domain_array = mysqltng_fetch_assoc($domain_res);
							$domain_name = $domain_array['name'];
							$domain_id = stripcslashes( $domain_array['id']);
							?>
                            <tr>
                                <td><h4><?php echo $domain_name; ?></h4></td>
								<td>
								<!-- <a href="#" class="btn btn-primary">Edit</a> -->
								<form role="form" action="./?P=<?php echo pg_encrypt("GGROUPS-editDOMAIN",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data" style="display: inline-block; margin:0;">
                                <input type="hidden" name="domain_id" value="<?php echo pg_encrypt($domain_id,$pg_encrypt_key,"encode"); ?>">
                                <input type="submit" class="btn btn-primary" target="new" Value="EDIT">
                                </form>
								<form role="form" action="./?P=<?php echo pg_encrypt("GGROUPS-domain",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data" style="display: inline-block; margin:0;">
								<input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryDOMAIN-deleteDOMAIN",$pg_encrypt_key,"encode") ?>" />
								<input type="hidden" name="domain_id" value="<?php echo pg_encrypt($domain_id.$general_seed,$pg_encrypt_key,"encode"); ?>">

                                <input type="submit" id="delete_btn" class="delete_btn btn btn-danger" style="width:100%" Value="DELETE">
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
$('#domain_list').dataTable({
        "iDisplayLength": 100,
		 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [1] }
       ]
    });

  $(".delete_btn").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});
</script>
