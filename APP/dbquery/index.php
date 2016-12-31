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

//set the error varialble if we get an sql error or something is not filled out properly
$error = "";

//shows what type of message this is 
//alert alert-error
//alert alert-success
$alert = "";

//This is the message variable that will display success or failure
// <strong>SUCCESS!</strong> that worked!!! 
// <strong>Oh snap!</strong> Change a few things up and try submitting again. 
$message = "";

//what page would you like to redirect to ie profile-edit or you can leave blank for the home page 
//post_page defines what the hidden "post_type" value is on every form
			//we use this to determine what php to direct the user to inside of the dbquery folder
			$post_page = $conn->real_escape_string($_POST['post_type']);
			//each post has a folder and a file ie folder-file replace - with / and you have
			//folder/file this helps us from having 100 if statements
			$post_page = str_replace('-','/',$post_page);
			
			//direct user to correct post page.
			include "dbquery/".$post_page.".php";	

?>

            <!--alert-->
            <div class="<? echo $alert; ?>">
              <button data-dismiss="alert" class="close" type="button">×</button>
              <? echo $message; ?>
            </div>
            <!--alert-->
            
            <?
			//where is the file located that we are redirecting to.
			//remember this is the same page structure as the $_GET['pg'] so in the above example profile would be the folder and edit would be edit.php
			
			if($page == ''){
				include "content/index.php";
			}else{
				include "page_content/".$page.".php";
			}

?>