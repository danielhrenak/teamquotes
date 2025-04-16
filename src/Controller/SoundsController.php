<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Table\ArticlesTable;
use Cake\Http\ServerRequest;
use Cake\I18n\FrozenTime;
use Laminas\Diactoros\UploadedFile;

/**
 * @property SoundsController $Articles
 */
class SoundsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {

    }
}
