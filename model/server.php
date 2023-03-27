<?php

include_once './db.php';

if(isset($_POST['delete'])){

    $id = $_POST['id'];
    $sql = "DELETE FROM grocery WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
    
        echo "Record deleted successfully";

    } else {

        echo "Error deleting record: " . $conn->error;

    }
}

//insert
$item_name = $_POST['item_name']; 
$qty = $_POST['qty'];
$price = $_POST['price'];
$total = round($price * $qty);

$sql = "INSERT INTO grocery (item, qty, price, total)VALUES ('$item_name', '$qty', '$price', '$total')";
$data = array();

if ($conn->query($sql) === TRUE) {
    $retrieve_sql = "SELECT * FROM grocery";
    $result = $conn->query($retrieve_sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}