<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EventModel;
use App\Models\CategoryModel;
use App\Models\BookingModel;

class EventController extends Controller
{
    public function create()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        return view('event/event', ['categories' => $categories]);
    }

    public function view()
    {
        return view('event/view');
    }

    public function insert()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'event_name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[5]',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'booking_ticket' => 'required|numeric',
            'no_of_tickets' => 'required|integer',
            'category' => 'required',
            'event_images' => 'uploaded[event_images]|max_size[event_images,2048]|is_image[event_images]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $eventModel = new EventModel();

        $eventImages = $this->request->getFileMultiple('event_images');
        $eventImageNames = [];

        foreach ($eventImages as $image) {
            if ($image->isValid() && !$image->hasMoved()) {
                $imageName = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/events/', $imageName);
                $eventImageNames[] = $imageName;
            }
        }

        $eventModel->save([
            'event_name' => $this->request->getVar('event_name'),
            'description' => $this->request->getVar('description'),
            'location' => $this->request->getVar('location'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'booking_ticket' => $this->request->getVar('booking_ticket'),
            'no_of_tickets' => $this->request->getVar('no_of_tickets'),
            'category_id' => $this->request->getVar('category'),
            'event_images' => implode(',', $eventImageNames),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Event added successfully!'
        ]);
    }

    public function fetchEvent($id)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($id);

        if ($event) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $event
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Event not found.'
        ]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $eventModel = new EventModel();

        $event = $eventModel->find($id);
        if (!$event) {
            return $this->response->setJSON(['success' => false, 'message' => 'Event not found.']);
        }

        $validation = \Config\Services::validation();

        $rules = [
            'event_name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[5]',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'booking_ticket' => 'required|numeric',
            'no_of_tickets' => 'required|integer',
            'category' => 'required',
            'event_images' => 'if_exist|uploaded[event_images]|max_size[event_images,2048]|is_image[event_images]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $eventData = [
            'event_name' => $this->request->getPost('event_name'),
            'description' => $this->request->getPost('description'),
            'location' => $this->request->getPost('location'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'booking_ticket' => $this->request->getPost('booking_ticket'),
            'no_of_tickets' => $this->request->getPost('no_of_tickets'),
            'category_id' => $this->request->getPost('category'),
        ];

        $eventImages = $this->request->getFileMultiple('event_images');
        $eventImageNames = [];

        if (!empty($eventImages)) {
            foreach ($eventImages as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $imageName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/uploads/events/', $imageName);
                    $eventImageNames[] = $imageName;
                }
            }
        }

        if (!empty($eventImageNames)) {
            $existingImages = explode(',', $event['event_images']);
            $eventData['event_images'] = implode(',', array_merge($existingImages, $eventImageNames));
        }

        $eventModel->update($id, $eventData);

        return $this->response->setJSON(['success' => true, 'message' => 'Event updated successfully.']);
    }

    public function deleteImage($id)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($id);

        if (!$event) {
            return $this->response->setJSON(['success' => false, 'message' => 'Event not found.']);
        }

        $imageToDelete = $this->request->getPost('image_name');
        $eventImages = explode(',', $event['event_images']);

        if (($key = array_search($imageToDelete, $eventImages)) !== false) {
            if (file_exists(ROOTPATH . 'public/uploads/events/' . $imageToDelete)) {
                unlink(ROOTPATH . 'public/uploads/events/' . $imageToDelete);
            }

            unset($eventImages[$key]);
            $event['event_images'] = implode(',', $eventImages);

            $eventModel->update($id, ['event_images' => $event['event_images']]);

            return $this->response->setJSON(['success' => true, 'message' => 'Image deleted successfully.']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Image not found.']);
    }


    public function fetchAll()
    {
        $eventModel = new EventModel();
        $categoryModel = new CategoryModel();

        $events = $eventModel->findAll();
        foreach ($events as &$event) {
            $category = $categoryModel->find($event['category_id']);
            $event['category_name'] = $category ? $category['category_name'] : 'Unknown';
        }

        return $this->response->setJSON($events);
    }


    public function delete($id)
    {
        $eventModel = new EventModel();
        $bookingModel = new BookingModel();

        $event = $eventModel->find($id);
        if (!$event) {
            return $this->response->setJSON(['success' => false, 'message' => 'Event not found.']);
        }

        $bookings = $bookingModel->where('event_id', $id)->findAll();
        if (count($bookings) > 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Cannot delete event because there are bookings associated with it.']);
        }

        $eventModel->delete($id);
        return $this->response->setJSON(['success' => true, 'message' => 'Event deleted successfully.']);
    }

    public function display()
    {
        return view('event/profile');
    }
    public function details($id)
    {
        $eventModel = new EventModel();

        $event = $eventModel->find($id);

        if ($event) {
            $event['image_url'] = base_url('uploads/events/' . $event['event_images']);

            return $this->response->setJSON($event);
        } else {
            return $this->response->setJSON(['error' => 'Customer not found'], 404);
        }
    }
}
