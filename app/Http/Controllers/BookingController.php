<?php

require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Movie.php';
class BookingController extends BaseController {
    public function store() {
        $movie = Movie::find($_POST['movie_id']);
        if (!$movie) { http_response_code(400); echo "Invalid movie"; exit; }
        $qty = max(1, (int)($_POST['qty'] ?? 1));
        $total = $qty * (float)$movie['price'];
        $data = [
            'movie_id' => $movie['id'],
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'qty' => $qty,
            'total' => $total
        ];
        Booking::create($data);
        $id = Model::pdo()->lastInsertId();
        $_SESSION['last_booking_id'] = $id;
        $this->redirect('/booking/summary');
    }
    public function summary() {
        $booking = Booking::latestForSession();
        if (!$booking) { $this->redirect('/'); }
        $this->view('booking_summary', ['booking' => $booking]);
    }
}