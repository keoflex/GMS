<?php
/*
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
*/

if(isset($DB_host)){//make sure index.php is what is loaded not dashboard
require_once("main_head.php");
?>

    <div id="wrapper">

       <?php

	   
	   include "menu.php";
	   ?>

        <div id="page-wrapper">

            <div class="container-fluid">
            <?php
			if($BASE_URL == "http://localhost/priortyFlex/APP"){
                ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>ALERT </strong> Your are on the local server
                        </div>
                    </div>
			<?php
            }
            ?>
                    <?php
			include "dbquery/QUERY_PROCESS_SUB.php";
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// PAGE PROCESSOR: All pages are pulled from $_GET[pg]
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@		

			if((@include $include_address) === false)
				{
					// handle error
					include "page_content/404.php";
				}
		
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// END PAGE PROCESSOR
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@		
   ?>
<?php
/*
              
*/
?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<div style="width:100%; margin:auto; text-align:center; color:#DBDBDB; padding-top:10px;">
<img style="width:15%" src="../images/logo_grey.png">
<br>
GNU AGPLv3 public License.  Supported By:<br>
<a href="http://keoflex.com"><img  width="100px" src="../images/logo.png"></a>
</div>
    <!-- jQuery 
    <script src="js/jquery.js"></script>
-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>



</body>

</html>
<?php
}else{
	//if dashboard was loaded then refresh to index
		Header("Location: ./");    // redirect him to protected.php
	
}
?>
