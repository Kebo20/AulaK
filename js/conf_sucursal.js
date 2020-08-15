
 Listar(1);

 function Listar(pagina) {
     //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
     //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

     $.ajax({

         url: "controlador/Ccontabilidad.php?op=LIS_SUC&q=" + $('#buscar').val() + "&pagina=" + pagina + "&id_empresa="+ $('#suc_empresa').val(),
         type: "POST",
         dataType: "json",

         success: function(data) {
             $("#lista").html("");
             console.log(data)

             $.each(data, function(key, val) {

                 $("#lista").append("<tbody>");
                 $("#lista").append("<tr>");
                 $("#lista").append("<td width='5%'>" + val[0] + "</td>");
                 $("#lista").append("<td width='5%'>" + val[1] + "</td>");
                 $("#lista").append("<td width='10%'>" + val[2] + "</td>");
                 $("#lista").append("<td width='10%'>" + val[3] + "</td>");
                 $("#lista").append("<td width='25%'>" + val[4] + "</td>");
                 $("#lista").append("<td width='5%'>" + val[5] + "</td>");
                 $("#lista").append("<td width='10%'>" + val[6] + "</td>");
                 $("#lista").append("<td width='10%'>" + val[7] + "</td>");
                 $("#lista").append("<td width='10%'>" + val[8] + "</td>");

                 $("#lista").append("<td width='10%'>" + val[9] + "</td>");
                 $("#lista").append("<td width='10%'>" + val[11] + "</td>");



                 $("#lista").append("</tr>");
                 $("#lista").append("</tbody>");

             })

             $.ajax({

                 url: "controlador/Ccontabilidad.php?op=PAG_SUC&q=" + $('#buscar').val()+"&id_empresa="+ $('#suc_empresa').val(),
                 type: "POST",
                 dataType: "json",

                 success: function(cont) {
                     $("#paginacion").html("");
                     if (cont == 0) {
                         $("#lista").html("<td class='text-center' colspan='12'>No se encontraron resultados</tr>");
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

                 error: function(e) {
                     console.log(e)
                     $("#paginacion").html("");
                 }
             });


         },

         error: function(e) {
             console.log(e)
             $("#paginacion").html("");
             $("#lista").html("<td class='text-center' colspan='12'>No se encontraron resultados<td></tr>");
         }
     });
 }


//$('.chosen-select').chosen({allow_single_deselect: true});
//$(document).find('.chosen-container').css({width: "100%"});
// Basic Select2 select


var $departamento = $("#suc_id_cmb_dep").select2({ dropdownAutoWidth: true, width: '100%' });
var $distrito = $("#suc_id_cmb_dis").select2({ dropdownAutoWidth: true, width: '100%' });
var $provincia = $("#suc_id_cmb_pro").select2({ dropdownAutoWidth: true, width: '100%' });

$(document).on('change', '#suc_id_cmb_dep', function () {



    $.post("controlador/Cubigeo.php", { departamento: $(this).val(), accion: "provincias" }, function (provincias) {

        $('#suc_id_cmb_pro').html(provincias);
        $("#suc_id_cmb_dis").html("<option value='' >Seleccione un distrito</option>")


    }).fail(function (error) {
        $('#suc_id_cmb_pro').html("");
        $('#suc_id_cmb_dis').html("");

        console.log(error);
    });


})
$(document).on('change', '#suc_id_cmb_pro', function () {

    $.post("controlador/Cubigeo.php", { provincia: $(this).val(), accion: "distritos" }, function (distritos) {

        $('#suc_id_cmb_dis').html(distritos);
    }).fail(function (error) {
        $('#suc_id_cmb_dis').html("");
        console.log(error);
    });
})


$('.numero').on("keypress", function () {
    if (event.keyCode > 47 && event.keyCode < 60 || event.keyCode == 46) {

    } else {
        event.preventDefault();
    }

});




function abrirModal(){
    $("#valor").val("1")
    $("#ModalRegistrar").modal("show");


}



function editar(id, nombre, departamento, provincia, distrito, direccion, telefono, representante, dni, cell,empresa) {
    $("#valor").val("2")
    $("#suc_id").val(id)
    $("#suc_nombre").val(nombre)
    $("#suc_telefono").val(telefono)
    $("#suc_direccion").val(direccion)
    $("#suc_dni").val(dni)
    $("#suc_representante").val(representante)
    $("#suc_cell").val(cell)

    $departamento.val(departamento).trigger("change")

    setTimeout(function () {


        setTimeout(function () {

            $distrito.val(distrito).trigger("change")
            $("#ModalRegistrar").modal("show");
        }, 300)

        $provincia.val(provincia).trigger("change")

    }, 300)




}


function eliminar(id) {
    $("#ModalEliminar").modal("show");
    $("#eliminar").val(id);
}



$("#formRegistrar").on("submit", function (e) {
    e.preventDefault();

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=NUEVO_SUC',
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

        url: 'controlador/Ccontabilidad.php?op=ELIMINAR_SUC',
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