<?php
require_once __DIR__ . '/../config/connection.php';
require_once 'Tags.php';

class TagsManager {
    public function displayAllTags() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM tags");
        $stmt->execute();
        $tags = $stmt->fetchAll();
        $data = [];
        foreach ($tags as $tag) {
            $data[] = new Tags($tag['id'], $tag['name']);
        }
        return $data;
    }

    public function addTag(Tags $tag) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO tags(name) VALUES(:name)");
        $stmt->execute([
            ':name' => $tag->getName()
        ]);
    }

    public function updateTag(Tags $tag) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE tags SET name = :name WHERE id = :id");
        $stmt->execute([
            ':name' => $tag->getName(),
            ':id' => $tag->getId()
        ]);
    }

    public function deleteTag($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM tags WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function getTag($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM tags WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $tag = $stmt->fetch();
        return new Tags($tag['id'], $tag['name']);
    }

    public function getTags() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM tags");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>