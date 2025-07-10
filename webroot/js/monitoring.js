// Refresh the page every hour (3600000 milliseconds)
setTimeout(() => {
    location.reload();
}, 3600000);

if (typeof comments !== 'undefined' && comments.length > 0) {
    const jokeInterval = 30000;

    function displayRandomJoke() {
        const jokePopup = document.getElementById('jokePopup');
        jokePopup.innerHTML = ''; // Clear previous content

        // Calculate total priority
        const totalPriority = comments.reduce((sum, joke) => sum + joke.priority, 0);

        // Generate a random number between 0 and totalPriority
        let randomValue = Math.random() * totalPriority;

        // Select a joke based on priority
        let selectedJoke = null;
        for (const joke of comments) {
            randomValue -= joke.priority;
            if (randomValue <= 0) {
                selectedJoke = joke;
                break;
            }
        }

        if (selectedJoke.category === 'empty') {
            jokePopup.style.display = 'none'; // Hide jokePopup for "empty" category
            return;
        }

        jokePopup.style.display = 'block'; // Ensure jokePopup is visible for other categories

        if (selectedJoke.category === 'text') {
            jokePopup.textContent = selectedJoke.content;
            jokePopup.style.padding = '35px'; // Default padding
        } else if (selectedJoke.category === 'image') {
            const img = document.createElement('img');
            img.src = selectedJoke.content;
            img.style.maxWidth = '100%';
            img.style.borderRadius = '8px';
            jokePopup.appendChild(img);
            jokePopup.style.padding = '10px'; // Default padding
        } else if (selectedJoke.category === 'youtube') {
            const iframe = document.createElement('iframe');
            iframe.src = `https://www.youtube.com/embed/${selectedJoke.content}?autoplay=1`;
            iframe.width = '560';
            iframe.height = '200'; // Adjusted height
            iframe.frameBorder = '0';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            jokePopup.appendChild(iframe);
            jokePopup.style.padding = '0'; // Remove padding for YouTube videos
        }

        // Add smaller progress bar under the joke content
        const progressBar = document.createElement('div');
        progressBar.id = 'jokeProgressBar';
        progressBar.style.width = '100%';
        progressBar.style.height = '3px'; // Reduced height
        progressBar.style.backgroundColor = '#4caf50'; // light blue
        progressBar.style.transition = `width ${jokeInterval}ms linear`;
        jokePopup.appendChild(progressBar); // Append after joke content

        resetJokeProgressBar();
    }

    function resetJokeProgressBar() {
        const progressBar = document.getElementById('jokeProgressBar');
        let remainingTime = jokeInterval / 1000; // Convert to seconds

        progressBar.style.transition = 'none'; // Disable transition
        progressBar.style.width = '100%'; // Reset to full width instantly
        setTimeout(() => {
            progressBar.style.transition = `width ${jokeInterval}ms linear`; // Reapply transition
            progressBar.style.width = '0%'; // Shrink over the duration
        }, 50); // Add a short delay to ensure the reset is visible
    }

    // Display the first joke immediately
    displayRandomJoke();

    // Update the joke every 5 minutes
    setInterval(displayRandomJoke, jokeInterval);
}

if (typeof urls !== 'undefined' && urls.length > 0) {
    let currentIndex = 0;

    function cyclePages() {
        const iframe = document.getElementById('monitorFrame');
        const currentUrl = urls[currentIndex];
        const duration = currentUrl.duration * 1000;
        iframe.src = currentUrl.url;

        resetProgressBar(duration);

        currentIndex = (currentIndex + 1) % urls.length;
        setTimeout(cyclePages, duration);
    }

    function resetProgressBar(duration) {
        const progress = document.getElementById('progress');
        progress.style.transition = 'none'; // Disable transition
        progress.style.width = '100%'; // Reset to full width instantly
        setTimeout(() => {
            progress.style.transition = `width ${duration}ms linear`; // Reapply transition
            progress.style.width = '0%'; // Shrink over the duration
        }, 50); // Add a short delay to ensure the reset is visible
    }

    // Start cycling through pages
    cyclePages();
}
