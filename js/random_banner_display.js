// List of banners
const firstBannerFolder = 'banner_rotate';
const secondBannerFolder = 'ads';

// Array of image files (for demo purposes, you can dynamically generate this list from your server)
const firstBannerImages = ['marsa.jpg', 'example1.jpg', 'example2.jpg']; // Replace with actual file names
const secondBannerImages = ['yourads2.jpg', 'yourads3.jpg', 'yourads4.jpg']; // Replace with actual file names

function changeBanners() {
    // Randomly select a banner for each container
    const firstBanner = firstBannerImages[Math.floor(Math.random() * firstBannerImages.length)];
    const secondBanner = secondBannerImages[Math.floor(Math.random() * secondBannerImages.length)];

    // Change the images dynamically
    document.getElementById('first-banner').src = firstBannerFolder + firstBanner;
    document.getElementById('second-banner').src = secondBannerFolder + secondBanner;
}

// Change banners every 5 minutes (300000 milliseconds)
setInterval(changeBanners, 300000); // 5 minutes in milliseconds