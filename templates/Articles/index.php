<?php
/**
 * @var $this \Cake\View\View
 * @var $articles \App\Model\Entity\Article[]
 */

use Cake\I18n\FrozenTime;

?>

<h1>Quotes</h1>
<a href="<?= $this->Url->build(['_name' => 'articles_add']) ?>" class="button">Add Quote</a>

<div>
    Show only quotes that are published: <a href="<?= $this->Url->build(['action' => 'index', '?' => ['published' => 1]]) ?>">Yes</a> | <a href="<?= $this->Url->build(['action' => 'index', '?' => ['published' => 0]]) ?>">No</a>
</div>

<table>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <?php if ($article->isPublished()) { ?>
                    <span style="color: green">✅&nbsp;Published

                    <br>
                    ⏰ <?= $article->published_until->diffForHumans(FrozenTime::now(), true); ?>
                <?php } else { ?>
                    <span style="color: red">⛔️&nbsp;Hidden</span>
                <?php } ?>
            </td>
            <td>
                <?php if ($article->image) { ?>
                    <?= $this->Html->image('upload/' . $article->image, ['alt' => $article->title, 'width' => 100]) ?>
                <?php } ?>
            </td>
            <td>
                "<?= h($article->body) ?>"
                <br/>
                <strong><?= h($article->title) ?></strong>
            </td>
            <td>
                <?= $this->Html->link('View', ['action' => 'view', $article->slug], ['class' => 'message info']) ?>
            </td>
            <td>
                ➡️&nbsp;<a href="<?= $this->Url->build(['action' => 'addDays', $article->id, 7]) ?>">7&nbsp;more&nbsp;days</a>

                <?php if ($article->isPublished()) { ?>
                    <br>
                ⛔️ <?= $this->Html->link("Hide", ['action' => 'hide', $article->id]) ?>
                <?php } ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <!-- Here is where we add the pages -->
    <tr>
        <td colspan="2">
            <?= $this->Paginator->prev('Previous page') ?>
        </td>
        <td colspan="2">
            <?= $this->Paginator->next('Next page') ?>
        </td>
    </tr>
</table>
