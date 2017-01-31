<?php

$base_url = 'http://sv.net/dev/screenshot/uploads/';

$file = $_FILES["file"];

if ((int)$file['error']) {
    exit('Error: an error occured');
}

$info = getimagesize($file['tmp_name']);
$type = $info['mime'];

if ($type != 'image/jpeg') {
    exit('Error: invalid file type');
}

$filename = uniqid() . '.jpeg';
if (move_uploaded_file($file['tmp_name'], './uploads/' . $filename)) {
    exit($base_url . $filename);
} else {
    exit('Error: an error occured while copying the upload file');
}
