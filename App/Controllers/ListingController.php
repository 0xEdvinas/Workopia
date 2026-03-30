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
}
