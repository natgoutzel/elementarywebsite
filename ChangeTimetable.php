<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Το σχολείο μας</title>
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
            $(document).ready(function () {
                $().UItoTop({easingType: 'easeOutQuart'});
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
                    <h1> <a href="index.php"> <img src="images/logo.png" alt="Your Happy Family">	</a> </h1>
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
        <div class="main">
            <!--==============================Content=================================-->
            <div class="content"><div class="ic">More Website Templates @ TemplateMonster.com - December 16, 2013!</div>

                <?php
                echo 'το ωρολόγιο πρόγραμμα έχει ως εξής:';
                require_once 'helpers/dbConnectioni.php';

                $conn = getDbConnection();
                $timetable = "SELECT lessonprogram_id, class,lessonprogram_file FROM lessonprogram";

                $timetableResult = $conn->query($timetable);

                if ($timetableResult->num_rows > 0) {
                    // output data of each row
                    $table = "<table>%s</table>";
                    $rowAll = "";
                    while ($row = $timetableResult->fetch_assoc()) {
                        $rowS = "<tr><td>%s</td><td><a href='edittimetable/%s'>Edit</a></td></tr>";
                        $rowAll = $rowAll. sprintf($rowS,  $row['class'],  strval($row['lessonprogram_id']));
                       
                    }
                    echo sprintf($table,$rowAll);
                } else {
                    echo "0 results";
                }
                ?>

                <form method="POST" enctype="multipart/form-data">
                    ΤΑΞΗ: <input type="text" name="class">
                    ΕΠΙΛΕΨΤΕ ΑΡΧΕΙΟ: <input type="file" name="pdf" id="pdf">
                    <input type="submit" name="insert" value="OK" />
                </form>  

                <?php
                $isPost = filter_input(INPUT_POST, "insert");
                if (isset($isPost)) {
                    $class_name = filter_input(INPUT_POST, "class", FILTER_SANITIZE_STRING);
                    $dd = $_FILES["pdf"]["tmp_name"];
                    
                    $insertFile = "INSERT INTO lessonprogram (user_id,class,lessonprogram_file) VALUES (?,?,?)";
                    $stm = $conn->prepare($insertFile);
                    $userId = 1;

                    //$ff = unpack('C*', $contents);
                    // print_r($ff);

                    $null = NULL;
                    $stm->bind_param("isb", $userId, $class_name, $null);
                    //$stm->send_long_data(2, $contents);

                    $fp = fopen($dd, "r");
                    while (!feof($fp)) {
                        $stm->send_long_data(2, fread($fp, 8192));
                    }
                    fclose($fp);
                    $result = $stm->execute();

                    $stm->close();
                    $conn->close();
                    //print_r($contents[150]);
                }



//$insertFile = "INSERT INTO lessonprogram (user_id,class,lessonprogram_file) VALUES ('1','$class_name','$file')";
//if (mysqli_query($conn, $insertFile)) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $insertFile . "<br>" . mysqli_error($conn);
//}
//$conn->close();
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
            </div>
        </div>
    </body>
</html>                              
