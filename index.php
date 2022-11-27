<?php

require_once 'config.php';

$uniqid = getUniqueId(5);
$filename = $uniqid . '.jpg';
$filepath = './uploads/' . $filename;

$request = $_POST;

$upload = $_FILES['file'] ?? null;

if ((int) $upload['error'] || !(int) $upload['size']) {
    exit('Error: invalid file');
}

if ($upload['type'] !== 'image/jpg') {
    exit('Error: invalid file type');
}

if (!move_uploaded_file($upload['tmp_name'], $filepath)) {
    exit('Error: failed to save file');
}

$info = getimagesize($filepath);
$type = $info['mime'];

if (!in_array($type, array('image/jpeg', 'image/png'))) {
    unlink($filepath);
    exit('Error: invalid file type');
}

exit($config['base_url'] . 'sc' . $uniqid);

function getUniqueId($length)
{
    $random = '';
    $add_number = true;
    for ($i = 0; $i < $length; $i++) {
        if ($add_number) {
            $random .= rand(0, 9);
        } else {
            $random .= chr(rand(ord('a'), ord('z')));
        }
        $add_number = !$add_number;
    }
    return $random;
}
