<?php 
require_once __DIR__ . '/../config/connection.php';
require_once 'Course.php';

class CoursesManager {
    public function displayCourses() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses");
        $stmt->execute();
        $courses = $stmt->fetchAll();
        $data = [];
        foreach ($courses as $course) {
            $data[] = new Course($course['id'], $course['title'], $course['description'], $course['content'], $course['user_id'], $course['category_id']);
        }
        return $data;
    }

    public function addCourse(Course $course) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO courses (title, description, content, user_id, category_id) 
                                VALUES (:title, :description, :content, :user_id, :category_id)");
        $stmt->execute([
            ':title' => $course->getTitle(),
            ':description' => $course->getDescription(),
            ':content' => $course->getContent(),
            ':user_id' => $course->getUserId(),
            ':category_id' => $course->getCategoryId()
        ]);

        $course->setId($conn->lastInsertId());
        $this->addCourseTags($course);
    }

    public function addCourseTags(Course $course) {
        $conn = Database::getConnection();

        if (!empty($course->getTags())) {
            foreach ($course->getTags() as $tag) {
                $query = "SELECT id FROM Tags WHERE name = :tag_name";
                $stmt = $conn->prepare($query);
                $stmt->execute(['tag_name' => $tag]);
                $tagId = $stmt->fetchColumn();

                if (!$tagId) {
                    $query = "INSERT INTO Tags (name) VALUES (:name)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute(['name' => $tag]);
                    $tagId = $conn->lastInsertId();
                }

                $stmt = $conn->prepare("INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)");
                $stmt->execute(['course_id' => $course->getId(), 'tag_id' => $tagId]);
            }
        }
    }

    public function deleteCourse($id) {
        $conn = Database::getConnection();
        $query = "DELETE FROM course_tags WHERE course_id = :course_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':course_id' => $id
        ]);

        $stmt = $conn->prepare("DELETE FROM courses WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function getCourse(Course $course) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute([
            ':id' => $course->getId()
        ]);
        $course = $stmt->fetchAll();
        return new Course($course['id'], $course['title'], $course['description'], $course['content'], $course['user_id'], $course['category_id']);
    }

    public function getAllCourses() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCourse(Course $course) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE courses SET title = :title, description = :description, content = :content, user_id = :user_id, category_id = :category_id WHERE id = :id");
        $stmt->execute([
            ':title' => $course->getTitle(),
            ':description' => $course->getDescription(),
            ':content' => $course->getDescription(),
            ':user_id' => $course->getUserId(), 
            ':category_id' => $course->getCategoryId(),
            ':id' => $course->getId()
        ]);

        $this->updateCourseTags($course);
    }

    public function updateCourseTags(Course $course) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM CourseTags WHERE course_id = :course_id");
        $stmt->execute([
            ':course_id' => $course->getId()
        ]);

        $this->addCourseTags($course);
    }
}

?>