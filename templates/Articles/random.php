<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <figure class="text-center mb-0">
                            <blockquote class="blockquote">
                                <p class="pb-3">
                                    <i class="fas fa-quote-left fa-xs text-primary"></i>
                                    <span class="fs-1">
                                        <?= h($article->body) ?>
                                    </span>
                                    <i class="fas fa-quote-right fa-xs text-primary"></i>
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
