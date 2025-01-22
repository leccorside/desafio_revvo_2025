<?php ob_start(); ?>
<!-- Slideshow -->
<div class="slideshow">
    <div class="slides">
        <?php foreach ($latestCourses as $course): ?>
            <div class="slide">
                <img src="<?= $course['image'] ?>" alt="<?= $course['title'] ?>">
                <div class="overlay">
                    <h3><?= $course['title'] ?></h3>
                    <p><?= $course['description'] ?></p>
                    <button class="btn" onclick="window.location.href='/projetos/desafio_revvo2/curso/<?= $course['id'] ?>'">Ver Curso</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="prev"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="next"><i class="fa-solid fa-chevron-right"></i></button>
</div>

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
            <a href="#" id="addCourseBtn">
                <p><img src="public/images/folder.webp" alt="ADICIONAR CURSO"></p>
                <p>
                <span>ADICIONAR</span><br>
                <span>CURSO</span>
                </p>
            </a>
        </div>
    </div>
</div>

<div id="addCourseModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Adicionar Novo Curso</h2>
        <form id="addCourseForm" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value=""> <!-- ID será gerado no servidor -->

            <label for="title">Título:</label><br>
            <input type="text" id="title" name="title" class="inputmodal1" value="" required><br><br>

            <label for="description">Descrição:</label><br>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="image">Imagem:</label><br>
            <img id="previewImage" src="public/images/default.webp" alt="Pré-visualização"><br>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <button type="submit">Salvar</button>
        </form>
    </div>
</div>


<!-- Modal -->
<div id="welcomeModal" class="modal">
    
    <div class="modal-content2">
        <i class="fa-solid fa-xmark close2" id="closeModal"></i>
        <img src="public/images/bg-modal.webp">
        <div class="content-modal-well">
            <h2>EGESTAS TORTOR VULPUTATE</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
            <button>INSCREVER-SE</button>
        </div>
    </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
