//JS 
function like(publicationId,userId){
    
    fetch(`http://localhost/medHachami_AVITO/publications/likePublication/${publicationId}/${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        // You can include additional options here (e.g., body for data).
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'liked') {
            // Update the DOM element (heart image) based on success
            console.log(data.message);
            // return 1
            // You can replace the console.log with code to update the DOM element.
            location.reload();
        } else if (data.status === 'disliked') {
            // Handle the case where the user has already liked the publication
            location.reload();
            console.log(data.message);
        } else {
            // Handle errors
            console.error(data.message);
        }
    })
    .finally(() => {
        // Reload the page once the fetch operation is complete (regardless of success or failure)
        location.reload();
    });
    
}

function displayOption(clickedElement) {
    var listOptions = clickedElement.closest('.pub-header').querySelector(".editList");
    
    if (listOptions.style.display === "none") {
        listOptions.style.display = "block";
    } else {
        listOptions.style.display = "none";
    }
}


