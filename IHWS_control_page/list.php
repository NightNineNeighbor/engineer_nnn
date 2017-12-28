<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>IHWS Homepage Ney</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">IHWStation</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


<div class = "text-center">
<img src="css/img_ihws/list.png"  />
</div>

    <div class = "row text-center">



          <div class="col-xs-5 text-right">
            <form method="GET" action="up.php">
            <h3>Printing list</h3>


              <?php
              $count = 1;
              $i = 1;
              $list = array('','','','','','','','','','','');
              if(!empty($_GET["last"]))
              $a = $_GET["last"];
              else {
                $a = 1;
              }

              for($i = 1; $i < $a ; $i++){
                $list[$i] = $_GET["a".$i];
              }

              $i=1;
              while($i<=10){
              if( !(empty($_GET[$i])) ){
                $list[$a] = $_GET[$i];
                $a = $a + 1;
              }
              $i = $i + 1;
            }

              $i = 1;
              while($i <= 10){
                echo "<div><input type=\"hidden\" name=\"$i\" value=\"$list[$i]\">$list[$i]</option></div>";
                $i = $i + 1;
              }
              echo "<input type=\"submit\"></form>";
              ?>
            </div>
<div class="col-xs-2">

</div>

            <div class="col-xs-5 text-left">
              <h3>Uploaded list</h3>
              <?php
                echo "<form method=\"GET\" action=\"list.php\">";
              $dir = "C:\\Bitnami\\wampstack-5.6.20-0\\apache2\\htdocs\\gcode";
              // Open a known directory, and proceed to read its contents
              if (is_dir($dir)) {
              if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                  if( !($file === '.'||$file=='..') )
                    echo "<div><input type=\"checkbox\" name=\"$count\" value=\"$file\">$file</option></div>";
                    $count = $count + 1;

                }
                echo "<input type=\"hidden\" name=\"last\" value=\"$a\"></option>";
                for($i = 1; $i < $a ; $i++){
                    echo "<input type=\"hidden\" name=\"a$i\" value=\"$list[$i]\"></option>";
                }
                closedir($dh);
              }
              }
              echo "<input type=\"submit\"></form>";
              ?>
            </div>
          </div>

          <div class="text-center">
          <form action="index.php" >
            <button type="submit" class="btn btn-sm btn-default">Home</button>
          </form>
          </div>


    </body>
</html>
