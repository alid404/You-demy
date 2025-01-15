<?php
require_once '../class/TagsManager.php';
require_once '../class/Tags.php';

session_start();

/* if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
} */

$TG = new TagsManager();
$tags = $TG->displayAllTags();

if (isset($_POST['submit'])) {
    $name = $_POST["name"];

    $newTag = new Tags($id = null, $name);
    $TG->addTag($newTag);

    header("Location: ./manageTags.php");
}

?>

<?php
include_once './layout/header.php';
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
                    <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center mt-5">Create a New Tag</h1>
                    <form method="POST" class="flex justify-between items-center p-5">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-600 font-medium mb-2">Tag Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter Tag name"
                                class="w-[800px] px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit"
                                class="bg-blue-500 text-white font-medium mt-3 py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Create Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="activity">
        <div class="title">
            <span class="text">All Tags</span>
        </div>

        <div class="activity-data">
            <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-600 uppercase text-sm tracking-wider">
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    foreach ($tags as $tag) {
                        echo $tag->renderRow();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once './layout/footer.php';
?>