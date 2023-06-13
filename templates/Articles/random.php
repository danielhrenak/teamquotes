<?php
/**
 * @var $this View
 * @var $article Article
 */

use App\Model\Entity\Article;
use Cake\View\View;
?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-10">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <figure class="text-center mb-0">
                            <blockquote class="blockquote">
                                <p class="pb-3">
                                    <span style="font-size: 70px;">
                                        <?= h($article->body) ?>
                                    </span>
                                </p>
                            </blockquote>
                            <figcaption class="blockquote-footer mb-0">
                               <?= h($article->title) ?>
                            </figcaption>
                        </figure>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
