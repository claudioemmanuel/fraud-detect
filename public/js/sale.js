$(document).ready(function () {
    $("#divTableClient").hide();
    if (typeof $.fn.DataTable === "function") {
        $("#tableClients").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
            },
            processing: true,
        });
        $("#spinnerLoading").hide();
        $("#divTableClient").show();
    }
});

function handleInitSale(client) {
    Swal.fire({
        title: "Deseja iniciar uma venda para este cliente?",
        text: "Você não poderá mais alterar o cliente da venda!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#aa0505",
        cancelButtonColor: "#b97d10",
        confirmButtonText: "Sim, iniciar venda!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Aguarde...",
                html: "Estamos iniciando a venda",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        type: "POST",
                        url: "api/v1/init-sale",
                        data: {
                            client: client,
                        },
                        success: function (data) {
                            Swal.close();
                            Swal.fire({
                                icon: "success",
                                title: "Venda criada com sucesso!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function (error) {
                            let message =
                                "responseJSON" in error
                                    ? error.responseJSON
                                    : "Ocorreu um erro ao iniciar a venda!";
                            Swal.close();
                            Swal.fire({
                                icon: "error",
                                title: message,
                            });
                        },
                    });
                },
            });
        }
    });
}
