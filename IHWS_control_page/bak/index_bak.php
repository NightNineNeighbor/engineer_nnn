<?php

/*
	5616f5962674d26741d2810600a6c5647620c4e3d2870177f09716b2379012c342d3b584c5672195d653722443f1c39254360007010381b721c741a532b03504d2849382d375c0d6806251a2946335a67365020100f160f17640c6a05583f49645d3b557856221b2
*/

$str = "5616f5962674d26741d2810600a6c5647620c4e3d2870177f09716b2379012c342d3b584c5672195d653722443f1c39254360007010381b721c741a532b03504d2849382d375c0d6806251a2946335a67365020100f160f17640c6a05583f49645d3b557856221b2";
$len = strlen($str);
echo "str : $str | len : $len<br \>";

$var = ord("|");
echo "| is $var <br \>";


function my_encrypt($flag, $key) {
	$key = md5($key);
	$message = $flag . "|" . $key;
	echo "key : $key <br \>";
	echo "flag : $flag <br \>";
  echo "message : $message <br \>";
	echo strlen($message);
	$encrypted = chr(101);
	$encrypted_ord = ord($encrypted);
	echo "encrypted before for : $encrypted | $encrypted_ord<br \>";
	//echo "message: $message[0] <br \>";
	//echo "message: $message[1] <br \>";
	//echo "message: $message[2] <br \>";
	//echo "message: $message[3] <br \>";
	//echo "message: $message[4] <br \>";
	for($i=0;$i<strlen($message);$i++) {
		$encrypted .= chr((ord($message[$i]) + ord($key[$i % strlen($key)]) + ord($encrypted[$i])) % 126);
		echo "for $i | $encrypted<br \>";
		//$unpack = unpack('h*', $encrypted);
		//echo "for $i | $unpack unpack<br \>";
	}
	echo "encrypted after for : $encrypted<br \>";
	$hexstr = unpack('h*', $encrypted);   //The unpack() function unpacks data from a binary string. ,h - Hex string, low nibble first
	$hexstr_1 = unpack('H*', $encrypted);
	echo "hexstr = ";
	print_r($hexstr);
	echo "<br \>";
	echo "hexstr = ";
	print_r($hexstr_1);
	echo "<br \>";
	return array_shift($hexstr);
}

$flag = "flag";
$key = 12323;

$result = my_encrypt($flag, $key);
echo "channged5";
echo "<br \><br \>THIS IS RESULT<br \><br \><br \>";
echo "result = $result<br \><br \>";

$result_len = strlen($result);
echo "result_len = $result_len<br \><br \>";
//$hexstr = unpack('h*', $flag);
//$result_hexstr = array_shift($hexstr);
//echo "unpack = $result_hexstr";


/*
$test = md5(1);
echo "$test <br \>";
$a = 0x01;
for($i=0;$i<10;$i++) {
	$test = $test + $a;
	echo "$test <br \>";
	$result = unpack('h*', $test);
	$result = array_shift($result);
	echo "$result <br \>";
}
*/
/*
for($i=0;$i<strlen($message);$i++) {
	$encrypted .= chr((ord($message[$i]) + ord($key[$i % strlen($key)]) + ord($encrypted[$i])) % 126);
	echo "for $i | $encrypted<br \>";
	//$unpack = unpack('h*', $encrypted);
	//echo "for $i | $unpack unpack<br \>";
}
*/








?>
