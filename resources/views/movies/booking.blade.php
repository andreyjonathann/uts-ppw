<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket - MovieKu</title>
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

        
        .navbar {
            background: #1a1a1a;
            padding: 15px 20px;
            color: white;
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

        .container {
            max-width: 500px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border: 1px solid #ddd;
        }

        h1 {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 4px;
            color: #333;
            font-weight: bold;
            font-size: 0.9rem;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 0.95rem;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #333;
        }

        .btn-container {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-submit {
            background: #333;
            color: white;
        }

        .btn-submit:hover {
            background: #555;
        }

        .btn-back {
            background: #ddd;
            color: #333;
        } 

        .btn-back:hover {
            background: #ccc;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        .form-group.error input,
        .form-group.error select {
            border-color: #dc3545;
        }

        .form-group.success input,
        .form-group.success select {
            border-color: #28a745;
        }

        .info-box {
            background: #f5f5f5;
            border-left: 3px solid #333;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 0.85rem;
            color: #333;
        }

        /* Ticket Counter Info */
        .ticket-info {
            background: #f8f9fa;
            padding: 8px;
            margin-top: 6px;
            font-size: 0.85rem;
            color: #666;
        }

        .ticket-info span {
            font-weight: bold;
            color: #333;
        }

        /* Pemilihan film  */
        .selected-movie-box {
            background: #333;
            color: white;
            padding: 15px;
            margin-bottom: 15px;
        }

        .selected-movie-box h3 {
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .selected-movie-box .movie-info-item {
            margin: 4px 0;
            font-size: 0.9rem;
        }

        .selected-movie-box .movie-info-item strong {
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            
            .btn-container {
                flex-direction: column;
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

    <div class="container">
        <h1>Form Booking Tiket</h1>

        <!-- Pemilihan film -->
        <div class="selected-movie-box">
            <h3>🎬 Film yang Dipilih</h3>
            <div class="movie-info-item"><strong>Judul:</strong> {{ $selectedMovie['title'] }}</div>
            <div class="movie-info-item"><strong>Genre:</strong> {{ $selectedMovie['genre'] }}</div>
            <div class="movie-info-item"><strong>Rating:</strong> ⭐ {{ $selectedMovie['rating'] }}/10</div>
            <div class="movie-info-item"><strong>Harga:</strong> Rp {{ number_format($selectedMovie['price'], 0, ',', '.') }}</div>
            <div class="movie-info-item"><strong>Kategori:</strong> 
                @if($selectedMovie['category'] === 'now_playing')
                    <span style="background: #28a745; padding: 2px 8px; border-radius: 4px;">SEDANG TAYANG</span>
                @else
                    <span style="background: #ffc107; color: #333; padding: 2px 8px; border-radius: 4px;">REKOMENDASI</span>
                @endif
            </div>
        </div>

        <div class="info-box">
            ℹ️ <strong>Informasi:</strong> Maksimal pemesanan 10 tiket per transaksi. Pastikan semua data terisi dengan benar.
        </div>

        <form id="bookingForm">
            <div class="form-group">
                <label for="name">Nama Lengkap <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
                <div class="error-message" id="nameError">Nama harus diisi (minimal 3 karakter)</div>
            </div>

            <div class="form-group">
                <label for="email">Email <span style="color: red;">*</span></label>
                <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
                <div class="error-message" id="emailError">Email tidak valid</div>
            </div>

            <div class="form-group">
                <label for="tickets">Jumlah Tiket <span style="color: red;">*</span></label>
                <input type="number" id="tickets" name="tickets" min="1" max="10" placeholder="Masukkan jumlah tiket (1-10)" required>
                <div class="error-message" id="ticketsError">Jumlah tiket harus antara 1-10</div>
                <div class="ticket-info" id="ticketInfo" style="display: none;">
                    Total Harga: <span id="totalPrice">Rp 0</span>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('movies.index') }}" class="btn btn-back">Kembali</a>
                <button type="submit" class="btn btn-submit">Pesan Sekarang</button>
            </div>
        </form>
    </div>

    <script>
        // Data film yang dipilih dari server
        const selectedMovie = {
            id: {{ $selectedMovie['id'] }},
            title: "{{ $selectedMovie['title'] }}",
            genre: "{{ $selectedMovie['genre'] }}",
            price: {{ $selectedMovie['price'] }},
            rating: {{ $selectedMovie['rating'] }},
            category: "{{ $selectedMovie['category'] }}"
        };

        // Real-time validation dan total harga
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const ticketsInput = document.getElementById('tickets');
        const bookingForm = document.getElementById('bookingForm');

        // Validasi Nama (harus real-time)
        nameInput.addEventListener('blur', function() {
            const nameValue = this.value.trim();
            const nameGroup = this.parentElement;
            const nameError = document.getElementById('nameError');

            if (nameValue.length === 0) {
                nameGroup.classList.add('error');
                nameGroup.classList.remove('success');
                nameError.style.display = 'block';
                nameError.textContent = 'Nama harus diisi';
            } else if (nameValue.length < 3) {
                nameGroup.classList.add('error');
                nameGroup.classList.remove('success');
                nameError.style.display = 'block';
                nameError.textContent = 'Nama minimal 3 karakter';
            } else {
                nameGroup.classList.remove('error');
                nameGroup.classList.add('success');
                nameError.style.display = 'none';
            }
        });

        // Validasi Email (harus real-time)
        emailInput.addEventListener('blur', function() {
            const emailValue = this.value.trim();
            const emailGroup = this.parentElement;
            const emailError = document.getElementById('emailError');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailValue.length === 0) {
                emailGroup.classList.add('error');
                emailGroup.classList.remove('success');
                emailError.style.display = 'block';
                emailError.textContent = 'Email harus diisi';
            } else if (!emailRegex.test(emailValue)) {
                emailGroup.classList.add('error');
                emailGroup.classList.remove('success');
                emailError.style.display = 'block';
                emailError.textContent = 'Format email tidak valid';
            } else {
                emailGroup.classList.remove('error');
                emailGroup.classList.add('success');
                emailError.style.display = 'none';
            }
        });

        // Validasi Jumlah Tiket dan Update Harga (real-time)
        ticketsInput.addEventListener('input', function() {
            const ticketsValue = parseInt(this.value);
            const ticketsGroup = this.parentElement;
            const ticketsError = document.getElementById('ticketsError');

            if (isNaN(ticketsValue) || ticketsValue < 1) {
                ticketsGroup.classList.add('error');
                ticketsGroup.classList.remove('success');
                ticketsError.style.display = 'block';
                ticketsError.textContent = 'Jumlah tiket minimal 1';
            } else if (ticketsValue > 10) {
                ticketsGroup.classList.add('error');
                ticketsGroup.classList.remove('success');
                ticketsError.style.display = 'block';
                ticketsError.textContent = 'Jumlah tiket maksimal 10';
                this.value = 10; // Auto-correct ke 10
            } else {
                ticketsGroup.classList.remove('error');
                ticketsGroup.classList.add('success');
                ticketsError.style.display = 'none';
            }

            updateTotalPrice();
        });

        // Fungsi untuk update total harga
        function updateTotalPrice() {
            const tickets = parseInt(ticketsInput.value);
            const ticketInfo = document.getElementById('ticketInfo');
            const totalPriceSpan = document.getElementById('totalPrice');

            if (tickets >= 1 && tickets <= 10) {
                const total = selectedMovie.price * tickets;
                totalPriceSpan.textContent = 'Rp ' + total.toLocaleString('id-ID');
                ticketInfo.style.display = 'block';
            } else {
                ticketInfo.style.display = 'none';
            }
        }

        // Submit form dengan validasi lengkap
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const tickets = parseInt(ticketsInput.value);

            // Validasi 
            let isValid = true;

            // Validasi Nama
            if (name.length === 0 || name.length < 3) {
                nameInput.parentElement.classList.add('error');
                document.getElementById('nameError').style.display = 'block';
                isValid = false;
            }

            // Validasi Email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                emailInput.parentElement.classList.add('error');
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }

            // Validasi Jumlah Tiket
            if (isNaN(tickets) || tickets < 1 || tickets > 10) {
                ticketsInput.parentElement.classList.add('error');
                document.getElementById('ticketsError').style.display = 'block';
                isValid = false;
            }

            // Jika tidak valid, tampilkan alert dan hentikan
            if (!isValid) {
                alert('⚠️ Mohon lengkapi semua field dengan benar!\n\n' +
                      '- Nama minimal 3 karakter\n' +
                      '- Email harus valid\n' +
                      '- Jumlah tiket 1-10');
                return;
            }

            // Hitung total harga
            const totalPrice = selectedMovie.price * tickets;

            // Buat objek booking
            const bookingData = {
                name: name,
                email: email,
                movieTitle: selectedMovie.title,
                moviePrice: selectedMovie.price,
                movieGenre: selectedMovie.genre,
                movieRating: selectedMovie.rating,
                tickets: tickets,
                totalPrice: totalPrice,
                bookingDate: new Date().toLocaleString('id-ID')
            };

            // Simpan ke sessionStorage
            sessionStorage.setItem('bookingData', JSON.stringify(bookingData));

            // Redirect ke halaman summary
            window.location.href = "{{ route('movies.summary') }}";
        });
    </script>
</body>
</html>
