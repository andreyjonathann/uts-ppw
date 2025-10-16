<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Data film
    private function getAllMovies()
    {
        return [
            [
                'id' => 1,
                'title' => 'Avatar: The Way of Water',
                'genre' => 'Action, Sci-Fi',
                'price' => 50000,
                'rating' => 8.5,
                'category' => 'now_playing'
            ],
            [
                'id' => 2,
                'title' => 'John Wick: Chapter 4',
                'genre' => 'Action, Thriller',
                'price' => 45000,
                'rating' => 9.0,
                'category' => 'now_playing'
            ],
            [
                'id' => 3,
                'title' => 'The Little Mermaid',
                'genre' => 'Fantasy, Musical',
                'price' => 40000,
                'rating' => 7.5,
                'category' => 'now_playing'
            ],
            [
                'id' => 4,
                'title' => 'Fast X',
                'genre' => 'Action, Adventure',
                'price' => 55000,
                'rating' => 7.8,
                'category' => 'recommended'
            ],
            [
                'id' => 5,
                'title' => 'Guardians of the Galaxy Vol. 3',
                'genre' => 'Action, Comedy, Sci-Fi',
                'price' => 50000,
                'rating' => 8.8,
                'category' => 'recommended'
            ],
            [
                'id' => 6,
                'title' => 'Spider-Man: Across the Spider-Verse',
                'genre' => 'Animation, Action',
                'price' => 45000,
                'rating' => 9.2,
                'category' => 'recommended'
            ],
            [
                'id' => 7,
                'title' => 'Oppenheimer',
                'genre' => 'Biography, Drama',
                'price' => 50000,
                'rating' => 9.3,
                'category' => 'recommended'
            ],
            [
                'id' => 8,
                'title' => 'Barbie',
                'genre' => 'Comedy, Adventure',
                'price' => 45000,
                'rating' => 8.0,
                'category' => 'now_playing'
            ],
        ];
    }

    // Halaman beranda
    public function index()
    {
        $allMovies = $this->getAllMovies();
        
        $nowPlaying = array_filter($allMovies, function($movie) {
            return $movie['category'] === 'now_playing';
        });
        
        $recommended = array_filter($allMovies, function($movie) {
            return $movie['category'] === 'recommended';
        });

        return view('movies.index', compact('nowPlaying', 'recommended'));
    }

    // Halaman form booking
    public function booking($movie_id)
    {
        $allMovies = $this->getAllMovies();
        
        // Cari film berdasarkan ID
        $selectedMovie = null;
        foreach ($allMovies as $movie) {
            if ($movie['id'] == $movie_id) {
                $selectedMovie = $movie;
                break;
            }
        }

        // Jika film tidak ditemukan, balik ke beranda
        if (!$selectedMovie) {
            return redirect()->route('movies.index');
        }

        return view('movies.booking', compact('selectedMovie'));
    }

    // Halaman summary booking
    public function summary()
    {
        return view('movies.summary');
    }
}
