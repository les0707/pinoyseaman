<?php
$folder = '../banner_rotate/'; // Adjust the path to your banner_rotate folder
if (is_dir($folder)) {
    $files = array_diff(scandir($folder), array('.', '..'));
    $images = array_values(array_filter($files, function ($file) use ($folder) {
        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']);
    }));
    echo json_encode($images);
} else {
    echo json_encode(['error' => 'Directory not found']);
}