<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Message</title>
    <link rel="icon" href="./logo.png" type="image/icon type">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #343a40;
            color: #ffffff;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
        }
        .navbar-nav {
            margin-left: auto;
        }
        .nav-link {
            color: #ffffff !important;
            margin-right: 20px;
        }
        .top {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .email-content {
            padding: 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }
        .email-actions {
            padding: 20px;
            background-color: #ffffff;
        }
        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Gmail Dashboard</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
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

    <div class="top">
        <h1>Email Message</h1>
    </div>

    <div class="mainbody">
        <div class="email-content">
            <?php
            session_start();

            // Check if user is logged in
            if(!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
                // Redirect to login page
                header('Location: login.php');
                exit();
            }

            // Retrieve email and password from session
            $username = $_SESSION['email'];
            $password = $_SESSION['password'];

            // Your view_email.php code goes here
            $server = '{imap.gmail.com:993/imap/ssl}INBOX';

            $mail_id = $_GET['id'];

            $mailbox = imap_open($server, $username, $password);
            if (!$mailbox) {
                die('Cannot connect to Gmail mailbox: ' . imap_last_error());
            }

            $body = imap_fetchbody($mailbox, $mail_id, 1);

            imap_close($mailbox);

            echo nl2br(htmlspecialchars($body)); // Convert newline characters to <br> tags and escape HTML entities
            ?>
        </div>
        <div class="email-actions">
            <form method="post" action="delete_email.php">
                <input type="hidden" name="mail_id" value="<?php echo $mail_id; ?>">
                <button type="submit">Delete Email</button>
            </form>
        </div>
    </div>
</body>
</html>
