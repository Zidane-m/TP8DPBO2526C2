<?php
// Memuat seluruh file Controller yang tersedia
require_once __DIR__ . '/controllers/LecturerController.php';
require_once __DIR__ . '/controllers/DepartmentController.php';
require_once __DIR__ . '/controllers/CourseController.php';

// Mengambil parameter routing dari URL (default: lecturer & index)
$controllerName = $_GET['controller'] ?? 'lecturer';
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Memilih Controller sesuai parameter controller
switch ($controllerName) {
    case 'department':
        $controller = new DepartmentController();
        break;
    case 'course':
        $controller = new CourseController();
        break;
    case 'lecturer':
    default:
        $controller = new LecturerController();
        break;
}

// Menjalankan method pada Controller sesuai parameter action
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit($id);
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete($id);
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
?>
