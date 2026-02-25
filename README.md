# assignment-01-module-05
# PHP Coursework 1 — Online Bookstore

## Project Description

This project is a simple **PHP-based online bookstore** created for Coursework 1.
The goal is to demonstrate core backend concepts using arrays, functions, conditionals, loops, POST handling, server data, file logging, and basic output formatting.

The application allows users to add books through an HTML form, automatically applies discounts to specific genres, calculates totals, and records actions in a log file.

---

## Features

* Book inventory stored as an array of associative arrays
* 10% discount applied to **Science Fiction** and 5% to **Fantasy** books using a function with pass-by-reference
* Form submission using **POST**
* Basic input validation and sanitization
* Total price calculation using loops
* Clear HTML table output
* Request information display:
    * Current date and time
    * User IP address
    * User agent
* File logging (`bookstore_log.txt`) for added books
* Nonrepudiation essay included in the repository

---

## Requirements

* PHP 8+
* AMPPS
* Web browser

---

## How to Run the Project

1. Clone or download this repository.
2. Place the project folder inside your local server directory (`www/`)
3. Start Apache.
4. Open your browser and go to: http://localhost/assignment-01-module-05/index.php

---

## Project Structure

/assignment-01-module-05
│
├── index.php                # Main application (form handling, display, logic)
├── functions.php            # Helper functions (discounts, totals, logging)
├── main.css                 # Styling
├── bookstore_log.txt        # Log file
├── nonrepudiation_essay.md  # Essay about nonrepudiation
└── README.md                # Project documentation
