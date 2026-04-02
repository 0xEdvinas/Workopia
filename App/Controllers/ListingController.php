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
            'email'
        ];

        $newListinData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListinData['user_id'] =  1;

        $newListinData = array_map('sanitize', $newListinData);

        $requiredFields = ['title', 'description', 'email', 'city', 'state'];

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
            echo 'success';
        }
    }
}
