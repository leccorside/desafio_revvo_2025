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



