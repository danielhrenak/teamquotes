<?php
/**
 * @var $this View
 * @var $article Article
 */

$title = 'Milujem Pixel';

$this->assign('title', $title);
?>

<h1><?= h($title) ?></h1>

<?php
$sounds = [
//    ['id' => 'drz_hubu', 'label' => 'Drž hubu', 'src' => 'audio/drz_hubu.mp3'],
    ['id' => 'wa_wa_wa', 'label' => 'Wa Wa Wa', 'src' => 'audio/wa_wa_wa.mp3'],
    ['id' => "co_si_spravil", 'label' => 'Čo si spravil?', 'src' => 'audio/co_si_spravil.mp3'],
    ['id' => 'leeroy_jenkins', 'label' => 'Leeroy Jenkins', 'src' => 'audio/leeroy_jenkins.mp3'],
];

foreach ($sounds as $sound): ?>
    <button id="playButton<?= $sound['id'] ?>" style="position: relative; width: 150px; height: 40px; overflow: hidden;">
        <?= h($sound['label']) ?>
        <div id="progressBar<?= $sound['id'] ?>" style="position: absolute; top: 0; left: 0; height: 100%; width: 0%; background-color: rgba(76, 175, 80, 0.5); z-index: 1;"></div>
    </button>
    <audio id="audioPlayer<?= $sound['id'] ?>" src="<?= h($sound['src']) ?>" preload="auto" style="display:none;"></audio>
    <a href="?play=<?= $sound['id'] ?>">🔗</a>
<br>
<?php endforeach; ?>

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

    // Setup controls for all buttons

    <?php foreach ($sounds as $sound) { ?>
        setupAudioControls("playButton<?= $sound['id'] ?>", "audioPlayer<?= $sound['id'] ?>", "progressBar<?= $sound['id'] ?>");
    <?php } ?>

    // Automatically play audio based on query parameter
    const urlParams = new URLSearchParams(window.location.search);
    const playParam = urlParams.get('play');
    if (playParam) {
        const playButton = document.getElementById(`playButton${playParam}`);
        if (playButton) {
            playButton.click();
        }
    }
</script>
