const firstBannerFolder = 'banner_rotate/';  // Folder containing the images
let firstBannerImages = [];

// Fetch image filenames from the server
fetch('includes/banner_rotate.php')
    .then(response => response.json())
    .then(images => {
        firstBannerImages = images;

        // Start the banner rotation only after fetching the images
        changeBanners();
        setInterval(changeBanners, 120000); // Update banners every 2 minutes (120,000 ms)
    })
    .catch(error => console.error('Error fetching images:', error));

// Function to change the banners dynamically
function changeBanners() {
    if (firstBannerImages.length === 0) return;  // No images available

    // Randomly select an image from the list
    const firstBanner = firstBannerImages[Math.floor(Math.random() * firstBannerImages.length)];

    // Update the `src` and `alt` of the image inside the `.first-banner` div
    const firstBannerImageElement = document.querySelector('.first-banner img');
    if (firstBannerImageElement) {
        firstBannerImageElement.src = firstBannerFolder + firstBanner;
        firstBannerImageElement.alt = firstBanner;  // Dynamically set the alt text to the image file name
    }
}
