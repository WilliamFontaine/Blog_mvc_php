<?php $this->_t = "MyBlog";
if(empty($articles[0])): ?>
<div class="container">
    <div class="alert alert-danger mt-5" role="alert">
        Aucun article trouvé.
    </div>
</div>
<?php endif; ?>
<?php foreach($articles as $article):?>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Articles</h1>
        <a href="?url=article&id=<?= $article->getId() ?>"><h2><?= $article->getTitre() ?> </h2></a>
        <p>Ecrit par '<?= $article->getPseudoAuteur() ?>' le
            <time> <?= $article->getDate() ?></time>.
        </p>
        <hr>
    </div>
<?php endforeach; ?>
