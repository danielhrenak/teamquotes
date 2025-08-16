<?php
/**
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 */
$this->assign('title', 'Krok 2 z 3 – Pridaj fotku');
$this->setLayout('cardform'); // použije layout/cardform.php
?>

<div class="form-card">
    <div class="step-info">Krok 2 z 3: Pridaj svoju fotku</div>
    <?= $this->element('card_steps', ['employeeCard' => $employeeCard, 'currentStep' => 'photo']) ?>

    <div class="ai-prompt-box">
        <div class="ai-prompt-title">Ako upraviť fotku pomocou AI?</div>
        <div>
            <strong>Postup:</strong><br>
            1. <b>Nájdi svoju fotku</b>, kde je dobre vidieť tvoju tvár.<br>
            2. Skopíruj tento prompt (alebo si vymysli vlastný) a vlož ho do AI generátora obrázkov (napr. Pixel AI Portal, Microsoft Designer, Bing Copilot, Canva, Playground atď.):<br>
            <br>
            <textarea style="width:100%;height:60px;font-size:0.97em;padding:4px;" readonly>
Remove the background, center the face, add a soft white background, keep a natural look, square format, no watermark.
            </textarea>
            <br>
            3. <b>Stiahni upravenú fotku</b> a nahraj ju na Google Disk, Imgur alebo iné úložisko.<br>
            4. <b>Skopíruj URL adresu obrázka</b> a vlož ju do poľa nižšie.<br>
        </div>
    </div>

    <?= $this->Form->create($employeeCard, ['type' => 'post']) ?>

    <label for="photo_url">URL tvojej upravenej fotky</label>
    <?= $this->Form->control('photo_url', [
        'type' => 'url',
        'label' => false,
        'required' => true,
        'placeholder' => 'https://...',
        'id' => 'photo_url_input'
    ]) ?>

    <div class="photo-preview" id="photoPreviewBox" style="display:none;">
        <div>Náhľad tvojej fotky:</div>
        <img src="" alt="Náhľad fotky" id="previewImg">
    </div>

    <?= $this->Form->button('Uložiť a pokračovať', ['class' => 'btn']) ?>

    <?= $this->Form->end() ?>

    <?= $this->element('card_backlink', ['employeeCard' => $employeeCard]) ?>
</div>

<script>
    const input = document.getElementById('photo_url_input');
    const previewBox = document.getElementById('photoPreviewBox');
    const previewImg = document.getElementById('previewImg');
    function updatePreview() {
        const url = input.value.trim();
        if (url.match(/^https?:\/\/.+\.(jpg|jpeg|png|webp|gif)$/i)) {
            previewImg.src = url;
            previewBox.style.display = 'block';
        } else {
            previewBox.style.display = 'none';
            previewImg.src = '';
        }
    }
    input && input.addEventListener('input', updatePreview);
    window.addEventListener('DOMContentLoaded', updatePreview);
</script>
