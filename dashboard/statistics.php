<?php

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}


?>

<?php
include_once './layout/header.php';
?>

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Statistics</span>
        </div>
    </div>

    <div class="activity">

        <div class="activity-data">

        </div>
    </div>
</div>

<?php
include_once './layout/footer.php';
?>