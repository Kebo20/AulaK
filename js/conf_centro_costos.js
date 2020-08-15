
Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=LIS_CENTRO&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {

            $("#lista").html("");

            $.each(data,function(key,val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr>");
                $("#lista").append("<td  width='5%'>" + val[0] + "</td>");
                $("#lista").append("<td  width='10%'>" + val[1] + "</td>");
                $("#lista").append("<td  width='40%'>" + val[2] + "</td>");
                $("#lista").append("<td  width='25%'>" + val[3] + "</td>");
                $("#lista").append("<td  width='15%'>" + val[4] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[5] + "</td>");

              
                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Ccontabilidad.php?op=PAG_CENTRO&q=' + $("#buscar").val(),
                type: "POST",
                dataType: "json",

                success: function (cont) {

                    $("#paginacion").html("");
                    if(cont==0){
                    $("#lista").html("<td class='text-center' colspan='7'>No se encontraron resultados</tr>");
                    return false
                    }
                    if(pagina>1){
                        $("#paginacion").append("<span class='btn btn-icon ' onclick='Listar(" + (pagina - 1) + ")' ><b><icon class='ft-chevron-left'></icon></span>");

                    }

                    for (var i = 1; i <= cont; i++) {

                        $("#paginacion").append("<span class='btn btn-icon ' id='pagina" + i + "' onclick='Listar(" + i + ")' >" + i + "</span>");

                    }

                    if(pagina<cont){
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

}



function editar($id) {
    $.post("controlador/Ccontabilidad.php?op=LLENAR_CENTRO", { id: $id }, function (data) {
        console.log(data);

        $("#valor").val("2");
        $("#centro_id").val(data.id);
        $("#centro_codigo").val(data.codigo);
        $("#centro_descripcion").val(data.descripcion);

        $("#centro_cuenta").val(data.cuenta);
        $("#centro_activo").val(data.activo);
       
  
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

        url: 'controlador/Ccontabilidad.php?op=NUEVO_CENTRO',
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

        url: 'controlador/Ccontabilidad.php?op=ELIMINAR_CENTRO',
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