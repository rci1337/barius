<?php
require '../protected/connection.php';
require '../protected/functions.php';

error_reporting(0);

$conn = get_connection();

checksession($conn, $_SESSION['username']);

$result = $conn->query("SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
$rows = $result->fetch_array();

$fo = fopen("config - {$rows['username']}.sxcu", 'w') or die("can't open file");
$stringData = "{
    \"Version\": \"13.5.0\",
    \"DestinationType\": \"ImageUploader, FileUploader\",
    \"RequestMethod\": \"POST\",
    \"RequestURL\": \"https://barius.club/upload.php\",
    \"Body\": \"MultipartFormData\",
    \"Arguments\": {
      \"upload_key\": \"" . $rows['uploadKey'] . "\"
    },
    \"FileFormName\": \"file\",
    \"URL\": \"\$json:ImageUrl$\",
    \"ErrorMessage\": \"\$json:error$\"
}
";
fwrite($fo, $stringData);
fclose($fo);

file_put_contents("config - {$rows['username']}.sxcu",
preg_replace('~[\r\n]+~', "\r\n",trim(file_get_contents("config - {$rows['username']}.sxcu"))));

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename("config - {$rows['username']}.sxcu").'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize("config - {$rows['username']}.sxcu"));
readfile("config - {$rows['username']}.sxcu");
unlink("config - {$rows['username']}.sxcu");
ob_end_flush();
exit;
?>