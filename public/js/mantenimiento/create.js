
console.log("si llega pa");
//http://localhost/Canal11/public/api
$(function () {
    $("#select-traslado-ambiente").on("change", function () {
        let id_ambiente = $(this).val();
        //!AJAX PA!
        $.get(
            //`http://localhost:80/Canal11/public/api/ambientes/${id_ambiente}/activos`,
            `${service}/api/ambientes/${id_ambiente}/activos`,
            function (activosPorAmbiente) {
                let htmlSelectActivo =
                    '<option value="">--Selecione un Activo--</option>';
                if (activosPorAmbiente.length > 0) {
                    for (let i = 0; i < activosPorAmbiente.length; i++) {
                        htmlSelectActivo +=
                            '<option value="' +
                            activosPorAmbiente[i].id +
                            '">' +
                            activosPorAmbiente[i].nombre +
                            "</option>";
                    }
                } else {
                    htmlSelectActivo =
                        '<option value="">--Ambiente sin activos--</option>';
                }
                $("#select-traslado-activo").html(htmlSelectActivo);
            }
        );
    });
});
