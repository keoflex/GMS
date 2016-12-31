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

/*************************************************************************************

When a query is processed it runs QUERY_PROCESS.php. This file is included in the dashboard.php
above the page porcessor.  The Post Processor is in the header file and displays the notification 
above the container div.  This way the notification can be put within the container and display correctly
**************************************************************************************/

  if(isset($QUERY_PROCESS)){
	if($QUERY_PROCESS){
	?>
     <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>SUCCESS:</strong> The <?php echo $element; ?> was <?php echo $element_function; ?>!
    
    
    </div>
	<?php	
}else{
	?>
         <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>ERROR!!: </strong> There was a problem and <?php echo $element; ?> was not <?php echo $element_function; ?>!  A system admin has been notified. <?php echo $mysql_error; ?>
      
   
    </div>
	<?php	
	$message = "<b>QUERY:</b> ".$add."\n";
	$message .= "ERROR: ".$mysql_error."\n";
	$message .= "---------------------------------------------- \n";
	$message .= "PAGE: ".$post_page."\n";
	$message .= "---------------------------------------------- \n";
	//$message .= "GOAL_name: ".$GOAL_name."\n";
	//$message .= "GOAL_description: ".$GOAL_description."\n";
	mail($site_email,"Asset Tracker Error:", $message);
	}
}
  ?>