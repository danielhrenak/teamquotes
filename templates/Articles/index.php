<?php
/**
 * @var $this \Cake\View\View
 * @var $articles \App\Model\Entity\Article[]
 */
?>

<h1>Quotes</h1>
<a href="<?= $this->Url->build(['_name' => 'articles_add']) ?>" class="button">Add Quote</a>
<table>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <?php if ($article->published) { ?>
                    <span class="message success">Published</span>
                <?php } else { ?>
                    <span class="message error">Hidden</span>
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
            <td>
                <?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?>
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
