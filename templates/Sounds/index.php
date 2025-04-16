
<h1>Play MP3 Example</h1>
<button id="playButton">Drž hubu ty buzerant</button>
<audio id="audioPlayer" src=audio/drz_hubu_ty_buzerant.mp3 preload="auto" style="display:none;"></audio>

<script>
    document.getElementById('playButton').addEventListener('click', function () {
        const audio = document.getElementById('audioPlayer');
        audio.play();
    });
</script>
