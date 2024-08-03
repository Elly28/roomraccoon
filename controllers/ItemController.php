<?php

include_once __DIR__ . '/../db.php';
include_once __DIR__ . '/../models/Item.php';

class ItemController {
    private $db;
    private $item;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->item = new Item($this->db);
    }

    public function index() {
        $stmt = $this->item->readAll();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../views/index.php';
    }

    public function create($name) {
        $this->item->name = $name;
        $this->item->create();
        header("Location: /room_raccoon/index.php");
    }

    public function update($id, $name, $checked) {
        $this->item->id = $id;
        $this->item->name = $name;
        $this->item->checked = $checked;
        $this->item->update();
        header("Location: /room_raccoon/index.php");
    }

    public function delete($id) {
        $this->item->id = $id;
        $this->item->delete();
        header("Location: /room_raccoon/index.php");
    }
}
?>
