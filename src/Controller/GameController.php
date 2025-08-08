<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
class GameController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->enableAutoLayout(false);
    }
}
