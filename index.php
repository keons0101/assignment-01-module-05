<?php

require_once('./functions.php'); // Import from functions.php
date_default_timezone_set('America/Vancouver'); // Set Vancouver timezone by default

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
        'title' => 'The Hobbit',
        'author' => 'John Reuel',
        'price' => 16.50,
        'year' => 1937,
        'genre' => 'Fantasy'
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

$errors = [];
$message = '';
$log_message = "";
$logFilePath = './bookstore_log.txt';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $author = sanitize($_POST['author'] ?? '');
    $price = sanitize($_POST['price'] ?? '');
    $year = sanitize($_POST['year'] ?? '');
    $genre = sanitize($_POST['genre'] ?? '');

    // Check data format
    if ($title === '' || $author === '' || $genre === '' || $price === '' || $year === '') {
        $errors[] = 'All fields are required!';
    }

    if ($price !== '' && !is_numeric($price)) {
        $errors[] = 'Price must be a valid number!';
    } elseif ($price !== '') {
        $price = (float) $price;

        if ($price <= 0) {
            $errors[] = "Price must be more than 0!";
        }
    }

    if ($year !== '') {
        $year = (int) $year;

        if ($year < 1000 || $year > 2099) {
            $errors[] = "Year must be between 1000 and 2099!";
        }
    }
    // ------------------------------------------------------------------

    if (empty($errors)) {
        $books[] = [
            'title' => $title,
            'author' => $author,
            'price' => $price,
            'year' => $year,
            'genre' => $genre
        ];
        applyDiscounts($books);
        $message = 'Book added successfully';
        //echo $title . " " . $author . " " . $genre . " " . $price;

        // After adding the book, log it in txt file
        $ip = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $date = date("Y-m-d H:i:s");

        $log_message = "[" . $date . "] IP: " . $ip . " | " . $userAgent . " | " . "Added book: " . '"' . $title . '"' . " (" . $genre . ", " . "$" . $price . ")" . PHP_EOL;
        file_put_contents($logFilePath, $log_message, FILE_APPEND | LOCK_EX);

        //echo $log_message;
    }
}

applyDiscounts($books);
$total = calculateTotal($books);
?>

<!-- HTML Structure Section -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Book Store</title>
</head>

<body>
    <header>
        <h1>Welcome to Book Store</h1>
        <h2>Take a look and choose your next adventure!</h2>
    </header>
    <main>
        <div>
            <table>
                <!-- Columns titles -->
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Price</th>
                </tr>

                <!-- Source - https://stackoverflow.com/a/16046932
                Posted by Kamil Szot, modified by community. See post 'Timeline' for change history
                Retrieved 2026-02-21, License - CC BY-SA 3.0 -->
                <?php foreach ($books as $book): ?>
                    <!-- Display info of every book -->
                    <tr>
                        <td><?= htmlspecialchars($book['title']); ?></td>
                        <td><?= htmlspecialchars($book['author']); ?></td>
                        <td><?= $book['year']; ?></td>
                        <td><?= htmlspecialchars($book['genre']); ?></td>
                        <td class="price">
                            <?php
                            $final = (float) $book['price'];
                            $hasDiscount = false;
                            if (isset($book['original_price']) && (float) $book['original_price'] > $final) {
                                $hasDiscount = true;
                            }
                            ;

                            if ($hasDiscount) {
                                $original = (float) $book['original_price'];
                                echo '<span class="price-final">$' . number_format($final, 2) . '</span> ';
                                echo '<span class="price-original">$' . number_format($original, 2) . '</span>';
                            } else {
                                echo '<span class="price-final">$' . number_format($final, 2) . '</span>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h2>Total: $<?= number_format($total, 2) ?></h2>
            <h6 class="message"><?= $message ?></h6>
            <br>
            <h3>Logs</h3>
            <p>
                <?php 
                    $file = file_get_contents('./bookstore_log.txt', true);
                    echo nl2br(htmlspecialchars($file));
                ?>
            </p>
        </div>

        <div class="right-section">
            <!-- Form to add new books -->
            <form action="" method="POST" class="book-form">
                <fieldset>
                    <legend>Add New Book</legend>

                    <div class="field field__title">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required minlength="1" maxlength="120"
                            placeholder="Book title" />
                    </div>

                    <div class="field field__author">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" required minlength="2" maxlength="100"
                            placeholder="Author name" />
                    </div>

                    <div class="field field__year">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" required min="1000" max="2099" step="1"
                            placeholder="e.g. 2020" />
                    </div>

                    <div class="field field__price">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" required min="0" step="0.01" placeholder="0.00" />
                    </div>

                    <div class="field field__genre">
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre" required>
                            <option value="" selected disabled>Select a genre</option>
                            <option value="Science Fiction">Science Fiction</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Romance">Romance</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Drama">Drama</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                        </select>
                    </div>

                    <button type="submit">Add Book</button>
                </fieldset>
            </form>

            <section class="server_info">
                <p>Date: <?php if(isset($date)) echo $date ?> </p>
                <p>IP: <?php if(isset($ip)) echo $ip ?> </p>
                <p>User Agent: <?php if(isset($ip)) echo $userAgent ?> </p>
            </section>
        </div>
    </main>
</body>

</html>