<?php ob_start(); ?>
<div class="single-course">
    <h1><?= $course['title'] ?></h1>
    <img src="<?= $course['image'] ?>" alt="<?= $course['title'] ?>">
    <p><?= $course['description'] ?></p>
    <a href="/" class="btn">Voltar</a>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
