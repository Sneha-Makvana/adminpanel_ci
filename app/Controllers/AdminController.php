<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\EventModel;
use App\Models\BookingModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $customerModel = new CustomerModel();
        $eventModel = new EventModel();
        $bookingModel = new BookingModel();

        $totalCustomers = $customerModel->countAllResults();
        $totalEvents = $eventModel->countAllResults();
        $totalBookings = $bookingModel->countAllResults();

        $latestBookings = $bookingModel
            ->select('booking.id, customer.name as customer_name, event.event_name, event.location, event.booking_ticket, booking.qty, (event.booking_ticket * booking.qty) as total')
            ->join('customer', 'customer.id = booking.customer_id')
            ->join('event', 'event.id = booking.event_id')
            ->orderBy('booking_date', 'DESC')
            ->findAll(5);

        return view('admin/dashboard', [
            'totalCustomers' => $totalCustomers,
            'totalEvents' => $totalEvents,
            'totalBookings' => $totalBookings,
            'latestBookings' => $latestBookings,
            'title' => 'Dashboard',
        ]);
    }

    public function getEvents()
    {
        $bookingModel = new BookingModel();
        $events = $bookingModel
            ->select('event.event_name as title, booking_date as start, customer.name as customerName, event.location as eventLocation, event.booking_ticket as eventPrice, booking.qty as bookingQty, (event.booking_ticket * booking.qty) as bookingTotal, event.category_id as eventCategory')
            ->join('event', 'event.id = booking.event_id')
            ->join('customer', 'customer.id = booking.customer_id')
            ->findAll();

        return $this->response->setJSON($events);
    }

    public function deleteBooking($id)
    {
        if (!$this->request->isAJAX()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $bookingModel = new BookingModel();
        if ($bookingModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Booking deleted successfully']);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete booking']);
    }
}
