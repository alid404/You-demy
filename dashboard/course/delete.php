<?php 
include_once '../../class/CoursesManager.php';

$manager = new CoursesManager();

if(isset($_GET["id"])) {
    $manager->deleteCourse($_GET['id']);
}

header('Location: ../manageCourses.php');
?>