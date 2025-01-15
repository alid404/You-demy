<?php
require_once '../config/connection.php';
require_once '../class/CoursesManager.php';
require_once '../class/TagsManager.php';
require_once '../class/CategoriesManager.php';
require_once __DIR__ . '/../class/Course.php';

session_start();

/* if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
} */

$userId = $_SESSION["id"];

$tags = new TagsManager();
$course = new CoursesManager();

if (isset($_POST['submit'])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $user_id = $userId;
    $categories = $_POST["categories"];
    $tags = $_POST['tags'];

    $newCourse = new Course(null, $title, $description, $content, $user_id, $categories, $tags);

    $course->addCourse($newCourse);
}


?>

<?php
include_once './layout/courseHeader.php';
?>

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Manage Courses</span>
        </div>
        <div class="flex justify-between items-center  bg-white min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
            <h1 class="ml-5 text-2xl font-bold text-gray-700 mb-4 mt-5">Create a New Course</h1>
        </div>
    </div>


    <div class="activity">
        <div class="activity-data">
            <form method="post" id="form" enctype="multipart/form-data" class="bg-white p-6 mr-7 mt-8 min-w-full rounded-lg shadow-lg max-w-lg mx-auto space-y-4">
                <div>
                    <label for="title" class="block text-gray-600 font-medium mb-1">Title</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter the title">
                </div>
                <div>
                    <label for="description" class="block text-gray-600 font-medium mb-1">Description</label>
                    <input type="text" name="description" id="description" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter a short description">
                </div>
                <div>
                    <label for="content" class="block text-gray-600 font-medium mb-1">Content</label>
                    <textarea id="summernote" name="content"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write the content"></textarea>
                    <script>
                        $('#summernote').summernote({
                            placeholder: 'Create the content of the course',
                            tabsize: 2,
                            height: 120,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        });
                    </script>
                </div>
                <div>
                    <label for="categories" class="block text-gray-600 font-medium mb-1">Categories</label>
                    <select name="categories" id="categories"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select a category</option>
                        <?php
                        $categoriesManager = new CategoriesManager();
                        $categories = $categoriesManager->getCategories();

                        foreach ($categories as $row) {
                            echo "<option value='$row[id]'>$row[name]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="tags" class="block text-gray-600 font-medium mb-1">Tags</label>
                    <select id="tags" name="tags[]" multiple class="w-full">
                        <?php
                        $tagsManager = new TagsManager();
                        $tags = $tagsManager->getTags();

                        foreach ($tags as $tag) {
                            echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
                        }
                        ?>
                    </select>
                    <script>
                        new TomSelect("#tags", {
                            create: true,
                            persist: false,
                        });
                    </script>

                </div>
                <div class="text-right">
                    <button type="submit" name="submit"
                        class="bg-blue-500 text-white font-medium py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <?php
            $courses = $course->getAllCourses();
            foreach ($courses as $oneCourse) {
                echo "
                <div class='bg-white rounded-lg shadow-md p-6'>
                    <h3 class='text-xl font-semibold mb-2'>{$oneCourse['title']}</h3>
                    <p class='text-gray-600 mb-4'>{$oneCourse['description']}</p>
                    <div class='flex justify-between'>
                        <a href='../course.php?id={$oneCourse['id']}' class='no-underline text-white bg-blue-500 hover:bg-blue-700 hover:text-white hover:no-underline font-bold py-2 px-4 rounded'>Learn More</a>
                        <a href='./course/delete.php?id={$oneCourse['id']}' class='no-underline bg-red-500 hover:bg-red-700 hover:no-underline hover:text-white text-white font-bold py-2 px-4 rounded delete-course'>Delete</a>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</div>

<?php
include_once './layout/footer.php';
?>