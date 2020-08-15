Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=LIS_TIPO_DOC&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {
            console.log(data)

            $("#lista").html("");
            

            $.each(data, function (key, val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr>");
                $("#lista").append("<td width='5%'>" + val[0] + "</td>");

                $("#lista").append("<td width='15%'>" + val[1] + "</td>");
                $("#lista").append("<td width='30%'>" + val[2] + "</td>");
                $("#lista").append("<td width='5%'>" + val[3] + "</td>");
                $("#lista").append("<td width='5%'>" + val[4] + "</td>");
                $("#lista").append("<td width='5%'>" + val[5] + "</td>");
                $("#lista").append("<td width='5%'>" + val[6] + "</td>");
                $("#lista").append("<td width='5%'>" + val[7] + "</td>");
                $("#lista").append("<td width='5%'>" + val[8] + "</td>");
                $("#lista").append("<td width='5%'>" + val[9] + "</td>");
                $("#lista").append("<td width='5%'>" + val[10] + "</td>");
                $("#lista").append("<td width='5%'>" + val[11] + "</td>");


                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Ccontabilidad.php?op=PAG_TIPO_DOC&q=' + $("#buscar").val(),
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

        error: function (e) {
            console.log(e)
            $("#paginacion").html("");
            $("#lista").html("<td class='text-center' colspan='7'>No se encontraron resultados<td></tr>");
        }
    });
}


function editar($id) {
    $.post("controlador/Ccontabilidad.php?op=LLENAR_TIPO_DOC", { id: $id }, function (data) {
        console.log(data);
        $("#valor").val("2");
        if( data.suma=='on' ) {
            $("#tipoDOC_suma").prop('checked',true)

        }else{
            $("#tipoDOC_suma").prop('checked',false)

        }

        if( data.anticipo=='on' ) {
            $("#tipoDOC_anticipo").prop('checked',true)

        }else{
            $("#tipoDOC_anticipo").prop('checked',false)

        }

        if( data.igv=='on' ) {
            $("#tipoDOC_igv").prop('checked',true)

        }else{
            $("#tipoDOC_igv").prop('checked',false)

        }

        
        $("#tipoDOC_id").val(data.id);
        $("#tipoDOC_codigo").val(data.codigo);
        $("#tipoDOC_nombre").val(data.nombre);
        $("#tipoDOC_tipo").val(data.tipo);
        $("#tipoDOC_abreviatura").val(data.abreviatura);
        $("#tipoDOC_cuenta").val(data.cuenta_ventas);
        $("#tipoDOC_correlativo").val(data.correlativo);
        $("#tipoDOC_serie").val(data.serie);
  
        $("#ModalRegistrar").modal("show");

    }, "JSON")



}

function eliminar(id) {
    $("#ModalEliminar").modal("show");
    $("#eliminar").val(id);
}


function abrirModal(){
    $("#valor").val("1");
    $('#ModalRegistrar').modal('show');
    $('#formRegistrar').trigger("reset");


}


$("#formRegistrar").on("submit", function (e) {
    e.preventDefault();
    
    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=NUEVO_TIPO_DOC',
        type: "POST",
        data:$(this).serialize(),

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

        url: 'controlador/Ccontabilidad.php?op=ELIMINAR_TIPO_DOC',
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