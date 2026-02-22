<?php

// Import from functions.php
require_once('./functions.php');

// Books inventory
$books = [
    [
        'title' => 'Joyland',
        'author' => 'Stephen King',
        'price' => 20.99,
        'year' => 2013,
        'genre' => 'Mystery'
    ],
    [
        'title' => 'The Chain',
        'author' => 'Adrian McKinty',
        'price' => 18.75,
        'year' => 2019,
        'genre' => 'Thriller'
    ],
    [
        'title' => 'Gone Girl',
        'author' => 'Gillian Flynn',
        'price' => 16.50,
        'year' => 2012,
        'genre' => 'Mystery'
    ],
    [
        'title' => 'The Silent Patient',
        'author' => 'Alex Michaelides',
        'price' => 19.40,
        'year' => 2019,
        'genre' => 'Thriller'
    ],
    [
        'title' => 'Dune',
        'author' => 'Frank Herbert',
        'price' => 24.99,
        'year' => 1965,
        'genre' => 'Science Fiction'
    ],
    [
        'title' => 'Neuromancer',
        'author' => 'William Gibson',
        'price' => 17.30,
        'year' => 1984,
        'genre' => 'Science Fiction'
    ],
    [
        'title' => 'The Girl with the Dragon Tattoo',
        'author' => 'Stieg Larsson',
        'price' => 21.10,
        'year' => 2005,
        'genre' => 'Mystery'
    ],
    [
        'title' => 'The Da Vinci Code',
        'author' => 'Dan Brown',
        'price' => 15.99,
        'year' => 2003,
        'genre' => 'Thriller'
    ],
    [
        'title' => 'Foundation',
        'author' => 'Isaac Asimov',
        'price' => 22.80,
        'year' => 1951,
        'genre' => 'Science Fiction'
    ],
];

applyDiscounts($books);
$total = calculateTotal($books);