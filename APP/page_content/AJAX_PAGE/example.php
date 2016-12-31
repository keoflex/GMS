<?php
/************************************************************************************************
Creates a new Matrix Item
Author: Michael Keough
Date Modified: 12/5/2015

Field is calld using the popdiv.js ajaxpage function
************************************************************************************************/


header("Cache-Control: no-cache");
header("Pragma: nocache");

$field = $_GET['f1']; 
$new_field = $field+1;
//since this page is not actually loading in the index.php (since we are dynmaically loading it through 
//the ajaxpage function through innerhtml then a database connection must be re-established
	include_once "../../dbcon/config_sqli.php";
	$PROJ_id = $conn->real_escape_string($_GET['f2']);
	$USR_id = $conn->real_escape_string($_GET['uid']);
	
	//add this item to the database
	$insert_proj_items = "INSERT INTO projects_items(PROJ_id) VALUES($PROJ_id)";
	if(mysqltng_query($insert_proj_items)){
		//if successful get the PITEM_id and then show a status saved message
			
		$GET_KEY = "SELECT * FROM projects_items where PROJ_id = $PROJ_id order by PITEM_id desc limit 1";
		$GET_KEY_res = mysqltng_query($GET_KEY);
		$PITEM_id = mysqltng_result( $GET_KEY_res,0,"PITEM_id" );
	?>
   <div id="matrix_field_<?php echo $field; ?>" class="form-group input-group">
<!-- Text area for Item Name
************************************************************************
Content is saved autotmatically
ajax page info: php, div id, PITEM, THIS VALUE 
************************************************************************
-->        
        <input style="width:40%;background:#FBF9CC;"  onKeyUp="javascript:ajaxpage('page_content/AJAX_PAGE/matrix_update_field.php', 'saved_progress-<?php echo $field; ?>','<?php echo $PITEM_id; ?>',this.value);" tabindex="<?php echo $field; ?>" placeholder="Field <?php echo $field; ?>" name="<?php echo $PITEM_id; ?>-field_input_<?php echo $field; ?>" type="text" class="form-control">


<!-- Text area for Item implications
************************************************************************
Content is saved autotmatically
ajax page info: php, div id, PITEM, THIS VALUE 
************************************************************************
-->          

        <input style="width:40%;" tabindex="<?php echo $field; ?>" onKeyUp="javascript:ajaxpage('page_content/AJAX_PAGE/matrix_update_implications.php', 'saved_progress-<?php echo $field; ?>','<?php echo $PITEM_id; ?>',this.value);" tabindex="<?php echo $field; ?>" placeholder="Implications <?php echo $field; ?>" name="<?php echo $PITEM_id; ?>-field_implications_<?php echo $field; ?>" type="text" class="form-control" >
        
       <!-- Text area for Budget
************************************************************************
Content is saved autotmatically
ajax page info: php, div id, PITEM, THIS VALUE 
************************************************************************
-->
      
      <input style="width:20%; background:#B6E49E" tabindex="<?php echo $field; ?>" onKeyUp="javascript:ajaxpage('page_content/AJAX_PAGE/matrix_update_budget.php', 'saved_progress-<?php echo $field; ?>','<?php echo $PITEM_id; ?>',this.value);" tabindex="<?php echo $field; ?>" placeholder="$" name="<?php echo $PITEM_id; ?>-field_budget_<?php echo $field; ?>" type="text" class="form-control">
      

<!-- Delete ITEM
************************************************************************
this Div refreshes the page and runs a query at the top that deletes the 
item by the del_id in the hiddeen imput field
************************************************************************
--> 
      
        <span style="background:#ffffff !important; border:none !important;" class="input-group-addon">
        <form method="post">
            <input type="hidden" name="del_id" value="<?php echo $PITEM_id; ?>">
            <input tabindex="-1" type="submit" style="margin-top:-5px;"  class="btn btn-danger" value=" X ">
		</form>

        </span> 
      </div>
     <?php
	 echo "<div id='saved_progress-".$field."'><h4 style='color:green'>Progress Saved!</h4></div>";
	}else{
		echo "<h2 style='color:red'>ERROR ADDING ITEM!</h2>";	
	}
	 ?> 
              

      <div id="matrix_field_<?php echo $new_field; ?>"><a tabindex="-1" class="btn btn-success" href="javascript:ajaxpage('page_content/AJAX_PAGE/matrix_new_field.php', 'matrix_field_<?php echo $new_field; ?>',<?php echo $new_field; ?>,<?php echo $_GET['f2']; ?>);">+</a></div>