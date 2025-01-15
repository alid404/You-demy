<?php
require_once '../../class/TagsManager.php';
require_once '../../class/Tags.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}

$TG = new TagsManager();

if (isset($_GET['id'])) {
    $tag = $TG->getTag($_GET['id']);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $updateTag = new Tags(
            (int)$_POST["id"],
            $_POST["name"]
        );

        $TG->updateTag($updateTag);

        header('Location: ../manageTags.php');
    }
}

?>

<?php
include_once '../layout/header.php';
?>

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Manage Tags</span>
        </div>

        <div class="activity">
            <div class="activity-data">
                <div class="bg-white min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Edit Tag</h1>
                    <form method="POST" class="flex justify-around items-center">
                        <div class="mb-4">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($tag->getId()); ?>">
                            <label for="name" class="block text-gray-600 font-medium mb-2">Tag Name</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($tag->getName()); ?>"
                                class="w-[800px] px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit"
                                class="bg-blue-500 text-white font-medium py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Save Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once '../layout/footer.php';
?>