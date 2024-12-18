document.getElementById('register_seaman').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const loader = document.getElementById('loader');
    loader.style.display = 'block'; // Show the loader

    const formData = new FormData(this);

    fetch('../includes/add_seaman_now.inc.php', { // Replace with the PHP file path
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        loader.style.display = 'none'; // Hide the loader

        if (data.success) {
            alert(data.message); // Success message
        } else {
            alert("Error: " + data.message); // Error message
        }
    })
    .catch(error => {
        loader.style.display = 'none'; // Hide the loader
        console.error('Error:', error);
        alert("Something went wrong. Please try again.");
    });
});