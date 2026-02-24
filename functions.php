<?php

function applyDiscounts(array &$books)
{
    // Iterates books
    foreach ($books as &$book) {

        // If the current book doesn't have the 'original_price' key, then add it
        if (!isset($book['original_price'])) {
            $book['original_price'] = $book['price'];
        }

        // Discount logic
        switch($book['genre']){
            case 'Science Fiction':
                $book['price'] = $book['original_price'] * 0.9; // 10% if it's Science Fiction
                break;
            
            case 'Fantasy':
                $book['price'] = $book['original_price'] * 0.95; // 5% if it's Fantasy
                break;

            default:
                $book['price'] = $book['original_price'];
        }
    } unset($book);
}

function calculateTotal(array $books)
{
    $total = 0.0;

    foreach ($books as $book) {
        $total += $book['price'];
    }

    return $total;
}

function sanitize($value)
{
    return strip_tags(trim($value));
}