<?php

namespace App\Controller;

use Cake\Http\ServerRequest;

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
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }

    public function view($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function random()
    {
        $this->viewBuilder()->setLayout('bootstrap');
        $article = $this->Articles->find()->where(['published' => 1])->order('rand()')->limit(1)->first();
        $this->set(compact('article'));
    }

    public function getImageFromRequest(ServerRequest $request): string {
        $file = $request->getData('image');
        $file->moveTo(WWW_ROOT . self::IMAGE_FOLDER . $file->getClientFilename());
        return $file->getClientFilename();
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article->image = $this->getImageFromRequest($this->request);
            $article->body = $this->request->getData('body');
            $article->title = $this->request->getData('title');
            $article->published = $this->request->getData('published');

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
}
