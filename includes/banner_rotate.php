<?php
//THIS CODE IS TO FETCH ALL THE IMAGE IN THE FOLDER BANNER_ROTATE FOR JS RANDOM_BANNER_DISPLAY 
$folder = 'banner_rotate/';
$images = array_diff(scandir($folder), array('.', '..')); // Exclude '.' and '..'
$images = array_values(array_filter($images, function ($file) use ($folder) {
    return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file); // Filter image files
}));
echo json_encode($images);
