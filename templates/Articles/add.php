<?php
/**
 * @var $this \Cake\View\View
 */
?>

<h1>Add Quote</h1>
<?php
echo $this->Form->create($article);
// Hard code the user for now.
echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
echo $this->Form->control('body', ['rows' => '3']);
echo $this->Form->control('title', ['label' => 'Label']);
echo $this->Form->control('published', ['type' => 'checkbox', 'checked' => 'checked']);
echo $this->Form->button(__('Save Quote'));
echo $this->Form->end();
?>
