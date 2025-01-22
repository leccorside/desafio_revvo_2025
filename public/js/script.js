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



//BUSCAR CURSO
$(document).ready(function() {
    // Ao digitar no campo de pesquisa
    $("#courseSearch").on("input", function() {
        var searchTerm = $(this).val();

        // Se o termo tiver pelo menos 3 caracteres
        if (searchTerm.length >= 3) {
            $.ajax({
                url: '/projetos/desafio_revvo2/search_courses.php',
                type: 'GET',
                data: { q: searchTerm },
                success: function(response) {
                    // Limpa a lista de resultados
                    $("#searchResults").empty();

                    // Se houver resultados, exibe-os
                    if (response.length > 0) {
                        $.each(response, function(index, course) {
                            // Criando o item de lista com o título clicável
                            var listItem = $("<li>")
                                .text(course.title)
                                .on("click", function() {
                                    // Redireciona para a página do curso
                                    window.location.href = "/projetos/desafio_revvo2/curso/" + course.id;
                                });

                            // Adiciona o item à lista de resultados
                            $("#searchResults").append(listItem);
                        });

                        // Exibe os resultados
                        $("#searchResults").show();
                    } else {
                        $("#searchResults").hide(); // Se não houver resultados, esconde a lista
                    }
                },
                error: function() {
                    alert("Erro ao realizar a busca.");
                }
            });
        } else {
            // Esconde os resultados se o termo for menor que 3 caracteres
            $("#searchResults").hide();
        }
    });

    // Fecha a lista de resultados ao clicar fora
    $(document).on("click", function(event) {
        if (!$(event.target).closest("#searchResults, #courseSearch").length) {
            $("#searchResults").hide();
        }
    });
});



//MODAL WELLCOME
$(document).ready(function() {
    var modal = document.getElementById("welcomeModal");
    var closeModal = document.getElementById("closeModal");
    var closeButton = document.getElementsByClassName("close")[0];

    // Função para exibir o modal
    function showModal() {
        modal.style.display = "block";
    }

    // Função para fechar o modal
    function closeModalFunc() {
        modal.style.display = "none";
    }

    // Verifica se o modal foi exibido nos últimos 10 dias
    var lastShown = localStorage.getItem("modalLastShown");
    var currentDate = new Date();

    if (lastShown) {
        var lastShownDate = new Date(lastShown);
        var diffDays = (currentDate - lastShownDate) / (1000 * 3600 * 24); // Diferença em dias

        if (diffDays >= 10) {
            // Se passaram 10 dias, mostrar o modal
            showModal();
        }
    } else {
        // Se for a primeira vez, mostrar o modal
        showModal();
    }

    // Ao fechar o modal, salva a data da última exibição
    closeModal.addEventListener("click", function() {
        localStorage.setItem("modalLastShown", currentDate.toISOString());
        closeModalFunc();
    });

    closeButton.onclick = function() {
        localStorage.setItem("modalLastShown", currentDate.toISOString());
        closeModalFunc();
    }

    // Fechar o modal ao clicar fora da área do conteúdo
    window.onclick = function(event) {
        if (event.target === modal) {
            localStorage.setItem("modalLastShown", currentDate.toISOString());
            closeModalFunc();
        }
    }
});
