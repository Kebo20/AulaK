var $categoria = $("#pro_categoria").select2({ dropdownAutoWidth: true, width: '100%' });
var $tipo = $("#pro_tipo").select2({ dropdownAutoWidth: true, width: '100%' });

Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Clogistica.php?op=LIS_PRO&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {
            $("#lista").html("");


            $.each(data, function (key, val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr class='todo-item'>");
                $("#lista").append("<td width='5%'>" + val[0] + "</td>");
                $("#lista").append("<td width='35%'>" + val[1] + "</td>");
                $("#lista").append("<td width='30%'>" + val[2] + "</td>");
                $("#lista").append("<td width='5%'>" + val[3] + "</td>");
                $("#lista").append("<td width='5%'>" + val[4] + "</td>");
                $("#lista").append("<td width='5%'>" + val[5] + "</td>");
                $("#lista").append("<td width='10%'>" + val[6] + "</td>");
                $("#lista").append("<td width='5%'>" + val[7] + "</td>");

              
                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Clogistica.php?op=PAG_PRO&q=' + $("#buscar").val(),
                type: "POST",
                dataType: "json",

                success: function (cont) {

                    $("#paginacion").html("");
                    if (cont == 0) {
                        $("#lista").html("<td class='text-center' colspan='8'>No se encontraron resultados</tr>");
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
                    $("#lista").html("<td class='text-center' colspan='8'>No se encontraron resultados</tr>");

                    $("#paginacion").html("");
                }
            });


        },

        error: function (e) {
            console.log(e)
            $("#paginacion").html("");
            $("#lista").html("<td class='text-center' colspan='8'>No se encontraron resultados<td></tr>");
        }
    });
}


function abrirModal(){
    $("#pro_valor").val("1");
    $("#pro_nombre,#pro_unidad,#pro_stock_min,#pro_stock_max").val(" ");
    $categoria.val("").trigger("change");
    $tipo.val("").trigger("change");


    $("#ModalRegistrar").modal("show");
    $("#pro_nombre").focus()
}

function editar($id) {
    $.post("controlador/Clogistica.php?op=LLENAR_PRO", { id: $id }, function (data) {
        console.log(data);

        $("#pro_id").val(data.id);
        $("#pro_nombre").val(data.nombre);
        $("#pro_unidad").val(data.unidad);
        $("#pro_stock_min").val(data.stock_min);
        $("#pro_stock_max").val(data.stock_max);

        $categoria.val(data.id_categoria).trigger("change");
        $tipo.val(data.tipo_producto).trigger("change");

        $("#pro_valor").val("2");



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

        url: 'controlador/Clogistica.php?op=NUEVO_PRO',
        type: "POST",
        data: $(this).serialize(),

        success: function (data) {
            $('#ModalRegistrar').modal('hide');
            Listar(1);
            console.log(data);
           $('#formRegistrar').trigger("reset");
            $categoria.val("").trigger("change");
            $tipo.val("").trigger("change");

            
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

        url: 'controlador/Clogistica.php?op=ELIMINAR_PRO',
        type: "POST",
        data: { id: $("#eliminar").val() },

        success: function (data) {
            $('#ModalEliminar').modal('hide');
            Listar(1);
            console.log(data);
            $tipo.val("").trigger("change");

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