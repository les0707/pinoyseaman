const firstBannerFolder = 'banner_rotate/';
let firstBannerImages = [];

// Fetch image filenames from the server
fetch('includes/banner_rotate.php')
    .then(response => response.json())
    .then(images => {
        firstBannerImages = images;

        // Start the banner rotation only after fetching the images
        changeBanners();
        setInterval(changeBanners, 180000); // Update banners every 3 minutes
    })
    .catch(error => console.error('Error fetching images:', error));

function changeBanners() {
    if (firstBannerImages.length === 0) return; // No images available
    const firstBanner = firstBannerImages[Math.floor(Math.random() * firstBannerImages.length)];
    document.querySelector('.first-banner img').src = firstBannerFolder + firstBanner;
}

