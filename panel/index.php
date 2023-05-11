<?php
require '../protected/connection.php';
require '../protected/functions.php';

$conn = get_connection();

error_reporting(0);

function fetch_uploads(mysqli_wrapper $conn) {
    $query = $conn->query("SELECT COUNT(1) FROM uploads WHERE uploadedBy='" . $_SESSION['username'] . "'");
    $row = $query->fetch_array()[0] ?? '';

    return $row;
}


if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

$account_query = $conn->query('SELECT * FROM users WHERE username=?', [$_SESSION['username']]);
$account_data = $account_query->fetch_assoc();

$upquery = $conn->query("SELECT COUNT(*) FROM uploads WHERE uploadedBy='" . $_SESSION['username'] . "'");
$updata = $upquery->fetch_assoc();

echo $updata[0];

fopen('../uploads/'. $account_data['username'].'/index.php', 'x');

mkdir("../uploads/" . $account_data['username']);


if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location: ../");
}

$df = disk_free_space("C:");

$dt = disk_total_space("C:");
/* now we calculate the disk space used (in bytes) */
$du = $dt - $df;
/* percentage of disk used - this will be used to also set the width % of the progress bar */
$dp = sprintf('%.2f', ($du / $dt) * 100);

function formatBytes($bytes)
{
    if ($bytes > 0) {
        $i = floor(log($bytes) / log(1024));
        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        return sprintf('%.02F', round($bytes / pow(1024, $i), 1)) * 1 . ' ' . @$sizes[$i];
    } else {
        return 0;
    }
}


$invitedlquery = $conn->query("SELECT count('1') FROM `invites` WHERE `owner`='" . ($_SESSION["username"]) . "' and isUsed=0");
$invitedlrow = mysqli_fetch_array($invitedlquery);


$upquery = $conn->query("SELECT count('1') FROM `uploads` WHERE `uploadedBy`='" . ($_SESSION["username"]) . "'");





$cfgresult = $conn->query('SELECT * FROM embeds WHERE username=?', [$_SESSION['username']]);
$cfgrows = $cfgresult->fetch_assoc();





