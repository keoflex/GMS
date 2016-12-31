<?php
/******************************************************************************************Edited 12/28/2016

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
******************************************************************************************/
?>

		<section>
			<h1>USER LIST</h1>
			
			<HR>
			<div class="info">
				<p>&nbsp;</p>
			</div>
			<table id="matrixDT" class="display" cellspacing="0" width="100%">
				<?php
				$th_fields = "
				<th>EMAIL</th>
				<th>NAME</th>
				<th>EDIT</th>
				<th>Delete</th>
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
						$userList = "SELECT * FROM users  order by USR_username asc";
						$userList_res = mysqltng_query($userList);
						
						for($i=0;$i<mysqltng_num_rows($userList_res);$i++){
							$user_array = mysqltng_fetch_assoc($userList_res);
							$USR_username = stripcslashes( $user_array['USR_username']);// matrix_array["EV_name"];
							$USR_id = stripcslashes( $user_array['USR_id']);

							$USR_fname = stripcslashes( $user_array['USR_fname']);

							$USR_lname = stripcslashes( $user_array['USR_lname']);
						

							?>
                            <tr>
                                <td><h4><?php echo $USR_username ; ?></h4>
                               
                                </td>
                                <td><h4><?php echo $USR_fname." ".$USR_lname ; ?></h4></td>
                               
                                 <td><h4>
								 <form role="form" action="./?P=<?php echo pg_encrypt("USER-editUSER",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data">
                               <input type="hidden" name="user_id" value="<?php echo pg_encrypt($USR_id,$pg_encrypt_key,"encode"); ?>">
         
                                <input type="submit" class="btn btn-success" style="width:100%" href="#" target="new" Value="EDIT">
                                </form>
</h4></td>
                                <td> 
                                  
                                  <form role="form" action="./?P=<?php echo pg_encrypt("USER-list",$pg_encrypt_key,"encode") ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" id="post_type" name="post_type" value="<?php echo pg_encrypt("qryUSER-deleteUSER",$pg_encrypt_key,"encode") ?>" />
                               <input type="hidden" name="user_id" value="<?php echo pg_encrypt($USR_id.$general_seed,$pg_encrypt_key,"encode"); ?>">
         
                                <input type="submit" class="btn btn-danger" style="width:100%" href="#" target="new" Value="DELETE">
                                </form>
</td>
							</tr>
                            <?php	
						
						}
					?>
				</tbody>
			</table>
