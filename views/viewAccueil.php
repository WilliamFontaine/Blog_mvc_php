<body>
<?php $this->_t = "MyBlog";
if (empty($articles[0])): ?>
<div class="container">
    <div class="alert alert-danger mt-5" role="alert">
        Aucun article trouvé.
    </div>
    <?php endif; ?>
    <h1 class="text-center">Articles</h1>
    <?php foreach ($articles

    as $article): ?>
    <div class="container mt-5">
        <a href="?url=article&id=<?= $article->getId() ?>"><h2><?= $article->getTitre() ?> </h2></a>
        <p>Ecrit par '<?= $article->getPseudoAuteur() ?>' le
            <time> <?= $article->getDate() ?>.</time>
        </p>
        <hr>
    </div>
</div>
<?php endforeach; ?>
</body>
