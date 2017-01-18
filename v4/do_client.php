<?php

include_once "open_db.php";	
?>
<?php
//var_dump($_POST);

if(isset($_POST['menuid'])){
	$id = $_POST['menuid'];
	//$menu = $_POST['menutype'];

   	
	//$menu_id = $_GET['menu'];	
		foreach ($id as $menu_id=>$value) {
             //echo "Menu : ".$value."<br />";
?>
<input type="text" value="<?php echo $value ?>" name="idmenu" />

<?php      

    }
	$sql = "INSERT INTO teot (teot_idmenu) VALUES ('$value')";
	$result=mysqli_query($con,$sql);           
}else{
	$sql = "INSERT INTO teot (teot_idmenu) VALUES ('0')";
	$result=mysqli_query($con,$sql);    
    //echo "Test ... ";
}

?>
