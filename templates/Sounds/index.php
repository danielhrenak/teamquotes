<?php
/**
 * @var $this View
 * @var $article Article
 */

$title = 'Milujem Pixel';

$this->assign('title', $title);
?>


<h1><?= h($title) ?></h1>

<!-- First Button -->
<button id="playButton1" style="position: relative; width: 150px; height: 40px; overflow: hidden;">
    Drž hubu
    <div id="progressBar1" style="position: absolute; top: 0; left: 0; height: 100%; width: 0%; background-color: rgba(76, 175, 80, 0.5); z-index: 1;"></div>
</button>
<audio id="audioPlayer1" src="audio/drz_hubu_ty_buzerant.mp3" preload="auto" style="display:none;"></audio>

<!-- Second Button -->
<button id="playButton2" style="position: relative; width: 150px; height: 40px; overflow: hidden;">
    Wa Wa Wa
    <div id="progressBar2" style="position: absolute; top: 0; left: 0; height: 100%; width: 0%; background-color: rgba(76, 175, 80, 0.5); z-index: 1;"></div>
</button>
<audio id="audioPlayer2" src="audio/wa_wa_wa.mp3" preload="auto" style="display:none;"></audio>

<script>
    function setupAudioControls(playButtonId, audioPlayerId, progressBarId) {
        const playButton = document.getElementById(playButtonId);
        const audio = document.getElementById(audioPlayerId);
        const progressBar = document.getElementById(progressBarId);

        let isPlaying = false;

        playButton.addEventListener('click', function () {
            if (isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
            isPlaying = !isPlaying;
        });

        audio.addEventListener('timeupdate', function () {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = progress + '%';
        });

        audio.addEventListener('ended', function () {
            isPlaying = false;
            progressBar.style.width = '0%';
        });
    }

    // Setup controls for both buttons
    setupAudioControls('playButton1', 'audioPlayer1', 'progressBar1');
    setupAudioControls('playButton2', 'audioPlayer2', 'progressBar2');
</script>
