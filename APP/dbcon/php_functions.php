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
//encrypt text
function pg_encrypt($str,$ky='',$codeT){
	if($codeT == "decode"){
		$str = str_replace("|Q","|Z|Z",$str); //replace PLSAApAA with +
		$str = str_replace("|S","+",$str); //replace PLSAApAA with +
		$str = str_replace("|A","/",$str); //replace rSlshAAsAA with /
		$str = str_replace("|Z","=",$str); //replace rSlshAAsAA with /
			

	
		$str = base64_decode($str);
		
	}
	if($ky=='')return $str;
	$ky=str_replace(chr(32),'',$ky);
	if(strlen($ky)<8)exit('key error');
	$kl=strlen($ky)<32?strlen($ky):32;
	$k=array();for($i=0;$i<$kl;$i++){
	$k[$i]=ord($ky{$i})&0x1F;}
	$j=0;for($i=0;$i<strlen($str);$i++){
	$e=ord($str{$i});
	$str{$i}=$e&0xE0?chr($e^$k[$j]):chr($e);
	$j++;$j=$j==$kl?0:$j;}
	
	//return base64_encode($str);
	if($codeT == 'encode'){
		//return base64_encode($str);
		
		$str = base64_encode($str);
		$str = str_replace("+","|S",$str);
		$str = str_replace("/","|A",$str);
		$str = str_replace("=","|Z",$str);
		$str = str_replace("|Z|Z","|Q",$str);
		return $str;
	}
		
		return $str;
}
//search an array eaasily
function arraySearch($needle,$haystack) {
	 foreach($haystack as $key=>$value) 
	 {
        $current_key=$key;
        if($value == $needle){
			echo "YES";
			return true;	
		}

		
    }
	return false;
}
//check to see if a file exists
function url_exists($filePath)
{
    return ($ch = curl_init($filePath)) ? @curl_close($ch) || true : false;
}
 
 
 //get full url of header
 function curPageURL() {
 $pageURL = 'http://';

 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

//Lighten HEX by percent 
function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

//Find index of item $PITEM_id in array $PROJ_array
function last_array_position($PROJ_array,$PITEM_id){
	$counter = 0;
	$counter_exact = 0;
	 foreach ($PROJ_array as $sub) {
		 if($PITEM_id ==$sub['PITEM_id']){
		// echo "test ".$sub['PITEM_id']."<br />";
		 $counter_exact = $counter;
		 }
		 $counter++;
		
	}
	return $counter_exact;
}
?>