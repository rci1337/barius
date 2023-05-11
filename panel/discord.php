<?php
require '../protected/connection.php';
require '../protected/functions.php';

$conn = get_connection();

checksession($conn, $_SESSION['username']);


define('OAUTH2_CLIENT_ID', '863185562374897704');
define('OAUTH2_CLIENT_SECRET', 'bfa1ojwVGPoxvBVz9m97oo4HHLYxi1B7');

$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';

if (get('code')) {
    $token = apiRequest($tokenURL, array(
        "grant_type" => "authorization_code",
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
        'redirect_uri' => 'https://barius.club/panel/discord.php',
        'code' => get('code')
    ));
    $logout_token = $token->access_token;
    $_SESSION['access_token'] = $token->access_token;

    header('Location: ' . $_SERVER['PHP_SELF']);
}

if (session('access_token')) {
    $user = apiRequest($apiURLBase);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bot ODYzMTg1NTYyMzc0ODk3NzA0.YOjOMw.yTzHZV-JBH3Q95Jypc8Hp9biSRU'
    );

    $ch = curl_init("https://discord.com/api/guilds/863076360485076992/members/" . $user->id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("access_token" => session('access_token'))));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_exec($ch);
    curl_close($ch);

    $ch = curl_init("https://discord.com/api/guilds/863076360485076992/members/" . $user->id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("nick" => $_SESSION['username'])));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_exec($ch);
    curl_close($ch);

    $ch = curl_init("https://discord.com/api/guilds/863076360485076992/members/" . $user->id . "/roles/863093739001217084");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("access_token" => session('access_token'))));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_exec($ch);
    curl_close($ch);

    $conn->query("UPDATE `users` SET `discordUsername` = '$user->username#$user->discriminator' WHERE `users`.`username` = '" . $_SESSION['username'] . "'");
    $conn->query("UPDATE `users` SET `discordID` = '$user->id' WHERE `users`.`username` = '" . $_SESSION['username'] . "'");
    $conn->query("UPDATE `users` SET `discordpfp` = 'https://cdn.discordapp.com/avatars/$user->id/$user->avatar?size=2048' WHERE `users`.`username` = '" . $_SESSION['username'] . "'");

    echo '
    <script>
    var popup1337 = window.self;
    popup1337.opener.location.reload();
    popup1337.close();
    </script>';
} else {
    echo("Not logged into Discord!");
}


function apiRequest($url, $post = FALSE, $headers = array())
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($ch);


    if ($post)
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

    $headers[] = 'Accept: application/json';

    if (session('access_token'))
        $headers[] = 'Authorization: Bearer ' . session('access_token');

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    return json_decode($response);
}

function get($key, $default = NULL)
{
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default = NULL)
{
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
