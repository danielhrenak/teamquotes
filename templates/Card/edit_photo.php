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
            1. <b>Nájdi svoju fotku</b>, kde je dobre vidieť tvoju tvár (napríklad v HR toole svoju fotku).<br>
            2. Skopíruj tento prompt (alebo si vymysli vlastný), <br> vlož ho do AI generátora obrázkov spolu so svojou fotkou <br>
            (napr. Pixel AI Portal, ChatGPT, Microsoft Designer, Bing Copilot, Canva, Playground atď.):<br>
            <br>
            <textarea style="width:100%;height:100px;font-size:0.97em;padding:4px;" readonly>
Add a realistic yellow miner’s helmet with a headlamp to the person in the photo. Place a miner’s pickaxe in one hand or over their shoulder. The style should be photorealistic, with natural shadows and lighting. The helmet should be bright yellow and blend naturally onto the person’s head. Add subtle miner details, such as a bit of dust or soot for authenticity. Ensure all additions look seamless with the original image.
            </textarea>
            <br>
            3. <b>Stiahni upravenú fotku</b> a nahraj ju na Google Disk,
            <a href="https://imgbb.com">imgbb</a>, <a href="https://freeimage.host">freeimage</a> alebo iné obľúbené úložisko.<br>
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
