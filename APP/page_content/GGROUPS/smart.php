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
				<th>EMAIL</th>
				<th>DESCRIPTION</th>
				<th>UPDATE</th>
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
							$SMART_description = $SMART_array['description'];
							?>
                            <tr>
                                <td><h4><?php echo $SMART_name; ?></h4></td>
                                <td><h3><?php echo $SMART_email; ?></h3></td>
								<td><?php echo $SMART_description; ?></td>
								<td><a href="#" class="btn btn-primary">Edit</a><a href="#" class="btn btn-danger">Delete</a></td>
                                
</td>
							</tr>
                            <?php	
						
						}
					?>
				</tbody>
			</table>
