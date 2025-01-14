<?php 

class Tags {
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function renderRow() {
        $name = htmlspecialchars($this->name);

        return "
        <tr class='hover:bg-gray-100'>
            <td class='px-4 py-3'>$name</td>
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