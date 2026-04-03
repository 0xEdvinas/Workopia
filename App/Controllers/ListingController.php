<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

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
        $listings = $this->db->query("SELECT * FROM listings")->fetchAll();

        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    public function show($params)
    {
        $id = $params['id'] ?? null;

        $listing = $this->db->query(
            "SELECT * FROM listings WHERE id = :id",
            [
                'id' => $id
            ]
        )->fetch();

        if (!$listing) {
            return ErrorController::notFound('Listing not found');
        }

        loadView('listings/show', ['listing' => $listing]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    /** 
     * Store data in database
     * 
     * @return void
     */
    public function store()
    {
        $allowedFields = [
            'title',
            'description',
            'salary',
            'requirements',
            'benefits',
            'company',
            'address',
            'city',
            'state',
            'phone',
            'email',
            'tags'
        ];

        $newListinData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListinData['user_id'] =  1;

        $newListinData = array_map('sanitize', $newListinData);

        $requiredFields = ['title', 'description', 'email', 'city', 'state', 'salary'];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newListinData[$field]) || !Validation::string($newListinData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            // Reload view with errors
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListinData
            ]);
        } else {
            // Submit data
            $fields = [];

            foreach ($newListinData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);

            $values = [];

            foreach ($newListinData as $field => $value) {
                // Convert empty string to null
                if ($value === '') {
                    $newListinData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            $values = implode(', ', $values);

            $query = "INSERT INTO listings({$fields}) VALUES({$values})";
            $this->db->query($query, $newListinData);

            redirect('/listings');
        }
    }

    /**
     * Delete a listing
     * 
     * @param array $params
     * 
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', $params);

        // Set flash message
        $_SESSION['success_message'] = 'Listing successfully deleted';

        redirect('/listings');
    }

    /**
     * Show listing edit form
     *
     * @param array $params
     * 
     * @return void
     */
    public function edit($params)
    {
        $id = $params['id'] ?? null;

        $listing = $this->db->query(
            "SELECT * FROM listings WHERE id = :id",
            [
                'id' => $id
            ]
        )->fetch();

        if (!$listing) {
            return ErrorController::notFound('Listing not found');
        }

        loadView('listings/edit', ['listing' => $listing]);
    }

    /**
     * Update listing
     * 
     * @param array $params
     * 
     * @return void
     */
    public function update($params)
    {
        $id = $params['id'] ?? null;

        $listing = $this->db->query(
            "SELECT * FROM listings WHERE id = :id",
            [
                'id' => $id
            ]
        )->fetch();

        if (!$listing) {
            return ErrorController::notFound('Listing not found');
        }

        $allowedFields = [
            'title',
            'description',
            'salary',
            'requirements',
            'benefits',
            'company',
            'address',
            'city',
            'state',
            'phone',
            'email',
            'tags'
        ];

        $updateValues = [];

        $updateValues = array_intersect_key($_POST, array_flip($allowedFields));

        $updateValues = array_map('sanitize', $updateValues);

        $requiredFields = ['title', 'description', 'salary', 'city', 'state', 'email'];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            loadView('listing/edit', ['listing' => $listing, 'errors' => $errors]);
            exit;
        } else {
            // submit to database
            $updateFields = [];

            foreach (array_keys($updateValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }

            $updateFields = implode(', ', $updateFields);

            $updateQuery = "UPDATE listings SET $updateFields WHERE id = :id";

            $updateValues['id'] = $id;

            $this->db->query($updateQuery, $updateValues);

            $_SESSION['success_message'] = 'Listing updated';

            redirect('/listings/' . $id);
        }
    }
}
