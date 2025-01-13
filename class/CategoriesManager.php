<?php
require_once __DIR__ . '/../config/connection.php';
require_once 'Categories.php';

class CategoriesManager {
    public function displayAllCategories() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        $data = [];
        foreach ($categories as $category) {
            $data[] = new Categories($category['id'], $category['name']);
        }
        return $data;
    }

    public function addCategory(Categories $category) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO categories(name) VALUES(:name)");
        $stmt->execute([
            ':name' => $category->getName()
        ]);
    }

    public function updateCategory(Categories $category) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $stmt->execute([
            ':name' => $category->getName(),
            ':id' => $category->getId()
        ]);
    }

    public function deleteCategory($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function getCategory($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $category = $stmt->fetch();
        return new Categories($category['id'], $category['name']);
    }

    public function getCategories() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare('SELECT * FROM categories');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>