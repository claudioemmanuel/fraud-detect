$("#postcode").mask("00000-000");
$("#rg").mask("00.000.000-0");
$("#cpf").mask("000.000.000-00", {
    reverse: true,
});

(() => {
    "use strict";
    const forms = document.querySelectorAll(".needs-validation");

    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");
            },
            false
        );
    });
})();

$("#postcode").blur(function () {
    var postcode = $(this).val().replace(/\D/g, "");

    if (postcode != "") {
        var validated_postcode = /^[0-9]{8}$/;

        if (validated_postcode.test(postcode)) {
            Swal.fire({
                title: "Aguarde...",
                html: "Estamos buscando o CEP informado",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.get(
                        `https://viacep.com.br/ws/${postcode}/json`,
                        function (data) {
                            if ("erro" in data) {
                                $("#streetName").val("");
                                $("#neighborhood").val("");
                                $("#city").val("");
                                $("#state").val("");
                                $("#postcode").val("");

                                return Swal.fire({
                                    icon: "error",
                                    title: "CEP não encontrado!",
                                });
                            }

                            $("#streetName").val(data.logradouro);
                            $("#neighborhood").val(data.bairro);
                            $("#city").val(data.localidade);
                            $("#state").val(data.uf);

                            Swal.close();
                        }
                    );
                },
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "CEP inválido!",
            });
        }
    }
});

$("#manualAddress").click(function () {
    $("#streetName").val("");
    $("#neighborhood").val("");
    $("#city").val("");
    $("#state").val("");

    $("#streetName").prop("readonly", false);
    $("#neighborhood").prop("readonly", false);
    $("#city").prop("readonly", false);
    $("#state").prop("readonly", false);
});

$("#cpf").blur(function () {
    let cpf = $(this).val().replace(/\D/g, "");

    if (cpf != "") {
        let validated_cpf = /^[0-9]{11}$/;

        if (validated_cpf.test(cpf)) {
            Swal.fire({
                title: "Aguarde...",
                html: "Estamos validando o CPF informado",
                allowOutsideClick: false,
                didOpen: () => {
                    fetch(`api/v1/validate-cpf/${cpf}`).then((response) => {
                        if (response.status !== 200) {
                            $("#cpf").val("");

                            response.json().then((data) => {
                                return Swal.fire({
                                    icon: "error",
                                    title: data,
                                });
                            });
                        }
                    });
                },
            });
            Swal.close();
        } else {
            Swal.fire({
                icon: "error",
                title: "CPF inválido!",
            });
        }
    }
});

$("#profile_photo_path").change(function () {
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (
        !(
            imagefile == match[0] ||
            imagefile == match[1] ||
            imagefile == match[2]
        )
    ) {
        Swal.fire({
            icon: "error",
            title: "Por favor, selecione uma imagem válida!",
        });
        $("#profile_photo_path").val("");
        return false;
    }
});

$("#formClient").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    Swal.fire({
        title: "Aguarde...",
        html: "Estamos cadastrando o cliente",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
            $.ajax({
                type: "POST",
                url: "api/v1/store-client",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    Swal.close();
                    Swal.fire({
                        icon: "success",
                        title: "Cliente cadastrado com sucesso!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#formClient")[0].reset();
                            window.location.reload();
                        }
                    });
                },
                error: function (error) {
                    let message =
                        "responseJSON" in error &&
                        "message" in error.responseJSON
                            ? error.responseJSON.message
                            : "Ocorreu um erro ao cadastrar o cliente!";

                    Swal.close();
                    Swal.fire({
                        icon: "error",
                        title: message,
                    });
                },
            });
        },
    });
});
