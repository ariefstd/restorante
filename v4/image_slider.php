<?php
include_once "open_db.php";
$sql = "SELECT * FROM package a LEFT JOIN menu_type b ON a.id = b.package_id WHERE menutype_isactive=1 ORDER BY menutype_name";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name_package"]. " - Price: " . $row["price"]. " " . $row["menutype_name"]. "<br>";
    }
} else {
    echo "0 results";
}

?>

<html>
<head>
    <title>Nivo jQuery Slider Demo</title>
    
    <!--  Load the stylesheets  -->
    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<body>
    <div id="wrapper">
    
        <!-- The slider wrapper div  -->
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
            
                <!--  Images to slide through.  -->
                <img src="uploads/20150113_063527All_Day_Exclusive.jpg" data-thumb="uploads/20150113_063527All_Day_Exclusive.jpg" alt="" />
                <a href="http://dev7studios.com"><img src="uploads/20150113_064310Double_Hapiness.jpg" data-thumb="uploads/20150113_064310Double_Hapiness.jpg" alt="" title="This is an example of a caption" /></a>
                <img src="uploads/20150113_071322Season_Greeting.jpg" data-thumb="uploads/20150113_071322Season_Greeting.jpg" alt="" data-transition="slideInLeft" />
                <img src="uploads/20150113_071337Double_Happiness.jpg" data-thumb="uploads/20150113_071337Double_Happiness.jpg" alt="" title="#htmlcaption" />
            </div>
            
            <!--  Captions to show for images  -->
            <div id="htmlcaption" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
            </div>
        </div>

    </div>
    
    <!--  Load the javascript files  -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    
    //<!--  Load the slider  --> 
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    
    </script>
</body>
</html>