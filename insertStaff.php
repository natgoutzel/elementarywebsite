<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ΔΙΑΓΡΑΦΗ ΚΑΘΗΓΗΤΗ</title>
	<meta charset="utf-8">
	<meta name = "format-detection" content = "telephone=no" />
	<link rel="icon" href="images/favicon.ico">
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery-migrate-1.1.1.js"></script>
	<script src="js/script.js"></script> 
	<script src="js/jquery.ui.totop.js"></script>
	<script src="js/superfish.js"></script>
	<script src="js/jquery.equalheights.js"></script>
	<script src="js/jquery.mobilemenu.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script>
            $(document).ready(function(){
            $().UItoTop({ easingType: 'easeOutQuart' });
            }) 
	</script>
		<!--[if lt IE 8]>
		<div style=' clear: both; text-align:center; position: relative;'>
			<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
				<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
			</a>
		</div>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<link rel="stylesheet" media="screen" href="css/ie.css">
		<![endif]-->
    </head>
<body class="" id="top">
<!--==============================header=================================-->
    <header>
	<div class="clear"></div>
            <div class="container_12">
		<div class="grid_12">
		<h1> <a href="index.html"> <img src="images/logo.png" alt="Your Happy Family">	</a> </h1>
                    <div class="menu_block">
			<nav class="horizontal-nav full-width horizontalNav-notprocessed">
                            <ul class="sf-menu">
                                <li class="current"><a href="index.php">Αρχική</a> </li>
                                <li><a href="ourschool.php">Το Σχολειο μας </a></li>
                                <li><a href="parents.php">Για γονεις</a></li>
                                <li><a href="actions.php">Δρασεις </a></li>
                                <li><a href="europianprograms.php">Ευρωπαϊκα Προγραμματα</a></li>
                            </ul>
			</nav>
                    </div>    
                    <div class="clear"></div>
		</div>
            </div>
    </header>

<!--==============================Content=================================-->

<?php
require_once 'helpers/dbConnectioni.php';

$conn = getDbConnection();
$insertion = filter_input(INPUT_POST,"insert");
    if(isset($insertion)){
    $staff_fname= filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $staff_lname= filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $staff_specialty= filter_input(INPUT_POST, 'specialty', FILTER_SANITIZE_STRING);
   
    $insertsql = "INSERT INTO staff (user_id,staff_firstname,staff_lastname,staff_specialty) VALUES(?,?,?,?)";
    $insertstm = $conn->prepare($insertsql);
    $uid=1;
    $insertstm->bind_param("isss",$uid, $staff_fname, $staff_lname, $staff_specialty);
    $insertresutl = $insertstm->execute();
    
    if ($insertresutl === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    }
    $conn->close();
?>
<!--===============footer=================================-->
<footer>	
    <div class="hor bg3"></div>
	<div class="container_12">
            <div class="grid_12 ">  
                <div class="socials">
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
                <div class="clear"></div>
		</div>
		<div class="copy">
                    <strong>Δημοτικό Σχολείο Σκουτάρεως</strong>   &copy; <span id="copyright-year"></span> | <a href="#">Privacy Policy</a><br>
                    Website designed by <a href="http://informatics.teicm.gr/" rel="nofollow">ΤΕΙ Κεντρικής Μακεδονίας Τμήμα ΜηχανικώνΠληροφορικής</a>
		</div>  
            </div>
	</div>  
</footer>


</body>
</html>