<?php ob_start(); ?>

<div class="single-course2">
    <img src="../<?= $course['image'] ?>" alt="<?= $course['title'] ?>">

    <div class="conteudo-single">
        <div class="acoes">
            <a href="#" class="edit-course"><i class="fa-regular fa-pen-to-square"></i></a>
            <a href="#" class="delete-course" data-id="<?= $course['id'] ?>">
                <i class="fa-solid fa-trash-can"></i>
            </a>

        </div>
        <h1><?= $course['title'] ?></h1>
        <p><?= $course['description'] ?></p>
        <button class="btn" onclick="window.location.href='/projetos/desafio_revvo2'">Voltar a Home</button>
    </div>
</div>


<!-- Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Curso</h2><br>
        <form id="editCourseForm" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?= $course['id'] ?>">

            <label for="title">Título:</label><br>
            <input type="text" id="title" name="title" class="inputmodal1" value="<?= $course['title'] ?>"><br><br>

            <label for="description">Descrição:</label><br>
            <textarea id="description" name="description"><?= $course['description'] ?></textarea><br><br>

            <label for="image">Imagem:</label><br>
            <img src="../<?= $course['image'] ?>" id="imgedit" alt="<?= $course['title'] ?>"><br>
            <input type="file" id="image" name="image" value="<?= $course['image'] ?>"><br><br>

            <button type="submit">Salvar</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'layoutCurso.php'; ?>
