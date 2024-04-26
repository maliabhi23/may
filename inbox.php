<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    // Redirect to login page
    header('Location: login.php');
    exit();
}

// Retrieve user's email and password from session
$username = $_SESSION['abhimali656@gmail.com'];
$password = $_SESSION['artu qhry dwgw vqxx'];

// Your inbox.php code goes here
$server = '{imap.gmail.com:993/imap/ssl}INBOX';

$mailbox = imap_open($server, $username, $password);
if (!$mailbox) {
    die('Cannot connect to Gmail mailbox: ' . imap_last_error());
}

$mail_ids = imap_search($mailbox, 'ALL');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Gmail Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="inbox.php">Inbox</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="unread.php">Unread</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="compose.php">Compose</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Mail Inbox
                </div>
                <div class="card-body">
                    <?php
                    if ($mail_ids) {
                        // Sort mail IDs in descending order
                        rsort($mail_ids);

                        foreach ($mail_ids as $mail_id) {
                            $header = imap_headerinfo($mailbox, $mail_id);
                            $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                            $date = date("Y-m-d H:i:s", strtotime($header->date));
                            $subject = isset($header->subject) ? $header->subject : "<No Subject>";
                            echo "<div class='card mb-3'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'><a href='view_email.php?id=$mail_id'>$subject</a></h5>"; // Link to view_email.php with mail_id parameter
                            echo "<p class='card-text'>From: $from</p>";
                            echo "<p class='card-text'>Date: $date</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No new emails found.</p>";
                    }

                    imap_close($mailbox);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
