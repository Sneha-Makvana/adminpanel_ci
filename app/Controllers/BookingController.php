<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\EventModel;
use App\Models\BookingModel;
use CodeIgniter\Controller;

class BookingController extends Controller
{
    public function view()
    {
        $bookingModel = new BookingModel();

        $bookings = $bookingModel
            ->select('booking.id, customer.name as customer_name, event.event_name, event.location, event.booking_ticket, booking.qty, booking.total, booking.booking_date')
            ->join('customer', 'customer.id = booking.customer_id')
            ->join('event', 'event.id = booking.event_id')
            ->findAll();

        return view('booking/view', ['bookings' => $bookings]);
    }

    public function create()
    {
        $customerModel = new CustomerModel();
        $eventModel = new EventModel();

        $customers = $customerModel->findAll();
        $events = $eventModel->findAll();

        return view('booking/booking', ['customers' => $customers, 'events' => $events]);
    }

    public function submitBooking()
    {
        $request = $this->request;

        $bookingData = $request->getPost('booking_data');

        $bookingModel = new BookingModel();

        foreach ($bookingData as $data) {
            $bookingModel->insert([
                'customer_id' => $data['customer_id'],
                'event_id' => $data['event_id'],
                'qty' => $data['qty'],
                'total' => $data['total']
            ]);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Booking submitted successfully']);
    }
    public function deleteBooking($id)
    {
        $bookingModel = new BookingModel();

        $booking = $bookingModel->find($id);
        if ($booking) {
            $bookingModel->delete($id);
            return $this->response->setJSON(['success' => true, 'message' => 'Booking deleted successfully.']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Booking not found.']);
    }
    public function display($bookingId)
    {
        return view('booking/profile', ['bookingId' => $bookingId]);
    }

    public function fetchBookingDetails($id)
    {
        $bookingModel = new BookingModel();

        $booking = $bookingModel
            ->select('booking.*, customer.name as customer_name, customer.email, customer.phone_no, customer.city, event.event_name, event.description, event.location, event.start_date, event.end_date, event.booking_ticket, event.event_images')
            ->join('customer', 'customer.id = booking.customer_id')
            ->join('event', 'event.id = booking.event_id')
            ->where('booking.id', $id)
            ->first();

        if ($booking) {
            return $this->response->setJSON(['success' => true, 'data' => $booking]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Booking not found']);
        }
    }
}
