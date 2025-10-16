<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieKu - Pesan Tiket Bioskop Online</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } 

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        /* Navbar */
        .navbar {
            background: #1a1a1a;
            padding: 15px 20px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff6b6b;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: #ff6b6b;
        }

        /* Hero Section : untuk menampilkan informasi film terbaru */
        .hero {
            background: #333;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1rem;
        }

        /* Container : untuk menampung semua elemen */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Section Title : untuk menampilkan judul setiap bagian */
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 8px;
            color: #333;
            border-left: 3px solid #333;
            padding-left: 10px;
        }

        .section-description {
            color: #666;
            margin-bottom: 15px;
            padding-left: 13px;
            font-size: 0.9rem;
        }

        .category-badge {
            display: inline-block;
            background: #666;
            color: white;
            padding: 3px 10px;
            font-size: 0.7rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .category-badge.now-playing {
            background: #28a745;
        }

        .category-badge.recommended {
            background: #ffc107;
            color: #333;
        }

        .genre-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin: 6px 0;
        }

        .genre-tag {
            background: #e9ecef;
            color: #495057;
            padding: 2px 6px;
            font-size: 0.7rem;
        }

        /* Movies Grid : untuk menampilkan daftar film */
        .movies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }

        .movie-card {
            background: white;
            border: 1px solid #ddd;
            padding: 12px;
        }

        .movie-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .movie-card h3 {
            font-size: 1rem;
            margin-bottom: 6px;
            color: #333;
        }

        .movie-card .genre {
            color: #666;
            font-size: 0.85rem;
            margin: 4px 0;
        }

        .movie-card .rating {
            color: #ffc107;
            font-weight: bold;
            margin: 4px 0;
            font-size: 0.85rem;
        }

        .movie-card .price {
            font-weight: bold;
            color: #000;
            font-size: 1.1rem;
            margin: 8px 0;
        }

        .btn-booking {
            display: block;
            background: #333;
            color: white;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            margin-top: 8px;
        }

        .btn-booking:hover {
            background: #555;
        }

        /* Modal Styles : untuk menampilkan detail film */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 0;
            width: 90%;
            max-width: 500px;
            border: 1px solid #888;
        }

        .modal-header {
            background: #333;
            color: white;
            padding: 15px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.2rem;
        }

        .close-btn {
            float: right;
            font-size: 24px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            background: none;
            border: none;
        }

        .close-btn:hover {
            color: #ccc;
        }

        .modal-body {
            padding: 20px;
        }

        .movie-detail {
            margin-bottom: 10px;
        }

        .movie-detail-label {
            font-weight: bold;
            color: #666;
            margin-bottom: 3px;
            font-size: 0.9rem;
        }

        .movie-detail-value {
            color: #333;
            font-size: 1rem;
        }

        .movie-rating-big {
            color: #ffc107;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .movie-price-big {
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 8px;
        }

        .btn-modal {
            flex: 1;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-close {
            background: #ddd;
            color: #333;
        }

        .btn-close:hover {
            background: #ccc;
        }

        .btn-book {
            background: #333;
            color: white;
        }

        .btn-book:hover {
            background: #555;
        }

        .btn-detail {
            display: block;
            background: #333;
            color: white;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            margin-top: 8px;
            cursor: pointer;
            border: none;
            width: 100%;
        }

        .btn-detail:hover {
            background: #555;
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 1.5rem;
            }

            .movies-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .modal-content {
                width: 95%;
            }

            .modal-body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">🎬 MovieKu</div>
            <div class="nav-links">
                <a href="{{ route('movies.index') }}">Beranda</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section : untuk menampilkan informasi film terbaru -->
    <section class="hero">
        <h1>Selamat Datang di MovieKu</h1>
        <p>Pesan tiket bioskop favorit Anda dengan mudah dan cepat!</p>
        <p style="margin-top: 15px; font-size: 1rem;">Pilih film favorit Anda di bawah untuk mulai memesan tiket</p>
    </section>

    <!-- Main Content : untuk menampilkan daftar film -->
    <div class="container">
        <!-- Film Sedang Tayang -->
        <h2 class="section-title">🎬 Film Sedang Tayang</h2>
        <p class="section-description">Film-film terbaru yang sedang tayang di bioskop</p>
        <div class="movies-grid">
            @foreach($nowPlaying as $movie)
            <div class="movie-card">
                <span class="category-badge now-playing">SEDANG TAYANG</span>
                <h3>{{ $movie['title'] }}</h3>
                <div class="genre-tags">
                    @foreach(explode(', ', $movie['genre']) as $genre)
                        <span class="genre-tag">{{ $genre }}</span>
                    @endforeach
                </div>
                <p class="rating">⭐ {{ $movie['rating'] }}/10</p>
                <p class="price">Rp {{ number_format($movie['price'], 0, ',', '.') }}</p>
                <button class="btn-detail" onclick="showMovieDetail({{ json_encode($movie) }})">Lihat Detail</button>
            </div>
            @endforeach
        </div>

        <!-- Film Rekomendasi -->
        <h2 class="section-title">⭐ Film Rekomendasi</h2>
        <p class="section-description">Film-film pilihan dengan rating tinggi yang kami rekomendasikan</p>
        <div class="movies-grid">
            @foreach($recommended as $movie)
            <div class="movie-card">
                <span class="category-badge recommended">REKOMENDASI</span>
                <h3>{{ $movie['title'] }}</h3>
                <div class="genre-tags">
                    @foreach(explode(', ', $movie['genre']) as $genre)
                        <span class="genre-tag">{{ $genre }}</span>
                    @endforeach
                </div>
                <p class="rating">⭐ {{ $movie['rating'] }}/10</p>
                <p class="price">Rp {{ number_format($movie['price'], 0, ',', '.') }}</p>
                <button class="btn-detail" onclick="showMovieDetail({{ json_encode($movie) }})">Lihat Detail</button>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Detail Film -->
    <div id="movieModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Detail Film</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="movie-detail">
                    <div class="movie-detail-label">Judul Film</div>
                    <div class="movie-detail-value" id="modalMovieTitle"></div>
                </div>
                <div class="movie-detail">
                    <div class="movie-detail-label">Genre</div>
                    <div class="movie-detail-value" id="modalMovieGenre"></div>
                </div>
                <div class="movie-detail">
                    <div class="movie-detail-label">Rating</div>
                    <div class="movie-rating-big" id="modalMovieRating"></div>
                </div>
                <div class="movie-detail">
                    <div class="movie-detail-label">Harga Tiket</div>
                    <div class="movie-price-big" id="modalMoviePrice"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-modal btn-close" onclick="closeModal()">Tutup</button>
                <a href="#" class="btn-modal btn-book" id="modalBookingBtn">Pesan Tiket</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 MovieKu. Pesan Tiket Bioskop Online.</p>
    </footer>

    <script>
        // Fungsi untuk menampilkan modal detail film
        function showMovieDetail(movie) {
            const modal = document.getElementById('movieModal');
            
            // Isi data film ke modal
            document.getElementById('modalMovieTitle').textContent = movie.title;
            document.getElementById('modalMovieGenre').textContent = movie.genre;
            document.getElementById('modalMovieRating').textContent = '⭐ ' + movie.rating + '/10';
            document.getElementById('modalMoviePrice').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(movie.price);
            
            // Update tombol booking dengan movie_id
            const bookingBtn = document.getElementById('modalBookingBtn');
            bookingBtn.href = `/booking/${movie.id}`;
            
            // Tampilkan modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('movieModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Enable scrolling
        }

        // Tutup modal jika user klik di luar modal content
        window.onclick = function(event) {
            const modal = document.getElementById('movieModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
