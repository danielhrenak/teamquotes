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
    Show only quotes that are published: <a href="<?= $this->Url->build(['action' => 'index', '?' => ['published' => 1]]) ?>">Yes</a> | <a href="<?= $this->Url->build(['action' => 'index']) ?>">No</a>
</div>

<table>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <?php if ($article->isPublished()) { ?>
                    <span class="message success">Published</span>

                    Hide after
                    <span class="message info">
                    <?= $article->published_until->diffForHumans(FrozenTime::now(), true); ?>
                    </span>
                    <br>
                    <?= $this->Html->link('Hide now', ['action' => 'hide', $article->id]) ?>
                <?php } else { ?>
                    <span class="message error">Hidden</span>

                    Show for
                    <a href="<?= $this->Url->build(['action' => 'addDays', $article->id, 7]) ?>" class="message info">7 days</a>
                <?php } ?>
            </td>
            <td>
                <?php if ($article->image) { ?>
                    <?= $this->Html->image('upload/' . $article->image, ['alt' => $article->title, 'width' => 100]) ?>
                <?php } ?>
            </td>
            <td>
                <?= $this->Html->link($article->body, ['action' => 'view', $article->slug]) ?>
                <br/>
                <?= h($article->title) ?>
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
