<?php

session_start();

require __DIR__ . '/UploadProgress.php';

$uploadProgress = new Speednet\UploadProgress();

header('Content-type: text/json');
echo json_encode([
    'progress' => $uploadProgress->progress('speednet')
]);