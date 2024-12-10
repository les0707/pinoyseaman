<?php
// Define the folder paths
$firstBannerFolder = 'banner_rotate/';
$secondBannerFolder = 'ads/';

// Get the list of images in each folder
$firstBannerImages = glob($firstBannerFolder . '*.jpg');
$secondBannerImages = glob($secondBannerFolder . '*.jpg');

// Randomly select one image from each folder
$firstBanner = $firstBannerImages[array_rand($firstBannerImages)];
$secondBanner = $secondBannerImages[array_rand($secondBannerImages)];
