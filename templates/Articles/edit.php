<h1>Edit Quote</h1>
<?php
echo $this->Form->create($article);
echo $this->Form->control('user_id', ['type' => 'hidden']);
echo $this->Form->control('body', ['rows' => '3']);
echo $this->Form->control('title', ['label' => 'Label']);
echo $this->Form->control('published', ['type' => 'checkbox']);
echo $this->Form->button(__('Save Quote'));
echo $this->Form->end();
?>
