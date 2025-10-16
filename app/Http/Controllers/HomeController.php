<?php

require_once __DIR__ . '/../models/Movie.php';
require_once __DIR__ . '/../models/Booking.php';
class HomeController extends BaseController {
    public function index() {
        $movies = Movie::all();
        $this->view('home', ['movies' => $movies]);
    }
    public function show($id) {
        $movie = Movie::find($id);
        if (!$movie) { http_response_code(404); echo "Movie not found"; exit; }
        $this->view('movie_detail', ['movie' => $movie]);
    }
}