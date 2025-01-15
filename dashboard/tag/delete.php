<?php 
include_once '../../class/TagsManager.php';

$manager = new TagsManager();

if(isset($_GET["id"])) {
    $manager->deleteTag($_GET['id']);
}

header('Location: ../manageTags.php');
?>