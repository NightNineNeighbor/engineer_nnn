<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style type="text/css">
    *{ margin:0; padding:0; }
    li{ list-style : none; }
    a{ text-decoration : none; }

    html{width : 100%}
      .head{
        height : 50px;
        background: black;
      }
    </style>
</head>
<body>
  <div class = "head">
    <a href="index.html">
       <img src="css/img_ihws/ihws.png" height="50" >
    </a>
  </div>


<?php
$b = '';
$i=1;
while($i<=10){
if( !(empty($_GET[$i])) ){
  $b =  $b . $_GET[$i]." ";
}
$i = $i + 1;
}

echo "----- <br>";
echo $b;
//exec(./printgcode $b);
$handle = fopen("inputfile.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        echo "$line";// process the line read.
    }

    fclose($handle);
} else {
?>

<form action="index.html" >
  <input
   type="submit" value="main_page">
</form>



</body>
</html>
