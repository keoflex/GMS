<h1>License Information</h1>
<hr>
<div style="text-align: center; font-size: 18px;">
<?php
$lic = file_get_contents("../LICENSE.txt");
$lic = str_replace(array("\r", "\n"), '<br />', $lic);
echo $lic;
?> 
</div>