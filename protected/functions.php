<?php
function sqlthing($string)
{
    $string = stripslashes($string);
    $string = htmlentities($string);
    $string = strip_tags($string);
    return $string;
}

    function GetDirectorySize($path)
    {
        $bytestotal = 0;
        $path = realpath($path);
        if ($path!==false && $path!='' && file_exists($path)) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }

    function format_size($size)
    {
        $mod = 1024;
        $units = explode(' ', 'B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }
    
        return round($size, 2) . ' ' . $units[$i];
    }

function checksession($conn, $username)
{
    $account_query = $conn->query('SELECT * FROM users WHERE username=?', [$username]);
    $account_data = $account_query->fetch_assoc();

    if ($account_query->num_rows == 0) {
        header("Location: /");
        session_unset();
        session_destroy();
        exit();
    } else if ($account_query->num_rows != 0) {
    }
}

function genstring($length)
{
    $generatedstring = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 1, $length); // lol simple gen pornographic content
    return $generatedstring;
}

function getip()
{
    if (isset($_SERVER['HTTP_X_REAL_IP'])) { // ip grabber ahaha!!!!!!>\?\>>>>\!?!>?
        return $_SERVER['HTTP_X_REAL_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return 'unknown';
    }
}

?>