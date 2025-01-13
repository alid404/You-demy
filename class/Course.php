<?php

class Course {
    public $id;
    public $title;
    public $description;
    public $content;
    public $user_id;
    public $category_id;
    public $tags = [];

    public function __construct($id = null, $title = null, $description = null, $content = null, $user_id = null, $category_id = null, $tags = []) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->tags = $tags;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this-> description = $description;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function renderRow() {
        $id = htmlspecialchars($this->id);
        $title = htmlspecialchars($this->title);
        $category_id = htmlspecialchars($this->category_id);

        return "
        <tr class='hover:bg-gray-100'>
            <td class='px-4 py-3'>$id</td>
            <td class='px-4 py-3'>$title</td>
            <td class='px-4 py-3'>$category_id</td>
            <td class='px-4 py-3'>
                <center>
                    <div class='relative'>
                        <button><a href='../dashboard/tag/edit.php?id=$this->id' class='block px-4 py-2 text-gray-700 rounded-full hover:bg-green-100'>Edit</a></button>
                        <button><a href='../dashboard/tag/delete.php?id=$this->id' class='block px-4 py-2 text-gray-700 rounded-full hover:bg-red-100'>Delete</a></button>
                    </div>
                </center>
            </td>
        </tr>
        ";
    }
}


?>