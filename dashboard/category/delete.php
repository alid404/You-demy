<?php 
include_once '../../class/CategoriesManager.php';

$manager = new CategoriesManager();

if(isset($_GET["id"])) {
    $manager->deleteCategory($_GET['id']);
}

header('Location: ../manageCategories.php');
?>