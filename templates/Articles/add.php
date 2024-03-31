<?php
/**
 * @var $this View
 * @var $article Article
 */

use App\Model\Entity\Article;
use Cake\View\View;

?>

<h1>Add Quote</h1>
<?php
echo $this->Form->create($article, ['type' => 'file']);
// Hard code the user for now.
echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
echo $this->Form->control('body', ['label' => 'Text']);
echo $this->Form->control('title', ['label' => 'Author/Explanation']);
echo $this->Form->control('image', ['type' => 'file']);
echo $this->Form->control('published_until',
    [
        'type' => 'radio', 'options' => [
            '7' => '7 days',
            '14' => '14 days',
            '30' => '30 days',
            '90' => '90 days',
            '180' => '180 days',
            '365' => '365 days',
            '3650' => '3650 days',
        ], 'value' => 7
    ]);
echo $this->Form->button(__('Save Quote'));
echo $this->Form->end();
?>
