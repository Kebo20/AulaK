Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=LIS_TIPO_AS&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {

            $("#lista").html("");

            $.each(data, function (key, val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr>");
                $("#lista").append("<td  width='5%'>" + val[0] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[1] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[2] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[3] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[4] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[6] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[5] + "</td>");

                $("#lista").append("<td  width='5%'>" + val[7] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[8] + "</td>");

                $("#lista").append("<td  width='5%'>" + val[9] + "</td>");

                $("#lista").append("<td  width='5%'>" + val[10] + "</td>");

                $("#lista").append("<td  width='5%'>" + val[11] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[12] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[13] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[14] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[15] + "</td>");

                $("#lista").append("<td  width='5%'>" + val[16] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[17] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[18] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[19] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[20] + "</td>");




                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Ccontabilidad.php?op=PAG_TIPO_AS&q=' + $("#buscar").val(),
                type: "POST",
                dataType: "json",

                success: function (cont) {
                    console.log(cont)

                    $("#paginacion").html("");
                    if (cont == 0) {
                        $("#lista").html("<td class='text-center' colspan='20'>No se encontraron resultados</tr>");
                        return false
                    }
                    if (pagina > 1) {
                        $("#paginacion").append("<span class='btn btn-icon ' onclick='Listar(" + (pagina - 1) + ")' ><b><icon class='ft-chevron-left'></icon></span>");

                    }

                    for (var i = 1; i <= cont; i++) {

                        $("#paginacion").append("<span class='btn btn-icon ' id='pagina" + i + "' onclick='Listar(" + i + ")' >" + i + "</span>");

                    }

                    if (pagina < cont) {
                        $("#paginacion").append("<span class='btn btn-icon 'onclick='Listar(" + (pagina + 1) + ")'><b><icon class=' ft-chevron-right'></icon></span>");

                    }

                    $("#pagina" + pagina).removeAttr("class");
                    $("#pagina" + pagina).attr("class", "btn btn-dark");
                },

                error: function (e) {
                    console.log(e)
                   $("#paginacion").html("");
                }
            });


        },

        error: function (e) {
            console.log(e)
            $("#paginacion").html("");
            $("#lista").html("<td class='text-center' colspan='20'>No se encontraron resultados<td></tr>");
        }
    });
}

function abrirModal() {
    $("#valor").val("1");
    $("#ModalRegistrar").modal("show");
    $('#formRegistrar').trigger("reset");

}


function editar($id) {
    $.post("controlador/Ccontabilidad.php?op=LLENAR_TIPO_AS", { id: $id }, function (data) {
        console.log(data);
        $("#valor").val("2");
        $("#tipoAS_id").val(data.id);
        $("#tipoAS_codigo").val(data.codigo);
        $("#tipoAS_nombre").val(data.nombre);
        $("#tipoAS_tipo").val(data.tipo);
        $("#tipoAS_tipo").change();

        $("#tipoAS_apertura").val(data.apertura);
        $("#tipoAS_enero").val(data.enero);
        $("#tipoAS_febrero").val(data.febrero);
        $("#tipoAS_marzo").val(data.marzo);
        $("#tipoAS_abril").val(data.abril);
        $("#tipoAS_mayo").val(data.mayo);
        $("#tipoAS_junio").val(data.junio);
        $("#tipoAS_julio").val(data.julio);
        $("#tipoAS_agosto").val(data.agosto);
        $("#tipoAS_setiembre").val(data.setiembre);
        $("#tipoAS_octubre").val(data.octubre);
        $("#tipoAS_noviembre").val(data.noviembre);
        $("#tipoAS_diciembre").val(data.diciembre);
        $("#tipoAS_1cierre").val(data.cierre1);
        $("#tipoAS_2cierre").val(data.cierre2);
        $("#tipoAS_3cierre").val(data.cierre3);

        $("#ModalRegistrar").modal("show");

    }, "JSON")



}

function eliminar(id) {
    $("#ModalEliminar").modal("show");
    $("#eliminar").val(id);
}


$("#formRegistrar").on("submit", function (e) {
    e.preventDefault();

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=NUEVO_TIPO_AS',
        type: "POST",
        data: $(this).serialize(),

        success: function (data) {
            $('#ModalRegistrar').modal('hide');
            Listar(1);
            console.log(data);
            $('#formRegistrar').trigger("reset");
            if (data == 1) {

                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");

                return false;
            } else
                if (data == 0) {
                    swal("Datos no registrados Correctamente ..", "Error", "error");
                    return false;
                } else {
                    swal("Datos no registrados Correctamente ..", "Error", "error");
                }

        },
        error: function (e) {
            console.log(e);
            swal("Datos no registrados Correctamente ..", "Error", "error");
        }
    });
});


$("#formEliminar").on("submit", function (e) {
    e.preventDefault();

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=ELIMINAR_TIPO_AS',
        type: "POST",
        data: { id: $("#eliminar").val() },

        success: function (data) {
            $('#ModalEliminar').modal('hide');
            Listar(1);
            console.log(data);
            if (data == 1) {

                swal("Datos eliminados Correctamente ..", "Felicitaciones", "success");

                return false;
            } else
                if (data == 0) {
                    swal("Datos no eliminados Correctamente ..", "Error", "error");
                    return false;
                } else {
                    swal("Datos no eliminados Correctamente ..", "Error", "error");
                }

        },
        error: function (e) {
            console.log(e);
            swal("Datos no eliminados Correctamente ..", "Error", "error");
        }
    });
});