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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
</head>

<body>
    <header>
        <h1>Welcome to Book Store</h1>
        <h2>Take a look and choose your next adventure!</h2>
    </header>
    <main>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Price</th>
            </tr>

            // Source - https://stackoverflow.com/a/16046932
            // Posted by Kamil Szot, modified by community. See post 'Timeline' for change history
            // Retrieved 2026-02-21, License - CC BY-SA 3.0
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['title']; ?></td>
                    <td><?= $book['author']; ?></td>
                    <td><?= $book['year']; ?></td>
                    <td><?= $book['genre']; ?></td>
                    <td><?= $book['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>

</html>