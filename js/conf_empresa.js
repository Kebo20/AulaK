
Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=LIS_EMP&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {

            $("#lista").html("");

            $.each(data,function(key,val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr>");
                $("#lista").append("<td  width='5%'>" + val[0] + "</td>");
                $("#lista").append("<td  width='35%'>" + val[1] + "</td>");
                $("#lista").append("<td  width='10%'>" + val[2] + "</td>");
                $("#lista").append("<td  width='10%'>" + val[3] + "</td>");
                $("#lista").append("<td  width='25%'>" + val[4] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[6] + "</td>");
                $("#lista").append("<td  width='5%'>" + val[7] + "</td>");
                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Ccontabilidad.php?op=PAG_EMP&q=' + $("#buscar").val(),
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



$(document).ready(function () {


    $("#emp_ruc").keyup(function (e) {
        if ($("#emp_ruc").val().length == 11) {
            ConsultaRuc();
        }
    })



});

function CerrarCargando() {
    $("#IdCargando").hide();
    $("#IdGrabarUsu").prop("disabled", false)
}


function ConsultaRuc() {

    var $ruc = $('#emp_ruc').val();

    $("#IdCargando").show();
    $.ajax({
        type: 'POST',
        url: 'controlador/Ccontabilidad.php?op=CONSULTA_RUC',
        data: { ruc: $ruc },
        dataType: "JSON",
        success: function (datos) {
            $("#IdCargando").hide();
            if (datos == 0) {
                $("#emp_ruc,#emp_nombre,#emp_estado,#emp_direccion").val("");
                swal("RUC no se encuentra en la Busqueda ..", "Error", "error");


            }
            $('#emp_nombre').val(datos[1]);
            $('#emp_direccion').val(datos[2]);
            $("#emp_estado").val(datos[3]);
            return false;
        },
        error: function (e) {
            $("#IdCargando").hide();
            console.log(e);
        }
    });

}


function abrirModal(){
    $("#valor").val("1");
    $("#ModalRegistrar").modal("show");
    $('#formRegistrar').trigger("reset");

    
}




function editar(id, ruc, nombre, direccion, telefono, pass, representante, dni, cell) {
    $("#valor").val("2")
    $("#emp_id").val(id);
    $("#emp_dni").val(dni);
    $("#emp_ruc").val(ruc);
    $("#emp_nombre").val(nombre);

    $("#emp_direccion").val(direccion);
    $("#emp_telefono").val(telefono);
    $("#emp_pass").val(pass);
    $("#emp_representante").val(representante);
    $("#emp_cell").val(cell);
    $("#ModalRegistrar").modal("show");

}

function eliminar(id) {
    $("#ModalEliminar").modal("show");
    $("#eliminar").val(id);
}


$("#formRegistrar").on("submit", function (e) {
    e.preventDefault();

    $.ajax({

        url: 'controlador/Ccontabilidad.php?op=NUEVO_EMP',
        type: "POST",
        data: $(this).serialize(),

        success: function (data) {
            $('#ModalRegistrar').modal('hide');
            //tableEmpresa.ajax.reload();
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

        url: 'controlador/Ccontabilidad.php?op=ELIMINAR_EMP',
        type: "POST",
        data: { id: $("#eliminar").val() },

        success: function (data) {
            $('#ModalEliminar').modal('hide');
            //tableEmpresa.ajax.reload();
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