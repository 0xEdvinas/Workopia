<?php

namespace App\Controllers;

use Framework\Database;

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

        loadView('home', [
            'listings' => $listings
        ]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;

        $listing = $this->db->query(
            "SELECT * FROM listings WHERE id = :id",
            [
                'id' => $id
            ]
        )->fetch();

        loadView('listings/show', ['listing' => $listing]);
    }

    public function create()
    {
        loadView('listings/create');
    }
}
