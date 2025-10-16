<?php

require_once __DIR__ . '/../models/Movie.php';
class MovieController extends BaseController {
    public function index() {
        $this->requireAdmin();
        $movies = Movie::all();
        $this->view('admin_movies', ['movies' => $movies]);
    }
    public function create() {
        $this->requireAdmin();
        $this->view('movie_form', ['movie' => null, 'action' => '/admin/movies/store']);
    }
    public function store() {
        $this->requireAdmin();
        Movie::create($_POST);
        $this->redirect('/admin/movies');
    }
    public function edit($id) {
        $this->requireAdmin();
        $movie = Movie::find($id);
        $this->view('movie_form', ['movie' => $movie, 'action' => '/admin/movies/update/' . $id]);
    }
    public function update($id) {
        $this->requireAdmin();
        Movie::update($id, $_POST);
        $this->redirect('/admin/movies');
    }
    public function delete($id) {
        $this->requireAdmin();
        Movie::delete($id);
        $this->redirect('/admin/movies');
    }
}