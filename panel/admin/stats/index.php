<?php
                                                                                                        require '../../../protected/connection.php';
                                                                                                        require '../../../protected/functions.php';

                                                                                                        $conn = get_connection();

                                                                                                        checksession($conn, $_SESSION['username']);

                                                                                              

                                                                                                        $result = $conn->query("SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
                                                                                                        $row = mysqli_fetch_array($result);

                                                                                                        if ($row['isAdmin'] != 1) {
                                                                                                            header('refresh:0; url=/dashboard/user/');
                                                                                                        }


$users = $conn->query("SELECT COUNT(*) FROM `users`");
$bans = $conn->query("SELECT COUNT(*) FROM `users` WHERE `isBanned`='1'");
$uploads = $conn->query("SELECT COUNT(*) FROM `uploads`");
$domains = $conn->query("SELECT COUNT(*) FROM `domains`");
$invites = $conn->query("SELECT COUNT(*) FROM `invites` WHERE `isUsed`='0'");

$usersrow = mysqli_fetch_array($users);
$bansrow = mysqli_fetch_array($bans);
$uploadsrow = mysqli_fetch_array($uploads);
$domainsrow = mysqli_fetch_array($domains);
$invitesrow = mysqli_fetch_array($invites);
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
                <ul class="uk-navbar-nav">
                    <li><a href="/admin/stats" style="color: white">Stats</a></li>
                    <li><a href="/admin/users">users</a></li>
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
    <header class="uk-block uk-block-large uk-margin-large-bottom uk-margin-large-top">
        <div class="uk-container uk-container-center">
            <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1">

                </div>
            </section>
        </div>
    </header><br>
    <div class="uk-container uk-margin-medium-top uk-margin-small-bottom">
        <div class="uk-child-width-1@s uk-grid-small uk-grid" uk-grid="">
            <div class="uk-first-column">
                <div class="uk-card uk-card-default uk-card-small">
                    <div class="uk-text-center uk-card-body">Registered Users: <span style="font-weight:bold;"><?php echo $usersrow[0]; ?></span></div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-small">
                    <div class="uk-text-center uk-card-body">Banned Users: <span style="font-weight:bold;"><?php echo $bansrow[0]; ?></span></div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-small">
                    <div class="uk-text-center uk-card-body">Files Uploaded: <span style="font-weight:bold;"><?php echo $uploadsrow[0]; ?></span></div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-small">
                    <div class="uk-text-center uk-card-body">Invites: <span style="font-weight:bold;"><?php echo $invitesrow[0]; ?></span></div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-small">
                    <div class="uk-text-center uk-card-body">Domains: <span style="font-weight:bold;"><?php echo $domainsrow[0]; ?></span></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>