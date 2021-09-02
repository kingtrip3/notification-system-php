<?php

function redirect($location) {
  return header("Location: {$location}");
}

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function logger($module, $action) {
    $user = $_SESSION['username'];
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];

    $file = '../../files/log/log.txt';

    if (!file_exists($file)) {
        touch($file);
        $handle = fopen($file, 'a');
    } else {
        $handle = fopen($file, 'a');
    }

    $text = $user . ", " . $module . ", " . $action . ", " . $date . ", " . $ip . PHP_EOL;

    file_put_contents($file, $text, FILE_APPEND);
    fclose($handle);
}

function imageResize($imageResource, $width, $height) {
    $targetWidth = 200;
    $targetHeight = 200;

    $target = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled($target, $imageResource, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

    return $target;
}

?>
