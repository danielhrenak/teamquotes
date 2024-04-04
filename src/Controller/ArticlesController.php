<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Table\ArticlesTable;
use Cake\Http\ServerRequest;
use Cake\I18n\FrozenTime;
use Laminas\Diactoros\UploadedFile;

/**
 * @property ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    private const IMAGE_FOLDER = 'img' . DS . 'upload' . DS;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $articlesQuery = $this->Articles->find();
        if (!$this->request->getQuery('published')) {

        } else {
            $articlesQuery->where(['published_until >' => FrozenTime::now()]);
        }
        $articles = $this->Paginator->paginate($articlesQuery);
        $this->set(compact('articles'));
    }

    public function view($slug)
    {
        $this->viewBuilder()->setLayout('bootstrap');
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function random()
    {
        $this->viewBuilder()->setLayout('bootstrap');
        $article = $this->Articles->find()->where(['published_until >' => FrozenTime::now()])->order('rand()')->limit(1)->first();
        $this->set(compact('article'));
    }

    public function getImageFromRequest(ServerRequest $request): string {
        /** @var UploadedFile $file */
        $file = $request->getData('image');
        if ($file->getError() !== UPLOAD_ERR_OK) {
            return '';
        }

        $imageName = rand(0, 100) . "_" . $file->getClientFilename();
        $file->moveTo(WWW_ROOT . self::IMAGE_FOLDER . $imageName);
        return $imageName;
    }

    public function add()
    {
        /** @var Article $article */
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $publishedUntil = FrozenTime::now()->addDays($this->request->getData('published_until'));
            $article->image = $this->getImageFromRequest($this->request);
            $article->body = $this->request->getData('body');
            $article->title = $this->request->getData('title');
            $article->published_until = $publishedUntil;

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $article->user_id = 1;

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your quote has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your quote.'));
        }
        $this->set('article', $article);
    }

    public function edit($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your quote has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your quote.'));
        }

        $this->set('article', $article);
    }

    public function hide($articleId)
    {
        /** @var Article $article */
        $article = $this->Articles->get($articleId);
        $article->hide();
        $this->Articles->save($article);
        $this->Flash->success(__('The quote has been hidden.'));
        return $this->redirect( $this->request->referer());
    }

    public function addDays($articleId, $days)
    {
        /** @var Article $article */
        $article = $this->Articles->get($articleId);
        $article->showFor($days);
        $this->Articles->save($article);
        $this->Flash->success(__('The quote has been shown for {0} days.', $days));
        return $this->redirect( $this->request->referer());
    }
}
