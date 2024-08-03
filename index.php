<?php
require_once 'controllers/ItemController.php';

$controller = new ItemController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'create':
                $controller->create($_POST['name']);
                break;
            case 'update':
                $controller->update($_GET['id'], $_POST['name'], $_POST['checked']);
                break;
            case 'delete':
                $controller->delete($_GET['id']);
                break;
        }
    }
} else {
    $controller->index();
}
?>
