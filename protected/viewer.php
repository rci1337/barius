<?php
$start = microtime(true);

$result = $conn->query("SELECT * FROM `uploads` WHERE `uploadName` = '$file'");
$row = $result->fetch_assoc();
if ($result->num_rows < 1) {
    header("Location: /");
    exit();
}

$serverurl = "http://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $row['uploadedBy'] . "/" . $row['uploadName'] . "." . $row['mimeType'];



function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}

$end = microtime(true);

if (!strpos($_SERVER['HTTP_USER_AGENT'], 'DiscordBot') == false) {
?>

    <head>
        <meta name="twitter:card" content="summary_large_image">
        <?php if ($type == "mp4" || $type == "webm" || $type == "mov") { ?>
            <meta name='twitter:card' content='player'>
            <meta name="twitter:player:stream" content="<?php echo $serverurl ?>">
            <meta name="twitter:player" content="<?php echo $serverurl ?>">
            <meta name="twitter:player:stream:content_type" content="video/mp4">
        <?php } ?>
        <?php if ($type == "png" || $type == "jpeg" || $type == "jpg" || $type == "gif") { ?>
            <meta property="og:image" content="<?php echo $serverurl; ?>">
        <?php } ?>

        <meta property="og:site_name" content=" <?php
                                                $result2 = $conn->query("SELECT `author` FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
                                                $result3 = $conn->query("SELECT `uid` FROM `users` WHERE `username`='" . $row['uploadedBy'] . "'");
                                                $row2 = $result2->fetch_array();
                                                $row3 = $result3->fetch_array();

                                                $search = array("{username}", "{filename}", "{ext}", "{file}", "{size}", "{uid}", "{date}");
                                                $replacewith = array($row['uploadedBy'], $file . "." . $type, $type, $file, format_size(GetDirectorySize("/files/" . $row['uuid'] . "." . $row['mimeType'])), $row3[0], date("Y/m/d"));
                                                $outputtext = str_replace($search, $replacewith, $row2[0]);
                                                echo sqlthing($outputtext); ?>">

        <meta property="og:title" content="
            <?php
            $result2 = $conn->query("SELECT `title` FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
            $result3 = $conn->query("SELECT `uid` FROM `users` WHERE `username`='" . $row['uploadedBy'] . "'");
            $row2 = $result2->fetch_array();
            $row3 = $result3->fetch_array();

            $search = array("{username}", "{filename}", "{ext}", "{file}", "{size}", "{uid}", "{date}");
            $replacewith = array($row['uploadedBy'], $file . "." . $type, $type, $file, format_size(GetDirectorySize("/files/" . $row['uuid'] . "." . $row['mimeType'])), $row3[0], date("Y/m/d"));
            $outputtext = str_replace($search, $replacewith, $row2[0]);
            echo sqlthing($outputtext); ?>">

        <meta property="og:description" content="
            <?php
            $result2 = $conn->query("SELECT `description` FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
            $result3 = $conn->query("SELECT `uid` FROM `users` WHERE `username`='" . $row['uploadedBy'] . "'");
            $row2 = $result2->fetch_array();
            $row3 = $result3->fetch_array();

            $search = array("{username}", "{filename}", "{ext}", "{file}", "{size}", "{uid}", "{date}");
            $replacewith = array($row['uploadedBy'], $file . "." . $type, $type, $file, format_size(GetDirectorySize("/files/" . $row['uuid'] . "." . $row['mimeType'])), $row3[0], date("Y/m/d"));
            $outputtext = str_replace($search, $replacewith, $row2[0]);
            echo sqlthing($outputtext); ?>">

        <meta name="theme-color" content="
            <?php
            $result2 = $conn->query("SELECT * FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
            $row2 = $result2->fetch_array();

            if ($row2['random_color'] == "on") {
                echo "#" . random_color();
            } else {
                echo $row2['color'];
            } ?>">
    </head>

<?php
} else if (!strpos($_SERVER['HTTP_USER_AGENT'], 'DiscordBot') == true) {




?>

    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="twitter:card" content="summary_large_image">
        <?php if ($type == "mp4" || $type == "webm" || $type == "mov") { ?>
            <meta name='twitter:card' content='player'>
            <meta name="twitter:player:stream" content="<?php echo $serverurl ?>">
            <meta name="twitter:player" content="<?php echo $serverurl ?>">
            <meta name="twitter:player:stream:content_type" content="video/mp4">
        <?php } ?>
        <?php if ($type == "png" || $type == "jpeg" || $type == "jpg" || $type == "gif") { ?>
            <meta property="og:image" content="<?php echo $serverurl; ?>">
        <?php } ?>

        <meta property="og:site_name" content="<?php
                                                $result2 = $conn->query("SELECT `author` FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
                                                $result3 = $conn->query("SELECT `uid` FROM `users` WHERE `username`='" . $row['uploadedBy'] . "'");
                                                $row2 = $result2->fetch_array();
                                                $row3 = $result3->fetch_array();

                                                $search = array("{username}", "{filename}", "{ext}", "{file}", "{size}", "{uid}", "{date}");
                                                $replacewith = array($row['uploadedBy'], $file . "." . $type, $type, $file, format_size(GetDirectorySize("/uploads/" . $row['uploadedBy'] . "/" .  $row['uploadName'] . "." . $row['mimeType'])), $row3[0], date("Y/m/d"));
                                                $outputtext = str_replace($search, $replacewith, $row2[0]);
                                                echo sqlthing($outputtext);
                                                ?>">

        <meta property="og:title" content="<?php
                                            $result2 = $conn->query("SELECT `title` FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
                                            $result3 = $conn->query("SELECT `uid` FROM `users` WHERE `username`='" . $row['uploadedBy'] . "'");
                                            $row2 = $result2->fetch_array();
                                            $row3 = $result3->fetch_array();

                                            $search = array("{username}", "{filename}", "{ext}", "{file}", "{size}", "{uid}", "{date}");
                                            $replacewith = array($row['uploadedBy'], $file . "." . $type, $type, $file, format_size(GetDirectorySize("/uploads/" . $row['uploadedBy'] . "/" .  $row['uploadName'] . "." . $row['mimeType'])), $row3[0], date("Y/m/d"));
                                            $outputtext = str_replace($search, $replacewith, $row2[0]);
                                            echo sqlthing($outputtext);
                                            ?>">

        <meta property="og:description" content="<?php
                                                    $result2 = $conn->query("SELECT `description` FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
                                                    $result3 = $conn->query("SELECT `uid` FROM `users` WHERE `username`='" . $row['uploadedBy'] . "'");
                                                    $row2 = $result2->fetch_array();
                                                    $row3 = $result3->fetch_array();

                                                    $search = array("{username}", "{filename}", "{ext}", "{file}", "{size}", "{uid}", "{date}");
                                                    $replacewith = array($row['uploadedBy'], $file . "." . $type, $type, $file, format_size(GetDirectorySize("/uploads/" . $row['uploadedBy'] . "/" .  $row['uploadName'] . "." . $row['mimeType'])), $row3[0], date("Y/m/d"));
                                                    $outputtext = str_replace($search, $replacewith, $row2[0]);
                                                    echo sqlthing($outputtext);
                                                    ?>">

        <meta name="theme-color" content="<?php
                                            $result2 = $conn->query("SELECT * FROM `embeds` WHERE `username`='" . $row['uploadedBy'] . "'");
                                            $row2 = $result2->fetch_array();

                                                echo $row2['embedColor'];
                                            

                                            ?>">

        <title>barius.club <?php echo "" . $row['uploadName'] . "." . $row['mimeType']; ?></title>
        <style>
            @import "https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600&display=swap";

            html {
                height: 100%
            }

            html {
                height: 100%
            }

            body {
                height: 100%;
                background: rgba(14, 14, 16);
                font-family: work sans, sans-serif;
                color: rgba(247, 247, 247);
                font-size: 15px;
                text-align: center;
                display: flex;
                justify-content: safe center;
                align-items: safe center;
                width: 95%;
                max-width: 100%;
                margin: 0 auto
            }

            .image {
                max-width: 100vh;
                max-height: 150vh
            }

            p {
                position: fixed;
                left: 0;
                bottom: 0;
                height: 30px;
                width: 100%;
                font-size: 13px;
                font-weight: 700;
                text-shadow: 0 0 8px rgb(0 0 0);
            }
        </style>

    </head>

    <body>
        <a href="<?php echo $serverurl; ?>">
            <?php if ($type == "mp4" || $type == "webm" || $type == "mov") { ?>
                <video width="500px" controls>
                    <source src="<?php echo $serverurl; ?>" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
            <?php } ?>
            <?php if ($type == "png" || $type == "jpeg" || $type == "jpg" || $type == "gif") { ?>
                <img src="<?php echo $serverurl; ?>" class="image">
            <?php } ?>
        </a>
        <p>This page took <?php echo round($end - $start, 3) . " seconds" ?> to generate.</p>
    </body>

    </html>
<?php
}
?>