<?php

class BaseController {
    protected function view($file, $data = []) {
        extract($data);
        require __DIR__ . '/../views/layout.php';
    }
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
    protected function isAdmin() {
        return !empty($_SESSION['is_admin']);
    }
    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            $this->redirect('/admin/login');
        }
    }
}