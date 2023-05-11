<?php
require '../../../protected/connection.php';
require '../../../protected/functions.php';

$conn = get_connection();

checksession($conn, $_SESSION['username']);

error_reporting(0);

$result = $conn->query("SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
$row = mysqli_fetch_array($result);

if ($row['isAdmin'] != 1) {
    header('refresh:0; url=/dashboard/user/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>kiba.shop - admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="https://media.discordapp.net/attachments/825050645261844494/850951773475700756/Untitled169_20210606001819.png">
    <link rel="stylesheet" href="/assets/style.css" />
    <script src="/assets/script.js"></script>
    <script src="/assets/uikit-icons.min.js"></script>
</head>

<body>
    <div class="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
        <nav class="uk-navbar-container uk-margin" uk-navbar="mode: click">
            <div class="uk-navbar-left">
                <a href="/" class="uk-navbar-item uk-logo"><img src="https://media.discordapp.net/attachments/825050645261844494/850951773475700756/Untitled169_20210606001819.png" alt="kiba.shop - Logo" style="height: 2em; -moz-user-select: none;" draggable="false"></a>
                <ul class="uk-navbar-nav">
                    <li><a href="/admin/stats">Stats</a></li>
                    <li><a href="/admin/users" style="color: white">users</a></li>
                    <li><a href="/admin/uploads">uploads</a></li>
                    <li><a href="/admin/invites">invites</a></li>
                    <li><a href="/admin/domains">domains</a></li>
                </ul>
            </div>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li><a href="/dashboard/user">Back</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="uk-container uk-margin-medium-top uk-margin-medium-bottom">
        <h3 class="uk-text-center uk-margin-medium-bottom">
        </h3>
        <div class="uk-grid-large uk-flex uk-flex-center" uk-grid>

        </div>
    </div>
</body>

</html>