<?php ob_start(); ?>

<div class="conteudo">
    <!-- Lista de Cursos -->
    <h2 class="titulo-cursos">Meus Cursos</h2>

    <div class="courses">
        <?php foreach ($courses as $course): ?>
            <div class="course-card">
                <img src="<?= $course['image'] ?>" alt="<?= $course['title'] ?>">
                <div class="text-curso">  
                    <h3><?= $course['title'] ?></h3>

                    <p>
                        <?= implode(' ', array_slice(explode(' ', $course['description']), 0, 10)) . (str_word_count($course['description']) > 10 ? '...' : '') ?>
                    </p>

                    <button class="btn" onclick="window.location.href='/projetos/desafio_revvo2/curso/<?= $course['id'] ?>'">Ver Curso</button>

                </div>
            </div>
        <?php endforeach; ?>
        <div class="add-course">
            <a href="">
                <p><img src="public/images/folder.webp" alt="ADICIONAR CURSO"></p>
                <p>
                <span>ADICIONAR</span><br>
                <span>CURSO</span>
                </p>
            </a>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