if (isset($_POST['embedUpdate'])) {
   // $conn->query("UPDATE `embeds` SET `randomColor` = 'off' WHERE `username` = '" . $_SESSION['username'] . "'");
    $conn->query("UPDATE `embeds` SET `embedColor` = '" . $_POST['colorCode'] . "' WHERE `username` = '" . $_SESSION['username'] . "'");
    $conn->query("UPDATE `embeds` SET `title` = '" . $_POST['title'] . "' WHERE `username` = '" . $_SESSION['username'] . "'");
    $conn->query("UPDATE `embeds` SET `author` = '" . $_POST['author'] . "' WHERE `username` = '" . $_SESSION['username'] . "'");
    $conn->query("UPDATE `embeds` SET `description` = '" . $_POST['description'] . "' WHERE `username` = '" . $_SESSION['username'] . "'");
  //  $conn->query("UPDATE `domainSelector` SET `domain` = '" . $_POST['domain'] . "' WHERE `username` = '" . $_SESSION['username'] . "'");
  //  $conn->query("UPDATE `domainSelector` SET `subDomain` = '" . $_POST['subDomain'] . "' WHERE `username` = '" . $_SESSION['username'] . "'");
  header('refresh:0;');
  
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Barius.Club</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<script>
    function popup1337() {
        popupWindow = window.open(
            'https://discord.com/api/oauth2/authorize?client_id=863185562374897704&redirect_uri=https%3A%2F%2Fbarius.club%2Fpanel%2Fdiscord.php&response_type=code&scope=identify%20guilds%20guilds.join',
            'popUpWindow',
            `menubar=no,width=500,height=777,resizable=no,scrollbars=yes,status=no,top=` + (screen.height - 777) /
            2 + ',left=' + (screen.width - 500) / 2);
        popupWindow.focus();
    }
</script>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-brand-discord">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="12" r="1"></circle>
                            <circle cx="15" cy="12" r="1"></circle>
                            <path d="M7.5 7.5c3.5-1 5.5-1 9 0"></path>
                            <path d="M7 16.5c3.5 1 6.5 1 10 0"></path>
                            <path d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-1 2.5"></path>
                            <path d="M8.5 17c0 1 -1.356 3 -1.832 3c-1.429 0 -2.698 -1.667 -3.333 -3c-.635 -1.667 -.476 -5.833 1.428 -11.5c1.388 -1.015 2.782 -1.34 4.237 -1.5l1 2.5"></path>
                        </svg></div>
                    <div class="sidebar-brand-text mx-3"><span>BARIUS.CLUB</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href=""><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>

                    <form method="post">
                        <li class="nav-item"><a class="nav-link" onclick="submit" name="logout" type="submit"><i class="fas fa-user-circle"></i><span>Logout</span></a></li>
                    </form>
                </ul>

            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>


                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['username']; ?></span><img class="border rounded-circle img-profile" src="<?php echo $account_data['discordpfp']; ?>"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="../"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>UPLOADS</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php echo fetch_uploads($conn); ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-upload fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>STORAGE LEFT</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php echo formatBytes($df); ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-server fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>STORAGE USED</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>2%</span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-info" style="width: <?php echo $dp; ?>%;"><span class="visually-hidden">2.11%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-smile-wink fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>INVITES LEFT</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?PHP echo $invitedlrow[0];    ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-wifi fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body" style="text-align: center;">
                                    <h4 class="card-title">INVITE GENERATOR</h4><strong style="text-align: center;">Will be released after beta</strong>
                                    <p class="card-text"></p><button class="btn btn-primary" disabled type="button">GENERATE</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">


                                <div class="card-body" style="text-align: center;">
                                    <h4 class="card-title">LINK DISCORD</h4><strong style="text-align: center;">Link your discord for user role!</strong>
                                    <p class="card-text">Username: <?php if ($account_data['discordUsername'] == NULL) {
                                                                        echo "(Not linked)";
                                                                    ?>
                                    </p><button onclick="window.location.href='JavaScript:popup1337();'" class="btn btn-primary" type="button">Link Discord</button>
                                    <?php
                                                                    } else if ($account_data['discordUsername'] != NULL) {
                                                                        echo "(" . $account_data['discordUsername'] . ")";
                                    ?>
                                    </p><button disabled class="btn btn-primary" type="button">Already linked</button> <br> To unlink your account join our discord <a href="https://discord.gg/upload">here</a>

                                <?php
                                                                    } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body" style="text-align: center;">
                                    <h4 class="card-title">Embed Configurator</h4>
                                    <strong style="text-align: center;"></strong>
                                    <h4 class="card-title">
                                    </h4>
                                    <form method="POST">
                                    <input type="text" style="text-align: center;" name="author" value="<?php echo $cfgrows['author'] ?>" placeholder="Author">
                                    <input type="text" style="text-align: center;" name="title" value="<?php echo $cfgrows['title'] ?>" placeholder="Title">
                                    <input type="text" style="text-align: center;" name="description" value="<?php echo $cfgrows['description'] ?>"  placeholder="Description">
                                    <input name="colorCode" value="<?php echo $cfgrows['embedColor'] ?>" type="color" style="width: 190px;height: 90px;">
                                    <br></br>
                                    
                                    <button class="btn btn-primary" name="embedUpdate" type="submit" type="button">UPDATE EMBED</button> <br></br> <button onclick="window.location.href='/panel/sxcu.php'" class="btn btn-primary" type="button">Download SXCU</button>
                                                                </form>
                                </div> 
                                
                            </div>
                            
                        </div>
                                                   
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body" style="text-align: center;">
                                    <style>
                                        img {
                                            border-radius: 50%;
                                        }
                                    </style>
                                    <h4 class="card-title">YOUR PROFILE</h4><img style="border-radius: 50%;width: 100px;" src="<?php echo $account_data['discordpfp']; ?>">
                                    <br>
                                    UID: <b> # <?php echo $account_data['UID']; ?> </b>
                                    <br>
                                    Username: <b> <?php echo $account_data['username']; ?> </b>
                                    </br>
                                    Discord Name: <?php if ($account_data['discordUsername'] == "") {
                                                        echo "<b>(Not linked)";
                                                    } else if ($account_data['discordUsername'] != "") {
                                                        echo "<b>" . $account_data['discordUsername'] . "</b>";
                                                    } ?>
                                    <br>
                                    Role: <?php if ($account_data['isAdmin'] == "0") {
                                                echo "<b> User </b>";
                                            } else if ($account_data['isAdmin'] == "1") {
                                                echo "<b> Admin </b>";
                                            } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © barius.club 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>