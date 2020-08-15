
var $tipo_auxiliaresR = $("#plan_tipo_auxiliar").select2({ dropdownAutoWidth: true, width: '100%' });

var $tipoR = $("#plan_tipo").select2({ dropdownAutoWidth: true, width: '100%' });

var $estado_financieroR = $("#plan_estado_financiero").select2({ dropdownAutoWidth: true, width: '100%' });

Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=LIS_PLAN&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {

            $("#lista").html("");
            

            $.each(data, function (key, val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr>");
                $("#lista").append("<td width='20%'>" + val[1] + "</td>");
                $("#lista").append("<td width='30%'>" + val[2] + "</td>");
                $("#lista").append("<td width='5%'>" + val[3] + "</td>");
                $("#lista").append("<td width='5%'>" + val[4] + "</td>");
                $("#lista").append("<td width='5%'>" + val[5] + "</td>");
                $("#lista").append("<td width='5%'>" + val[6] + "</td>");
                $("#lista").append("<td width='5%'>" + val[7] + "</td>");
                $("#lista").append("<td width='5%'>" + val[8] + "</td>");
                $("#lista").append("<td width='5%'>" + val[9] + "</td>");
                $("#lista").append("<td width='10%'>" + val[10] + "</td>");


                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Ccontabilidad.php?op=PAG_PLAN&q=' + $("#buscar").val(),
                type: "POST",
                dataType: "json",

                success: function (cont) {

                    $("#paginacion").html("");
                    if (cont == 0) {
                        $("#lista").html("<td class='text-center' colspan='10'>No se encontraron resultados</tr>");
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
                    $("#lista").html("<td class='text-center' colspan='7'>No se encontraron resultados</tr>");

                    $("#paginacion").html("");
                }
            });


        },

        error: function () {
            console.log(data)
            $("#paginacion").html("");
            $("#lista").html("<td class='text-center' colspan='7'>No se encontraron resultados<td></tr>");
        }
    });
}


function abrirModal(){
    $("#valor").val("1");
    $("#ModalRegistrar").modal("show");
    $('#formRegistrar').trigger("reset");
     $tipo_auxiliaresR.val("").trigger("change")
     $tipoR.val("").trigger("change") 

    $estado_financieroR.val("").trigger("change")

}

function editar($id) {
    $.post("controlador/Ccontabilidad.php?op=LLENAR_PLAN", { id: $id }, function (data) {
        console.log(data);
        $("#valor").val("2");
        $("#plan_id").val(data.id);
        $("#plan_codigo").val(data.codigo);
        $("#plan_nombre").val(data.nombre);

        if (data.movimiento == "on") {
            $("#plan_movimiento").prop("checked", true);

        } else {
            $("#plan_movimiento").prop("checked", false);
        }
        if (data.tasa_cambio == "on") {
            $("#plan_tasa_cambio").prop("checked", true);

        } else {
            $("#plan_tasa_cambio").prop("checked", false);
        }
        $("#plan_tipo").val(data.tipo).change();
        $("#plan_estado_financiero").val(data.estado_financiero).change();
        $("#plan_haber").val(data.haber);
        $("#plan_debe").val(data.debe);
        //$("#etipo_auxiliar").val(data.tipo_auxiliar).trigger("change");
        $tipo_auxiliaresR.val(data.id_tipo_auxiliar).trigger("change")

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

        url: 'controlador/Ccontabilidad.php?op=NUEVO_PLAN',
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

        url: 'controlador/Ccontabilidad.php?op=ELIMINAR_PLAN',
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