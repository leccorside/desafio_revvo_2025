//SLIDE
$(document).ready(function () {
    let currentIndex = 0;
    const slides = $(".slide");
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.removeClass("active");
        slides.eq(index).addClass("active");
        $(".slides").css("transform", `translateX(-${index * 100}%)`);
    }

    $(".next").click(function () {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    });

    $(".prev").click(function () {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    });

    showSlide(currentIndex);
});




//EDITAR CURSO
$(document).ready(function () {
    // Modal
    var modal = document.getElementById("editModal");
    var btn = document.querySelector(".edit-course");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Pré-visualizar a imagem selecionada
    $("#image").on("change", function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#imgedit").attr("src", e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Salvar alterações
    $("#editCourseForm").submit(function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '/projetos/desafio_revvo2/update_course.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === "success") {
                    alert("Curso atualizado com sucesso!");
                    location.reload();
                } else {
                    alert("Erro ao atualizar o curso: " + (response.message || "Erro desconhecido."));
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Para depuração
                alert("Erro na comunicação com o servidor.");
            }
        });
    });
});

//DELETAR CURSO
$(document).ready(function () {
    $(".delete-course").on("click", function (event) {
        event.preventDefault();

        var courseId = $(this).data("id");

        if (confirm("Você tem certeza que deseja excluir este curso?")) {
            $.ajax({
                url: '/projetos/desafio_revvo2/delete_course.php',
                type: 'POST',
                data: { id: courseId },
                success: function (response) {
                    if (response.status === "success") {
                        alert("Curso excluído com sucesso!");
                        window.location.href = '/projetos/desafio_revvo2/'; // Redireciona para a home
                    } else {
                        alert("Erro ao excluir o curso: " + (response.message || "Erro desconhecido."));
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Para depuração
                    alert("Ocorreu um erro ao excluir o curso.");
                }
            });
        }
    });
});



//ADICIONAR CURSO
$(document).ready(function () {
    // Abrir o modal de adicionar curso
    $("#addCourseBtn").on("click", function (event) {
        event.preventDefault();
        $("#addCourseModal").fadeIn();
    });

    // Fechar o modal
    $(".close").on("click", function () {
        $("#addCourseModal").fadeOut();
        $("#addCourseForm")[0].reset(); // Reseta o formulário
        $("#previewImage").hide(); // Esconde a pré-visualização da imagem
    });

    // Pré-visualizar a imagem selecionada
    $("#image").on("change", function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#previewImage").attr("src", e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Enviar dados para adicionar curso
    $("#addCourseForm").on("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '/projetos/desafio_revvo2/add_course.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === "success") {
                    alert("Curso adicionado com sucesso!");
                    location.reload(); // Recarrega a página para exibir o novo curso
                } else {
                    alert("Erro ao adicionar o curso: " + (response.message || "Erro desconhecido."));
                }
            },
            error: function (xhr, status, error) {
                console.error("Erro de requisição AJAX: ", xhr.responseText);
                alert("Ocorreu um erro ao adicionar o curso.");
            }
        });
    });
});


