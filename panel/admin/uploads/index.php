<?php
require '../../../protected/connection.php';
require '../../../protected/functions.php';

$conn = get_connection();

checksession($conn, $_SESSION['username']);

error_reporting(0);

$result = $conn->query("SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
$row = mysqli_fetch_array($result);

if ($row['isAdmin'] != "1") {
    header("Location: ../index.php");
}

if ($_POST['del']) {
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>kiba.shop - admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico"
        href="https://media.discordapp.net/attachments/825050645261844494/850951773475700756/Untitled169_20210606001819.png">
    <link rel="stylesheet" href="/assets/style.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://designreset.com/cork/ltr/demo3/plugins/table/datatable/datatables.js"></script>
    <script src="/assets/script.js"></script>
    <script src="/assets/uikit-icons.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://designreset.com/cork/ltr/demo3/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://designreset.com/cork/ltr/demo3/plugins/table/datatable/dt-global_style.css">
</head>

<body>
    <div class="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
        <nav class="uk-navbar-container uk-margin" uk-navbar="mode: click">
            <div class="uk-navbar-left">
                <a href="/" class="uk-navbar-item uk-logo"><img
                        src="https://media.discordapp.net/attachments/825050645261844494/850951773475700756/Untitled169_20210606001819.png"
                        alt="kiba.shop - Logo" style="height: 2em; -moz-user-select: none;" draggable="false"></a>
                <ul class="uk-navbar-nav">
                    <li><a href="/admin/stats">Stats</a></li>
                    <li><a href="/admin/users">users</a></li>
                    <li><a href="/admin/uploads" style="color: white">uploads</a></li>
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
            <div class="uk-overflow-auto">
                <form method="POST">
                    <table class="uk-table uk-table-middle uk-table-divider" name="table1" id="table1">
                        <thead>
                            <tr>
                                <th class="uk-table-expand uk-text-nowrap">Picture</th>
                                <th class="uk-table-expand uk-text-nowrap">Filename</th>
                                <th class="uk-table-expand uk-text-nowrap">Uploader</th>
                                <th class="uk-table-expand uk-text-nowrap">Date</th>
                                <th class="uk-table-expand uk-text-nowrap">IP</th>
                                <th class="uk-table-expand uk-text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $result = $conn->query("SELECT * FROM `uploads`");
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td class="uk-text-nowrap">
                                    <a href="/<?= $row['uploadName'] ?>">
                                        <?php if ($row['mimeType'] == "mp4" || $row['mimeType'] == "webm" || $row['mimeType'] == "mov") { ?>
                                        <video width="500px" controls>
                                            <source
                                                src="<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $row['uploadedBy'] . "/" . $row['uploadName'] . "." . $row['mimeType']; ?>"
                                                type="video/mp4">
                                            Your browser does not support HTML video.
                                        </video>
                                        <?php } ?>
                                        <?php if ($row['mimeType'] == "png" || $row['mimeType'] == "jpeg" || $row['mimeType'] == "jpg" || $row['mimeType'] == "gif") { ?>
                                        <div class="centered-cropped" width="100%"
                                            style="background-image: url(<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $row['uploadedBy'] . "/" . $row['uploadName'] . "." . $row['mimeType'] ?>);">
                                        </div>
                                        <?php } ?> </a>
                                </td>
                                <td class="uk-text-nowrap"><?= $row['uploadName'] ?>.<?= $row['mimeType'] ?>
                                </td>
                                <td class="uk-text-nowrap"><?= $row['uploadedBy'] ?></td>
                                <td class="uk-text-nowrap"><?php
                            $newdate = date("Y/d/m H:i", strtotime($row['date']));
                        $newdate = $newdate . ":00";
                        echo $newdate; ?></td>
                                <td class="uk-text-nowrap">::1</td>
                                <td class="uk-text-nowrap"><button class="uk-button uk-button-danger" type="submit"
                                        name="del" value="<?= $row['uploadName'] ?>">Delete</button>
                                </td>
                            </tr>
                            <?php
                    } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#table1').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },

            "stripeClasses": [],
            "lengthMenu": [3, 5, 10, 20, 50],
            "pageLength": 3,
            drawCallback: function () {
                $('.dataTables_paginate > .pagination').addClass(
                    ' pagination-style-13 pagination-bordered mb-5');
            }
        });
    </script>
</body>

</html>