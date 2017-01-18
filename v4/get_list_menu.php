<?php
include_once "open_db.php";
$sql = "SELECT * FROM package a LEFT JOIN menu_type b ON a.id = b.package_id WHERE menutype_isactive=1 ORDER BY menutype_name";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
$ret = array();
while ($row = mysqli_fetch_assoc($result)) {
    $ret[] = $row;
}
if (empty($ret)) {
    $data = array(
        "empty" => true
        );
    echo json_encode($data);
    die();
}
$data = array(
    "empty" => false,
    "data" => $ret
    );
echo json_encode($data);
?>
