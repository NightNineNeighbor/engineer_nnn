<?php
//if (!shell_exec("which openssl"))
//    die("Challenge Error: need openssl installed\n");
//if (isset($_GET['code']))
//    die(highlight_file(__FILE__));
function str_xor($str,$max_depth=0,$depth=0)
{
    $mid=strlen($str)/2;
    $left=substr($str,0,$mid);
    $right=substr($str,$mid);
    if ($depth<$max_depth)
    {
        $left=str_xor($left,$max_depth,$depth+1);
        $right=str_xor($right,$max_depth,$depth+1);
    }
    $out="";
    for ($i=0;$i<strlen($left);++$i)
        $out.=$left[$i]^$right[$i];
    return $out;
}


function hasher($string)
{
    if (!ctype_alnum($string))
        return null;
    $t=trim(shell_exec("echo -n '{$string}' | openssl dgst -whirlpool | openssl dgst -rmd160"));
    $t=str_replace("(stdin)= ","",$t); //some linux adds this
    if (!$t)
        return null;
    return bin2hex(str_xor(hex2bin($t),1));
}

$user='admin';
extract($_POST);
if (isset($password))
{
    if (hasher($user)==hasher($password) and $user!=$password)
        echo "Welcome! Flag is: ".include("flag.php");
    else
        echo "Invalid password.<br/>";
}

$var = hasher($user);
echo $var;
echo "program done";
?>
