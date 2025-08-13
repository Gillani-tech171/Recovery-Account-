<?php 
require_once "db_config.php";

if (isset($_GET['save'])) {

    $Sr = $_GET['Sr'];
    $customer_name = $_GET['customer_name2'];
    $category = $_GET['category2'];
    $selling_price = $_GET['selling_price2'];
    $rent_price = $_GET['rent_price2'];

    // Convert shareholder arrays into comma-separated strings
    $shareholder_names = isset($_GET['shareholder_names']) 
        ? implode(",", $_GET['shareholder_names']) 
        : "";

    $shareholder_amounts = isset($_GET['shareholder_amounts']) 
        ? implode(",", $_GET['shareholder_amounts']) 
        : "";

    $starting_month = $_GET['starting_month2'];
    $status = $_GET['status2'];

    $query = mysqli_query($conn, "
        INSERT INTO shared_owners 
        (Sr, customer_name, category, selling_price, rent_price, shareholder_names, shareholder_amounts, starting_month, status) 
        VALUES 
        ('$Sr', '$customer_name', '$category', '$selling_price', '$rent_price', '$shareholder_names', '$shareholder_amounts', '$starting_month-01', '$status')
    ");

    if ($query) {
        header('location:index.php?action=Data is successfully inserted!');    
        exit();
    } else {
        echo "error occured!: " . mysqli_error($conn);
    }
}
?>
