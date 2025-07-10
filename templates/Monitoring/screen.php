<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Cycle</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }

        #jokePopup {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: rgba(224, 224, 224, 0.8); /* Transparent background */
            border: 3px solid #000;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            font-family: Arial, sans-serif;
            font-size: 24px;
            max-width: 600px;
            z-index: 1000;
        }

        #timer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            font-family: Arial, sans-serif;
            font-size: 18px;
            z-index: 1000;
        }

        #progressBar {
            width: 200px;
            height: 10px;
            background-color: #ccc;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        #progress {
            height: 100%;
            background-color: #4caf50;
            width: 100%; /* Start fully filled */
            transition: width 1s linear;
        }
    </style>
</head>
<body>
    <iframe id="monitorFrame"></iframe>

    <?php if ($comment_section_enabled): ?>
        <div id="jokePopup"></div>
    <?php endif; ?>

    <div id="timer">
        <div id="progressBar">
            <div id="progress"></div>
        </div>
    </div>

    <script>
        // Refresh the page every hour (3600000 milliseconds)
        setTimeout(() => {
            location.reload();
        }, 3600000);

        <?php if ($comment_section_enabled): ?>
        const comments = <?= json_encode($comments); ?>;
        const jokeInterval = 30000; // 5 minutes

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
            progressBar.style.backgroundColor = '#cccccc'; // Grey
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
        <?php endif; ?>

        const urls = <?= json_encode($urls); ?>;

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
    </script>
</body>
</html>
