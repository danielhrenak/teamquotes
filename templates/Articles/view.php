<h1><?= h($article->body) ?></h1>
<p><?= h($article->title) ?></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>
