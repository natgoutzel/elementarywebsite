<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ΔΙΑΧΕΙΡΙΣΗ ΠΡΟΣΩΠΙΚΟΥ</title>
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
					<h1>
						<a href="index.php">
							<img src="images/logo.png" alt="Your Happy Family">
						</a>
					</h1>
					<div class="menu_block">
						<nav class="horizontal-nav full-width horizontalNav-notprocessed">
							<ul class="sf-menu">
                                                            <li class="current"><a href="index.php">Αρχική</a>
									
                                                            </li>
                                                                <li><a href="ourschool.php">Το Σχολειο μας </a></li>
                                                                <li><a href="parents.php">Για γονεις</a></li>
                                                                <li><a href="actions.php">Δρασεις </a></li>
                                                                <li><a href="europianprograms.php">Ευρωπαϊκα Προγραμματα</a></li>
                                                        </ul>
						</nav>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</header>

<!--==============================Content=================================-->
<div class="content"><div class="ic">More Website Templates @ TemplateMonster.com - December 16, 2013!</div></div>
    <?php
    echo 'Οι κατηγορίες προγραμματων που υπάρχουν είναι οι εξής:';
    require_once 'helpers/dbConnectioni.php';

    $conn = getDbConnection();
    $category="SELECT category_title FROM program_category";
                    
                    $categoryResult = $conn->query($category);
                   
                    if ($categoryResult->num_rows > 0) {
                        // output data of each row
                        while($row = $categoryResult->fetch_assoc()) {
                            echo $row['category_title'];
                            echo '</br>';
                             
                        }
                    } else {
                        echo "0 results";
                    }


    ?>
  
    <form method="POST">
    <h4>ΕΙΣΑΓΕΤΕ ΟΝΟΜΑ ΚΑΤΗΓΟΡΙΑΣ</h4>
    ΟΝΟΜΑ: <input type="text" name="name">
    <input type="submit" name="insert" value="ΕΙΣΑΓΩΓΗ" />
    </form>  

<?php

$category_name= mysql_real_escape_string($_POST['name']);

$sql="INSERT INTO program_category (user_id,category_title) VALUES ('1','$category_name')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$conn->close();
?>
<!--==============================footer=================================-->
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
		</div>
	</body>
</html>