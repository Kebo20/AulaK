<?php

require_once '../cado/ClaseLogistica.php';
date_default_timezone_set('America/Lima');
$paginacion = 9;

session_start();

$olog = new Logistica();

switch ($_GET["op"]) {
        //ALMACEN
    case "LIS_ALM":
        $datos = array();
        $pagina = $_GET["pagina"];
        $ultimo_pagina = $pagina * $paginacion;
        $primero_pagina = $ultimo_pagina - $paginacion;
        $lista = $olog->ListarAlmacen($_GET["q"], $primero_pagina, $paginacion);
        $cont = $primero_pagina;
        foreach ($lista as $alm) {
            $cont++;
            $subArray = array();
            $subArray[] = $cont;
            $subArray[] = $alm["nombre"];
            $subArray[] = $alm["responsable"];
            $subArray[] = $alm["correo"];
            $subArray[] = $alm["sucursal"];
            if ($alm["tipo"] == '0') {
                $subArray[] = "<span class='badge badge-pill badge-danger'>General</span>";
            }
            if ($alm["tipo"] == '1') {
                $subArray[] = "<span class='badge badge-pill badge-secondary'>Subalmacén</span>";
            }

            $subArray[] = "<div align='center'>
            <a  onclick=\"editar('" . $alm["id"] . "')\" ><i class=' la la-pencil' ></i> </a>" .
                "<span>  </span><a  onclick=\"eliminar(" . $alm["id"] . " )\"  ><i class='ft ft-trash red'></i></a></div>";
            $datos[] = $subArray;
        }

        echo json_encode($datos);
        break;

    case "PAG_ALM":

        $cont = $olog->TotalAlmacen($_GET["q"])->fetch()[0];

        if ($cont == 0) {
            echo 0;
            break;
        }

        if ($cont < $paginacion) {
            echo "1";
        } else {
            echo ceil($cont / $paginacion);
        }
        break;


    case 'LLENAR_ALM':
        $id = $_POST['id'];
        $listar = $olog->ListarAlmacenxid($id);
        echo json_encode($listar->fetch());
        break;

    case 'LISTAR_ALMxSUC':
        $sucursal = $_POST['sucursal'];

        $listar = $olog->ListarAlmacenGeneralxSucursal($sucursal);
        $opt = "<option value=''>Seleccione</option>";
        foreach ($listar as $a) {

            $opt .= "<option value='$a[0]'>$a[1]</option>";
        }

        echo $opt;
        break;
    case 'NUEVO_ALM':
        $nombre = $_POST['nombre'];
        $responsable = $_POST['responsable'];
        $correo = $_POST['correo'];
        $sucursal = $_POST['sucursal'];
        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];
        $validar = $olog->ValidarAlmacen($nombre)->fetch();

        $can = $validar[0];
        // si el valor es igual a 1 insertamos
        if ($valor == 1) {
            if ($can == 0) {

                $insertar = $olog->RegistrarAlmacen($nombre, $responsable, $correo, $sucursal, $tipo);
                echo $insertar;
            } else
                echo 2;
            exit;
        }
        // si el valor es igual a 2 modificamos
        if ($valor == 2) {
            $id = $_POST["id"];

            $modificar = $olog->ModificarAlmacen($id, $nombre, $responsable, $correo, $sucursal, $tipo);
            echo $modificar;
        }
        break;
    case 'ELIMINAR_ALM':
        $id = $_POST['id'];

        $eliminar = $olog->EliminarAlmacen($id);
        echo $eliminar;
        break;
        //CATEGORIA
    case "LIS_CAT":

        $datos = array();
        $pagina = $_GET["pagina"];
        $ultimo_pagina = $pagina * $paginacion;
        $primero_pagina = $ultimo_pagina - $paginacion;
        $lista = $olog->ListarCategoriaProducto($_GET["q"], $primero_pagina, $paginacion);
        $cont = $primero_pagina;
        foreach ($lista as $cat) {
            $cont++;
            $subArray = array();
            $subArray[] = $cont;
            $subArray[] = $cat["nombre"];
            $subArray[] = "<div align='center'>
            <a  onclick=\"editar('" . $cat["id"] . "','" . $cat["nombre"] . "' )\" ><i class=' la la-pencil' ></i> </a>" .
                "<span>  </span><a  onclick=\"eliminar(" . $cat["id"] . " )\"  ><i class='ft ft-trash red'></i></a></div>";
            $datos[] = $subArray;
        }

        echo json_encode($datos);
        break;

    case "PAG_CAT":

        $cont = $olog->TotalCategoria($_GET["q"])->fetch()[0];

        if ($cont == 0) {
            echo 0;
            break;
        }

        if ($cont < $paginacion) {
            echo "1";
        } else {
            echo ceil($cont / $paginacion);
        }
        break;

    case 'LLENAR_CAT':
        $id = $_POST['id'];
        $listar = $olog->ListarCategoriaProductoxid($id);
        echo json_encode($listar->fetch());
        break;
    case 'NUEVO_CAT':
        $nombre = $_POST['nombre'];

        $valor = $_POST['valor'];
        $validar = $olog->ValidarCategoriaProducto($nombre)->fetch();

        $can = $validar[0];
        // si el valor es igual a 1 insertamos
        if ($valor == 1) {
            if ($can == 0) {

                $insertar = $olog->RegistrarCategoriaProducto($nombre);
                echo $insertar;
            } else
                echo 2;
            exit;
        }
        // si el valor es igual a 2 modificamos
        if ($valor == 2) {
            $id = $_POST["id"];

            $modificar = $olog->ModificarCategoriaProducto($id, $nombre);
            echo $modificar;
        }
        break;
    case 'ELIMINAR_CAT':
        $id = $_POST['id'];

        $eliminar = $olog->EliminarCategoriaProducto($id);
        echo $eliminar;
        break;
        //PRODUCTO
    case "LIS_PRO":
        $datos = array();
        $pagina = $_GET["pagina"];
        $ultimo_pagina = $pagina * $paginacion;
        $primero_pagina = $ultimo_pagina - $paginacion;
        $lista = $olog->ListarProductoLog($_GET["q"], $primero_pagina, $paginacion);
        $cont = $primero_pagina;
        foreach ($lista as $alm) {
            $cont++;
            $subArray = array();
            $subArray[] = $cont;
            $subArray[] = $alm["nombre"];
            $subArray[] = $alm["categoria"];
            $subArray[] = $alm["unidad"];
            $subArray[] = $alm["stock_min"];
            $subArray[] = $alm["stock_max"];
            if ($alm["tipo_producto"] == "0") {
                $subArray[] = "<span class='badge badge-danger badge-pill ml-50'>Producto";
            }
            if ($alm["tipo_producto"] == "1") {
                $subArray[] = "<span class='badge badge-secondary badge-pill ml-50'>Servicio";
            }



            $subArray[] = "<div align='center'>
            <a  onclick=\"editar('" . $alm["id"] . "')\" ><i class=' la la-pencil' ></i> </a>" .
                "<span>  </span><a  onclick=\"eliminar(" . $alm["id"] . " )\"  ><i class='ft ft-trash red'></i></a></div>";
            $datos[] = $subArray;
        }

        echo json_encode($datos);
        break;



    case "PAG_PRO":

        $cont = $olog->TotalProducto($_GET["q"])->fetch()[0];

        if ($cont == 0) {
            echo 0;
            break;
        }

        if ($cont < $paginacion) {
            echo "1";
        } else {
            echo ceil($cont / $paginacion);
        }
        break;

    case "LISTAR_PRO_OC":
        $lista = $olog->ListarProductoTipo($_POST['tipo']);
        $tbl = "<option value=''>Seleccione</option>";
        $i = 0;
        foreach ($lista as $pro) {

            $tbl .= "<option id='OCpro_$pro[0]'  value='$pro[0]' nombre_producto='$pro[1]'>$pro[1]</option>";
        }

        echo $tbl;
        break;


    case 'LLENAR_PRO':
        $id = $_POST['id'];
        $listar = $olog->ListarProductoLogxid($id);
        echo json_encode($listar->fetch());
        break;
    case 'NUEVO_PRO':
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $unidad = $_POST['unidad'];
        $stock_min = $_POST['stock_min'];
        $stock_max = $_POST['stock_max'];
        $tipo_producto = $_POST['tipo_producto'];

        $valor = $_POST['valor'];
        $validar = $olog->ValidarProductoLog($nombre)->fetch();

        $can = $validar[0];
        // si el valor es igual a 1 insertamos
        if ($valor == 1) {
            if ($can == 0) {

                $insertar = $olog->RegistrarProductoLog($nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto);
                echo $insertar;
            } else
                echo 2;
            exit;
        }
        // si el valor es igual a 2 modificamos
        if ($valor == 2) {
            $id = $_POST["id"];

            $modificar = $olog->ModificarProductoLog($id, $nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto);
            echo $modificar;
        }
        break;
    case 'ELIMINAR_PRO':
        $id = $_POST['id'];

        $eliminar = $olog->EliminarProductoLog($id);
        echo $eliminar;
        break;



        //Orden de Compra

    case "NUEVO_ORD_COM":

        $detalles_orden_compra = json_decode($_POST["orden_compra"], true);
        $fecha = $_POST['fecha'];
        $nro = $_POST['nro'];
        $sucursal = $_POST['sucursal'];

        $almacen = $_POST['almacen'];
        $referencia = $_POST['referencia'];
        $tipo = $_POST['tipo'];

        $valor = $_POST['valor'];
        $validar = $olog->ValidarOrdenCompra($nro)->fetch();

        $can = $validar[0];
        // si el valor es igual a 1 insertamos
        if ($valor == 1) {
            if ($can == 0) {

                $insertar = $olog->RegistrarOrdenCompra($detalles_orden_compra, $nro, $fecha, $sucursal,  $almacen, $referencia, $tipo);
                echo $insertar;
            } else
                echo 2;
            exit;
        }
        // si el valor es igual a 2 modificamos
        if ($valor == 2) {
            $id = $_POST["id"];
            $modificar = $olog->ModificarOrdenCompra($id, $detalles_orden_compra, $nro, $fecha, $sucursal, $almacen, $referencia, $tipo);
            echo $modificar;
        }
        break;

    case "LIS_ORD_COM":
        $nro = $_POST["nro"];
        $fecha = $_POST["fecha"];
        $estado = $_POST["estado"];
        $almacen = $_POST["almacen"];

        $where = array();
        $where2 = "";
        if ($nro != "" || $fecha != "" || $estado != "" || $almacen != "") {
            $where2 = " where ";
        }
        if ($nro != "") {
            $where[] = " o.numero='$nro' ";
        }
        if ($fecha != "") {
            $where[] = " o.fecha='$fecha'";
        }
        if ($estado != "") {
            $where[] = " o.estado='$estado'";
        }
        if ($almacen != "") {

            $where[] = " o.id_almacen='$almacen'";
        }



        $where2 .= implode(" and ", $where);

        $lista = $olog->ListarOrdenCompra($where2);
        $tbl = "";
        $i = 0;
        foreach ($lista as $o) {
            $i++;
            $id = 'TblOC_' . $i;
            if ($i % 2 == 0) {
                //$color = "style=' background-color:#f5f5f5; height:30px'";
                $color = "style='background-color:#ffffff; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $estado = "$o[5]";
            if ($o[5] == "pendiente") {
                $estado = "<btn class='badge badge-success badge-pill ml-50' >$o[5] </btn>";
            }
            if ($o[5] == "anulada") {
                $estado = "<btn class='badge badge-danger  badge-pill ml-50' >$o[5]</btn>";
            }
            if ($o[5] == "finalizada") {
                $estado = "<btn class='badge badge-secondary badge-pill ml-50' >$o[5]</btn>";
            }

            if ($o[6] == "0") {
                $tipo = "<btn class='badge badge-danger badge-pill ml-50' >Producto</btn>";
            }
            if ($o[6] == "1") {
                $tipo = "<btn class='badge badge-secondary  badge-pill ml-50' >Servicio</btn>";
            }


            $tbl .= "<tr id='$id' idOC='$o[0]'  $color  onclick=\"PintarFilaOC('$id')\" ondblclick='OCLlenarDatos()'>"
                . "<td >$i</td>"
                . "<td >$o[3]</td>"
                . "<td >$o[2]</td>"
                . "<td >$o[1]</td>"


                . "<td >$o[4]</td>"
                . "<td align='center' >$tipo</td>"
                . "<td align='center' >$estado</td>"

                . "</tr>";
        }

        echo $tbl;
        break;


    case "LIS_ORD_COMxnro":
        $nro = $_POST["nro"];


        $where = array();
        $where2 = "";

        $where2 = " where ";

        if ($nro != "") {
            $where[] = " o.numero='$nro' ";
        }

        $where[] = " o.estado='pendiente'";

        $where2 .= implode(" and ", $where);

        $lista = $olog->ListarOrdenCompra($where2);
        $tbl = "";
        $i = 0;
        foreach ($lista as $o) {
            $i++;
            $id = 'TblECOC_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }


            $tbl .= "<tr id='$id' idECOC='$o[0]' tipoECOC=''  $color onclick=\"PintarFilaECOC('$id')\">"
                . "<td >$i</td>"
                . "<td >$o[3]</td>"
                . "<td >$o[2]</td>"
                . "</tr>";
        }

        echo $tbl;
        break;


    case 'LLENAR_ORD_COM':
        $id = $_POST['id'];
        $listar = $olog->ListarOrdenCompraxId($id);
        echo json_encode($listar->fetch());
        break;
    case 'LLENAR_ORD_COM_DET':
        $id = $_POST['id'];

        $orden_compra = $olog->ListarOrdenCompraxId($id)->fetch();

        $listar = $olog->ListarOrdenComprDetalles($id);

        echo json_encode($listar->fetchAll());
        break;
    case 'ESTADO_ORD_COM':
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $actualizar = $olog->EstadoOrdenCompra($id, $estado);
        echo $actualizar;
        break;





        //COMPRAS

    case "NUEVO_COM":

        $detalles_compra = json_decode($_POST["compra"], true);
        $fecha = $_POST['fecha'];
        $proveedor = $_POST['proveedor'];
        $tipo_documento = $_POST['tipo_documento'];
        $tipo_afectacion = $_POST['tipo_afectacion'];
        $monto_sin_igv = $_POST['monto_sin_igv'];
        $igv = $_POST['igv'];
        $monto_igv = $_POST['monto_igv'];
        $total = $_POST['total'];
        $nota_credito = $_POST['nota_credito'];
        $tipo_compra = $_POST['tipo_compra'];
        $nro_dias = $_POST['nro_dias'];
        $nro_documento = $_POST['nro_documento'];
        $id_orden = $_POST['id_orden'];
        $insertar = $olog->RegistrarCompra(
            $detalles_compra,
            $fecha,
            $proveedor,
            $tipo_documento,
            $tipo_afectacion,
            $monto_sin_igv,
            $igv,
            $monto_igv,
            $total,
            $nota_credito,
            $tipo_compra,
            $nro_documento,
            $nro_dias,
            $id_orden
        );

        echo $insertar;
        break;


    case "LIS_COM":

        $datos = array();
        $pagina = $_GET["pagina"];
        $ultimo_pagina = $pagina * $paginacion;
        $primero_pagina = $ultimo_pagina - $paginacion;
        $lista = $olog->ListarCompra($_GET["q"], $primero_pagina, $paginacion);
        $cont = $primero_pagina;
        foreach ($lista as $prov) {

            if ($prov[10] == "0") {
                $nota_credito = "<input disabled type='checkbox' >";
            } else if ($prov[10] == "1") {
                $nota_credito = "<input disabled type='checkbox' checked >";
            } else {
                $nota_credito = "";
            }
            $cont++;
            $subArray = array();
            $subArray[] = $cont;
            $subArray[] = $prov[3];
            $subArray[] = $prov[13];

            $subArray[] = $prov[0];
            $subArray[] = $prov[11];
            $subArray[] = $prov[1];
            $subArray[] = $prov[2];

            $subArray[] = $prov[4];
            $subArray[] = $prov[5];
            $subArray[] = $prov[6];
            $subArray[] = $prov[7];
            $subArray[] = $prov[8];
            $subArray[] = $prov[12];
            $subArray[] = $prov[14];
            $subArray[] = "<div align='center'>
                <a  onclick=\"detalles('" . $prov["id"] . "')\" ><i class=' la la-search-plus' ></i> </a>";

            $subArray[] = "<div align='center'>
                <a  onclick=\"editar('" . $prov["id"] . "')\" ><i class=' la la-pencil' ></i> </a>" .
                "<span>  </span><a  onclick=\"eliminar(" . $prov["id"] . " )\"  ><i class='ft ft-trash red'></i></a></div>";
            $datos[] = $subArray;
        }

        echo json_encode($datos);
        break;

    case "PAG_COM":

        $cont = $olog->TotalCompra($_GET["q"])->fetch()[0];

        if ($cont == 0) {
            echo 0;
            break;
        }

        if ($cont < $paginacion) {
            echo "1";
        } else {
            echo ceil($cont / $paginacion);
        }
        break;
    case "LIS_COMPRA_DETALLE":
        $compra = $_POST["compra"];

        $lista = $olog->ListarCompraDetalles($compra);
        $tbl = "";
        $i = 0;
        foreach ($lista as $c) {
            $i++;
            $id = 'TblComD_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }

            if ($c[4] == "0") {
                $bonificacion = "<input disabled type='checkbox' >";
            } else if ($c[4] == "1") {
                $bonificacion = "<input disabled type='checkbox' checked >";
            } else {
                $bonificacion = "";
            }
            $tbl .= "<tr id='$id' style='height:20px'  $color >"
                . "<td class='text-right' >$i</td>"
                . "<td >$c[0]</td>"
                . "<td align='center' >$bonificacion</td>"
                . "<td align='center'>$c[5] </td>"
                . "<td class='text-right'>$c[12]  </td>"
                . "<td class='text-right'>$c[7]  </td>"
                . "<td class='text-right'>S/." . $c[8] . "  </td>"
                . "<td class='text-right' >S/." . $c[9] . "  </td>"
                . "<td class='text-right'>S/." . $c[10] . "  </td>"
                . "<td class='text-right'>S/." . $c[11] . "  </td>"
                . "</tr>";
        }

        echo $tbl;

        break;

    case 'PRECIO_COMPRA_ULTIMO':
        $id = $_POST['id'];

        $listar = $olog->UltimaPrecioCompra($id);
        echo json_encode($listar->fetch());
        break;

        //PROVEEDOR
    case "LIS_PROV":
        $datos = array();
        $pagina = $_GET["pagina"];
        $ultimo_pagina = $pagina * $paginacion;
        $primero_pagina = $ultimo_pagina - $paginacion;
        $lista = $olog->ListarProveedor($_GET["q"], $primero_pagina, $paginacion);
        $cont = $primero_pagina;
        foreach ($lista as $prov) {
            $cont++;
            $subArray = array();
            $subArray[] = $cont;
            $subArray[] = $prov["nombre"];
            $subArray[] = $prov["documento"];
            $subArray[] = $prov["direccion"];
            $subArray[] = $prov["contacto"];
            $subArray[] = $prov["telefono"];
            $subArray[] = $prov["email"];

            $subArray[] = "<div align='center'>
                <a  onclick=\"editar('" . $prov["id"] . "')\" ><i class=' la la-pencil' ></i> </a>" .
                "<span>  </span><a  onclick=\"eliminar(" . $prov["id"] . " )\"  ><i class='ft ft-trash red'></i></a></div>";
            $datos[] = $subArray;
        }

        echo json_encode($datos);
        break;



    case "PAG_PROV":

        $cont = $olog->TotalProveedor($_GET["q"])->fetch()[0];

        if ($cont == 0) {
            echo 0;
            break;
        }

        if ($cont < $paginacion) {
            echo "1";
        } else {
            echo ceil($cont / $paginacion);
        }
        break;
    case 'LLENAR_PROV':
        $id = $_POST['id'];
        $listar = $olog->ListarProveedorxid($id);
        echo json_encode($listar->fetch());
        break;
    case 'NUEVO_PROV':
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $contacto = $_POST['contacto'];
        $documento = $_POST['documento'];
        $email = $_POST['correo'];
        $valor = $_POST['valor'];
        $validar = $olog->Validarproveedor($nombre)->fetch();

        $can = $validar[0];
        // si el valor es igual a 1 insertamos
        if ($valor == 1) {
            if ($can == 0) {

                $insertar = $olog->Registrarproveedor($nombre, $documento, $direccion, $contacto, $telefono, $email);
                echo $insertar;
            } else
                echo 2;
            exit;
        }
        // si el valor es igual a 2 modificamos
        if ($valor == 2) {
            $id = $_POST["id"];

            $modificar = $olog->Modificarproveedor($id, $nombre, $documento, $direccion, $contacto, $telefono, $email);
            echo $modificar;
        }
        break;
    case 'ELIMINAR_PROV':
        $id = $_POST['id'];

        $eliminar = $olog->Eliminarproveedor($id);
        echo $eliminar;
        break;


    case 'LIS_LOTE':
        $datos = array();
        $pagina = $_GET["pagina"];
        $ultimo_pagina = $pagina * $paginacion;
        $primero_pagina = $ultimo_pagina - $paginacion;
        $lista = $olog->ListarLote($_GET["q"], $primero_pagina, $paginacion);
        $cont = $primero_pagina;
        foreach ($lista as $prov) {
            $cont++;
            $subArray = array();
            $subArray[] = $cont;
            $subArray[] = $prov["nro"];
            $subArray[] = $prov["nombre"];
            $subArray[] = $prov["cantidad"];
            $subArray[] = $prov["fecha_vencimiento"];


            $datos[] = $subArray;
        }

        echo json_encode($datos);
        break;



    case "PAG_LOTE":

        $cont = $olog->TotalLote($_GET["q"])->fetch()[0];

        if ($cont == 0) {
            echo 0;
            break;
        }

        if ($cont < $paginacion) {
            echo "1";
        } else {
            echo ceil($cont / $paginacion);
        }
        break;
        case 'LIS_ORD_DOC':
            $datos = array();
            $pagina = $_GET["pagina"];
            $ultimo_pagina = $pagina * $paginacion;
            $primero_pagina = $ultimo_pagina - $paginacion;
            $lista = $olog->ListarOrdDoc($_GET["q"], $primero_pagina, $paginacion);
            $cont = $primero_pagina;
            foreach ($lista as $prov) {
                $cont++;
                $subArray = array();
                $subArray[] = $cont;
                $subArray[] = $prov[0];
                $subArray[] = $prov[1];
                $subArray[] = $prov[2];
                $subArray[] = $prov[3]." - ".$prov[4];
                $subArray[] = $prov[5];
    
    
                $datos[] = $subArray;
            }
    
            echo json_encode($datos);
            break;
    
    
    
        case "PAG_ORD_DOC":
    
            $cont = $olog->TotalOrdDoc($_GET["q"])->fetch()[0];
    
            if ($cont == 0) {
                echo 0;
                break;
            }
    
            if ($cont < $paginacion) {
                echo "1";
            } else {
                echo ceil($cont / $paginacion);
            }
            break;
    

    }
