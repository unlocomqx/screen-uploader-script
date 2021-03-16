<?php

require_once 'config.php';

$uniqid = getUniqueId(5);
$filename = $uniqid . '.jpg';
$filepath = './uploads/' . $filename;

$file = $_POST['file'];

$base64_data = explode(',', $file);
file_put_contents($filepath, base64_decode($base64_data[1]));

$info = getimagesize($filepath);
$type = $info['mime'];
if (!in_array($type, array('image/jpeg', 'image/png'))) {
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
