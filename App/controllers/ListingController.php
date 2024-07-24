<?php


namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;
use Framework\Authorisation;




class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();
        loadView('/listings/index', [
            'listings' => $listings
        ]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }


    //Store data in database


    public function store()
    {


        if (strlen($_FILES['image']['name']) > 0) {
            $image_name = uniqid() . '-' . $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];

            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $path = basePath('public/images/') . $image_name;
            $storedPath = '/images/' . $image_name;



            if (in_array($fileExtension, $allowedExtensions)) {
                $uploaded = move_uploaded_file($temp_name, $path);
                if (!$uploaded) {
                    Session::setFlashMessage('error_message', 'File failed to upload');
                }
            }
        } else {
            $storedPath = 'NULL';
        }

        $allowedFields = ['title', 'description', 'price', 'tags', 'postcode', 'phone', 'email'];

        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData['image_location'] = $storedPath;

        $newListingData['user_id'] = Session::get('user')['id'];

        $newListingData = array_map('sanitize', $newListingData);

        $requiredFields = ['title', 'description', 'price', 'email', 'postcode'];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        } else {
            $fields = [];
            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(',', $fields);
            $values = [];

            foreach ($newListingData as $field => $value) {
                if ($value === '') {
                    $newListingData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            $values = implode(',', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

            $this->db->query($query, $newListingData);

            Session::setFlashMessage('success_message', 'Listing created successfully');

            redirect('/listings');
        }
    }


    // Delete a listing


    public function destroy($params)
    {
        $id = $params['id'];
        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        //authhorisation
        if (!Authorisation::isOwner($listing->user_id)) {
            Session::setFlashMessage('error_message', 'You are not authorised to delete this listing');
            return redirect('/listings/' . $listing->id);
        }
        $this->db->query('DELETE FROM listings WHERE id = :id', $params);

        //set flash message
        Session::setFlashMessage('success', 'Listing deleted successfully');

        redirect('/listings');
    }

    public function edit($params)
    {

        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //authhorisation
        if (!Authorisation::isOwner($listing->user_id)) {
            Session::setFlashMessage('error_message', 'You are not authorised to edit this listing');
            return redirect('/listings/' . $listing->id);
        }

        //check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        loadView('listings/edit', [
            'listing' => $listing
        ]);
    }


    // Update a listing


    public function update($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        //authhorisation
        if (!Authorisation::isOwner($listing->user_id)) {
            Session::setFlashMessage('error_message', 'You are not authorised to edit this listing');
            return redirect('/listings/' . $listing->id);
        }

        $allowedFields = ['title', 'description', 'price', 'tags', 'postcode', 'phone', 'email'];

        $updatedValues = array_intersect_key($_POST, array_flip($allowedFields));

        $updatedValues = array_map('sanitize', $updatedValues);

        $requiredFields = ['title', 'description', 'price', 'email', 'postcode'];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updatedValues[$field]) || !Validation::string($updatedValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            loadView("listings/edit", [
                'errors' => $errors,
                'listing' => $listing
            ]);
            exit;
        } else {
            //submit to database

            $updateFields = [];

            foreach (array_keys($updatedValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }

            $updateFields = implode(',', $updateFields);

            $updateQuery = "UPDATE listings SET $updateFields WHERE id = :id";
            $updatedValues['id'] = $id;
            $this->db->query($updateQuery, $updatedValues);

            //set flash message
            Session::setFlashMessage('success', 'Listing Updated');

            redirect('/listings/' . $id);
        }
    }


    //search listings by keywords/postcode


    public function search()
    {
        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
        $postcode = isset($_GET['postcode']) ? trim($_GET['postcode']) : '';

        $query = "SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords)
        AND (postcode LIKE :postcode) ";

        $params = [
            'keywords' => "%{$keywords}%",
            'postcode' => "%{$postcode}%"
        ];
        // inspect($params);
        // inspectAndDie($query);
        $listings = $this->db->query($query, $params)->fetchAll();

        loadView('/listings/index', [
            'listings' => $listings,
            'keywords' => $keywords,
            'postcode' => $postcode,
        ]);
    }
}
