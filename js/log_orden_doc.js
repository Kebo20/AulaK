Listar(1);
function Listar(pagina) {

    //  $("#lista").html("<tr><td class='text-center' colspan='5'>Cargando ...<td></tr>");
    //    $("#paginacion").html("<span class='btn btn-info'>Anterior</span> <span class='btn btn-success'>1</span> <span class='btn btn-info'>Siguiente</span>")

    $.ajax({

        url: 'controlador/Clogistica.php?op=LIS_ORD_DOC&q=' + $("#buscar").val() + "&pagina=" + pagina,
        type: "POST",
        dataType: "json",

        success: function (data) {
            console.log(data)
            $("#lista").html("");


            $.each(data, function (key, val) {

                $("#lista").append("<tbody>");
                $("#lista").append("<tr>");
                $("#lista").append("<td width='10%' align='center'>" + val[0] + "</td>");
                $("#lista").append("<td width='25%' >" + val[1] + "</td>");
                $("#lista").append("<td width='15%'>" + val[2] + "</td>");
                $("#lista").append("<td width='15%' align='left'>" + val[3] + "</td>");
                $("#lista").append("<td width='20%'>"+val[4]+"</td>");
                $("#lista").append("<td width='15%'align='left'>"+val[5]+"</td>");
             

                $("#lista").append("</tr>");
                $("#lista").append("</tbody>");

            })

            $.ajax({

                url: 'controlador/Clogistica.php?op=PAG_ORD_DOC&q=' + $("#buscar").val(),
                type: "POST",
                dataType: "json",

                success: function (cont) {

                    $("#paginacion").html("");
                    if (cont == 0) {
                        $("#lista").html("<td class='text-center' colspan='7'>No se encontraron resultados</tr>");
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



