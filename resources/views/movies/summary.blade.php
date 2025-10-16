<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Booking - MovieKu</title>
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

        .success-msg {
            text-align: center;
            color: green;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #666;
        }

        .value {
            font-weight: bold;
            color: #333;
        }

        .total-section {
            background: #333;
            color: white;
            padding: 12px;
            margin: 15px 0;
            text-align: center;
        }

        .total-section h2 {
            font-size: 0.95rem;
            margin-bottom: 4px;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .btn-container {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-home {
            background: #333;
            color: white;
        }

        .btn-home:hover {
            background: #555;
        }

        .btn-new {
            background: #ddd;
            color: #333;
        }

        .btn-new:hover {
            background: #ccc;
        }

        .no-booking {
            text-align: center;
            padding: 15px;
        }

        @media (max-width: 768px) {
            .container {
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

    <div class="container">
        <div id="bookingContent"></div>
    </div>

    <script>
        const bookingDataStr = sessionStorage.getItem('bookingData');
        const contentDiv = document.getElementById('bookingContent');

        if (bookingDataStr) {
            const booking = JSON.parse(bookingDataStr);

            const formatRupiah = (number) => {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
            };

            contentDiv.innerHTML = `
                <h1>Ringkasan Booking</h1>
                <p class="success-msg">✓ Booking Berhasil!</p>

                <div>
                    <div class="detail-row">
                        <span class="label">Nama:</span>
                        <span class="value">${booking.name}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Email:</span>
                        <span class="value">${booking.email}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Film:</span>
                        <span class="value">${booking.movieTitle}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Harga Tiket:</span>
                        <span class="value">${formatRupiah(booking.moviePrice)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Jumlah Tiket:</span>
                        <span class="value">${booking.tickets}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Tanggal:</span>
                        <span class="value">${booking.bookingDate}</span>
                    </div>
                </div>

                <div class="total-section">
                    <h2>Total Pembayaran</h2>
                    <div class="total-price">${formatRupiah(booking.totalPrice)}</div>
                </div>

                <div class="btn-container">
                    <a href="{{ route('movies.index') }}" class="btn btn-home">Beranda</a>
                    <a href="{{ route('movies.index') }}" class="btn btn-new" onclick="sessionStorage.removeItem('bookingData')">Booking Lagi</a>
                </div>
            `;
        } else {
            contentDiv.innerHTML = `
                <div class="no-booking">
                    <h1>Tidak ada data booking</h1>
                    <p>Silakan booking terlebih dahulu</p>
                    <div class="btn-container">
                        <a href="{{ route('movies.index') }}" class="btn btn-home">Beranda</a>
                    </div>
                </div>
            `;
        }
    </script>
</body>
</html>
