<?php 
require_once "db_config.php";
if(isset($_GET['save'])){

$Sr = $_GET['Sr'];
$customer_name = $_GET['customer_name'];
$category = $_GET['category'];
$selling_price = $_GET['selling_price'];
$rent_price = $_GET['rent_price'];
$starting_month = $_GET['starting_month'];
$status = $_GET['status'];

$query = mysqli_query($conn, "INSERT INTO single_owner (Sr, customer_name, category, selling_price, rent_price, starting_month, status) VALUES ('$Sr', '$customer_name', '$category', '$selling_price', '$rent_price', '$starting_month-01', '$status')");
if($query){
    header('location:index.php?action=Data is successfully inserted!');    
}else{
    echo "error occured!: " . mysqli_error($conn);
}


}; 

?>