<?php

require_once('conexion.php');

class Logistica
{

    // FUNCIONES PARA EL MANTENEDOR ALMACÉN	   
    function ListarAlmacen($q, $inicio, $fin)
    {
        $ocado = new cado();
        $sql = "select a.*,s.nombre as sucursal from log_almacen a inner join cont_sucursal s on s.id=a.id_sucursal where  
        a.estado=0  and (a.nombre like '%$q%' or a.responsable like '%$q%' ) order by a.nombre asc limit $inicio,$fin";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function TotalAlmacen($q)
    {
        $ocado = new cado();

        $sql = "select count(*) from log_almacen a inner join cont_sucursal s on s.id=a.id_sucursal where  
        a.estado=0  and (a.nombre like '%$q%' or a.responsable like '%$q%' )";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarAlmacenxid($id)
    {
        $ocado = new cado();
        $sql = "select * from log_almacen where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarAlmacenGeneralxSucursal($sucursal)
    {
        $ocado = new cado();
        $sql = "select * from log_almacen where  id_sucursal='$sucursal'  and tipo='0' ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarAlmacen($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from log_almacen where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarAlmacen($nombre, $responsable, $correo, $sucursal, $tipo)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_almacen(nombre,responsable,correo,id_sucursal,estado,tipo) values"
                . "('$nombre','$responsable','$correo','$sucursal',0,'$tipo')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }

        return $return;
    }

    function ModificarAlmacen($id, $nombre, $responsable, $correo, $sucursal, $tipo)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_almacen set nombre = '$nombre' , responsable='$responsable',correo='$correo' ,"
                . "id_sucursal='$sucursal',tipo='$tipo' where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarAlmacen($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_almacen set estado=1 where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    // FUNCIONES PARA EL MANTENEDOR PRODUCTO	   
    function ListarProductoLog($q, $inicio, $fin)
    {
        $ocado = new cado();
        $sql = "select p.*,c.nombre as categoria,if(p.tipo_producto=0,'PRODUCTO','SERVICIO') as tipo from log_producto p inner join log_categoria_producto c on c.id=p.id_categoria
         where p.nombre like '%$q%' and p.estado=0  order by p.nombre asc limit $inicio,$fin";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarProductoTipo($tipo)
    {
        $ocado = new cado();
        $sql = "select p.*,c.nombre as categoria from log_producto p inner join log_categoria_producto c on c.id=p.id_categoria
         where   p.estado=0 and p.tipo_producto='$tipo' order by p.nombre asc ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }



    function TotalProducto($q)
    {
        $ocado = new cado();

        $sql = "select * from log_producto where nombre like '%$q%' and estado=0 ";

        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarProductoLogxid($id)
    {
        $ocado = new cado();
        $sql = "select * from log_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarProductoLog($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from log_producto where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarProductoLog($nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_producto(nombre,id_categoria,unidad,stock_min,stock_max,tipo_producto,estado) "
                . "values('$nombre','$categoria','$unidad','$stock_min','$stock_max','$tipo_producto',0)";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //$return = $ex->getMessage();
        }

        return $return;
    }

    function ModificarProductoLog($id, $nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_producto set nombre = '$nombre',unidad= '$unidad',id_categoria='$categoria',stock_min='$stock_min',stock_max='$stock_max', "
                . "tipo_producto='$tipo_producto' where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarProductoLog($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_producto set estado=1 where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    // FUNCIONES PARA EL MANTENEDOR CATEGORÍA	   
    function ListarCategoriaProducto($q, $inicio, $fin)
    {
        $ocado = new cado();
        $sql = "select * from log_categoria_producto where  nombre like '%$q%' and estado=0 order by nombre asc limit $inicio,$fin";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function TotalCategoria($q)
    {
        $ocado = new cado();

        $sql = "select count(*) from log_categoria_producto where  nombre like '%$q%' and estado=0 ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarCategoriaProductoxid($id)
    {
        $ocado = new cado();
        $sql = "select * from log_categoria_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarCategoriaProducto($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from log_categoria_producto where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarCategoriaProducto($nombre)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_categoria_producto(nombre,estado) values('$nombre',0)";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //            $return= $ex->getMessage();
        }

        return $return;
    }

    function ModificarCategoriaProducto($id, $nombre)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_categoria_producto set nombre = '$nombre'  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarCategoriaProducto($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_categoria_producto set estado=1 where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    //FUNCIONES PARA ORDEN DE COMPRA

    function RegistrarOrdenCompra($detalles_orden_compra, $nro, $fecha, $sucursal, $almacen, $referencia, $tipo)
    {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $usuario = "kevin";
            $date = date('d-m-Y H:i:s');
            $sql = "insert into log_orden_compra(numero,fecha,id_sucursal,id_almacen,referencia,id_usuario,fecha_sistema,estado,tipo) "
                . "values('$nro','$fecha','$sucursal','$almacen','$referencia','$usuario','$date','pendiente','$tipo');";

            foreach ($detalles_orden_compra as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad = $detalle['cantidad'];
                $unidad = $detalle['unidad'];
                $despachado = $detalle['despachado'];
                $pendiente = $detalle['pendiente'];

                $sql .= "insert into log_orden_compra_detalle(id_orden_compra,id_producto,cantidad,unidad,despachado,pendiente)"
                    . "values((select max(id) from log_orden_compra),'$id_producto','$cantidad','$unidad','$despachado','$cantidad');";
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //            $return = $ex->getMessage();
        }

        return $return;
    }

    function ModificarOrdenCompra($id, $detalles_orden_compra, $nro, $fecha, $sucursal,  $almacen, $referencia, $tipo)
    {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $usuario = "kevin";
            $date = date('d-m-Y H:i:s');
            $sql = "update  log_orden_compra set numero='$nro' , fecha='$fecha', id_sucursal='$sucursal' , id_almacen='$almacen',"
                . "referencia='$referencia',id_usuario='$usuario',fecha_sistema='$date',tipo='$tipo' "
                . "where id='$id';  ";

            $sql .= " delete from log_orden_compra_detalle where id_orden_compra='$id'; ";

            foreach ($detalles_orden_compra as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad = $detalle['cantidad'];
                $unidad = $detalle['unidad'];
                $despachado = $detalle['despachado'];
                $pendiente = $detalle['pendiente'];

                $sql .= "insert into log_orden_compra_detalle(id_orden_compra,id_producto,cantidad,unidad,despachado,pendiente)"
                    . "values('$id','$id_producto','$cantidad','$unidad','$despachado','$cantidad');";
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            // $return = $ex->getMessage();
        }

        return $return;
    }

    function ValidarOrdenCompra($numero)
    {
        $ocado = new cado();
        $sql = "select count(*) from log_orden_compra where  numero='$numero' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarOrdenCompra($where)
    {
        $ocado = new cado();
        $sql = "select o.id,s.nombre,o.fecha,o.numero,a.nombre,o.estado,o.tipo from log_orden_compra o "
            . "  inner join cont_sucursal  s on s.id=o.id_sucursal  inner join log_almacen a"
            . " on a.id=o.id_almacen $where ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarOrdenCompraxId($id)
    {
        $ocado = new cado();
        $sql = "select * from log_orden_compra where id=$id ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function EstadoOrdenCompra($id, $estado)
    {

        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update  log_orden_compra set estado='$estado' where id='$id' ;";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function ListarOrdenComprDetalles($id)
    {
        $ocado = new cado();
        $sql = "select o.*,p.nombre from log_orden_compra_detalle o inner join log_producto p on p.id=o.id_producto where id_orden_compra=$id ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    //FUNCIONES PARA EL MANTENEDOR PROVEEDOR

    function ListarProveedor($q, $inicio, $fin)
    {
        $ocado = new cado();
        $sql = "select * from log_proveedor where  nombre like '%$q%' and estado='0' order by nombre asc limit $inicio,$fin";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function TotalProveedor($q)
    {
        $ocado = new cado();

        $sql = "select * from log_proveedor where  nombre like '%$q%' and estado='0' ";

        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarProveedorxid($id)
    {
        $ocado = new cado();
        $sql = "select * from log_proveedor where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function Validarproveedor($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from log_proveedor where nombre='$nombre' and estado='0'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function Registrarproveedor($nombre, $documento, $direccion, $contacto, $telefono, $email)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_proveedor(nombre,documento,direccion,contacto,telefono,email,estado) values('$nombre','$documento','$direccion','$contacto','$telefono','$email','0')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //            $return= $ex->getMessage();
        }

        return $return;
    }

    function Modificarproveedor($id, $nombre, $documento, $direccion, $contacto, $telefono, $email)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_proveedor set nombre ='$nombre' , direccion='$direccion',telefono='$telefono' ,email='$email',contacto='$contacto',documento='$documento' where id = '$id'";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //             $return= $ex->getMessage();
        }
        return $return;
    }

    function Eliminarproveedor($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_proveedor set estado='1'  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }


    //FUNCIONES PARA COMPRAS

    function RegistrarCompra(
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
    ) {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            //$usuario = $_SESSION['S_iduser'];
            $usuario = "1";
            $date = date('d-m-Y H:i:s');
            $sql = "insert into log_compra(fecha,id_usuario,id_proveedor,tipo_documento,tipo_afectacion,monto_sin_igv,igv,monto_igv,"
                . "total,nota_credito,fecha_sistema,tipo_compra,nro_documento,nro_dias) values('$fecha','$usuario','$proveedor',"
                . "'$tipo_documento','$tipo_afectacion',"
                . "'$monto_sin_igv','$igv','$monto_igv','$total','$nota_credito','$date','$tipo_compra','$nro_documento','$nro_dias');";

            foreach ($detalles_compra as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad_orden = $detalle['cantidad_orden'];
                $orden = $detalle['orden'];

                $cantidad = $detalle['cantidad'];
                $fecha_vencimiento = $detalle['fecha_vencimiento'];
                $bonificacion = $detalle['bonificacion'];
                $nro_lote = $detalle['nro_lote'];
                $precio_sin_igv = $detalle['precio_sin_igv'];
                $monto_igv = $detalle['monto_igv'];
                $subtotal = $detalle['subtotal'];
                $precio_anterior = $detalle['precio_anterior'];
                $id_lote = $this->LoteXnro_lote($nro_lote, $id_producto)->fetch();
                if ($id_lote[0] == '') {
                    $sql .= "insert into log_lote(nro,id_producto,cantidad,fecha_vencimiento)
                    values('$nro_lote','$id_producto','$cantidad','$fecha_vencimiento');";
                    $lote = "(select max(id) from log_lote)";
                } else {
                    $lote = $id_lote[0];
                    $sql .= "update log_lote set nro='$nro_lote',id_producto='$id_producto',cantidad+='$cantidad',
                    fecha_vencimiento='$fecha_vencimiento' where id=" . $id_lote[0] . ";";
                }


                $sql .= "insert into log_compra_detalle(id_compra,id_producto,bonificacion,id_lote,fecha_vencimiento,cantidad,"
                    . "precio_sin_igv,monto_igv,subtotal,precio_compra_ant)values((select max(id) from log_compra),'$id_producto',"
                    . "'$bonificacion',$lote,'$fecha_vencimiento','$cantidad',"
                    . "'$precio_sin_igv','$monto_igv','$subtotal','$precio_anterior');";
                if ($orden == '1') {
                    $sql .= "insert into log_orden_documento(id_orden_compra,id_producto,cant_orden,id_compra,cant_compra)
                            values('$id_orden','$id_producto','$cantidad_orden',(select max(id) from log_compra),'$cantidad');";

                    $sql .= "update log_orden_compra_detalle set despachado=despachado + $cantidad , pendiente=pendiente-$cantidad 
                        where id_orden_compra='$id_orden'  and id_producto='$id_producto' ;";
                }
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = "OK";
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //$return = $ex->getMessage();
        }

        return $return;
    }


    function ListarCompra($q, $inicio, $fin)
    {
        $ocado = new cado();
        $sql = "select c.fecha,u.user,prov.nombre,c.tipo_documento,ta.descripcion,c.monto_sin_igv,c.igv,c.monto_igv,"
            . "c.total ,c.id,c.nota_credito,c.fecha_sistema,c.tipo_compra,c.nro_documento,c.nro_dias from log_compra c inner join conf_usuario u on c.id_usuario=u.id inner join"
            . " admin_tipo_afectacion_igv ta on ta.id=c.tipo_afectacion inner join log_proveedor prov on prov.id=c.id_proveedor where c.nro_documento like '%$q%' order by c.fecha desc limit $inicio,$fin ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function TotalCompra($q)
    {
        $ocado = new cado();

        $sql = "select count(*) from log_compra c inner join conf_usuario u on c.id_usuario=u.id inner join"
            . " admin_tipo_afectacion_igv ta on ta.id=c.tipo_afectacion where c.nro_documento like '%$q%' ";


        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    // FUNCIONES PARA EL MANTENEDOR COMPRA_ETALLES

    function ListarCompraDetalles($compra)
    {
        $ocado = new cado();
        $sql = "select p.nombre,c.*,l.nro from log_compra_detalle c inner join log_producto p on c.id_producto=p.id inner join log_lote l on l.id=c.id_lote where id_compra=$compra";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
    function UltimaPrecioCompra($id)
    {
        $ocado = new cado();
        $sql = "SELECT * from  log_compra_detalle where id_producto=$id";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
    // FUNCIONES PARA EL MANTENEDOR LOTE
    function ListarLote($nombre,$inicio,$fin)
    {
        $ocado = new cado();
        $sql = "SELECT l.nro,p.nombre,l.cantidad,DATE_FORMAT(l.fecha_vencimiento, '%d-%m-%Y') as fecha_vencimiento from log_lote l inner join log_producto p on l.id_producto=p.id "
            . "where l.nro like '%$nombre%' or p.nombre like '%$nombre%' or l.fecha_vencimiento like '%$nombre%' order by p.id desc limit $inicio,$fin  ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function TotalLote($nombre)
    {
        $ocado = new cado();
        $sql = "SELECT count(*) from log_lote l inner join log_producto p on l.id_producto=p.id "
            . "where l.nro like '%$nombre%' or p.nombre like '%$nombre%' or l.fecha_vencimiento like '%$nombre%'  ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarLotexid($id)
    {
        $ocado = new cado();
        $sql = "select * from log_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function LoteXnro_lote($nro_lote, $id_producto)
    {
        $ocado = new cado();
        $sql = "select id from log_lote where  nro='$nro_lote' and id_producto='$id_producto' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarLote($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from log_producto where nombre='$nombre' and estado='0'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }


  // FUNCIONES PARA EL MANTENEDOR ORDEN DOCUMENTO
  function ListarOrdDoc($nombre,$inicio,$fin)
  {
      $ocado = new cado();
      $sql = "SELECT p.nombre,oc.numero,l.cant_orden,c.tipo_documento,c.nro_documento,l.cant_compra from log_orden_documento l 
      inner join log_producto p on l.id_producto=p.id inner join log_orden_compra oc on l.id_orden_compra=oc.id
       inner join log_compra c on l.id_compra=c.id "
    . "where  p.nombre like '%$nombre%' or c.nro_documento like '%$nombre%' or oc.numero like '%$nombre%' order by l.id desc limit $inicio,$fin  ";
      $ejecutar = $ocado->ejecutar($sql);
      return $ejecutar;
  }

  function TotalOrdDoc($nombre)
  {
      $ocado = new cado();

      $sql = "SELECT count(*) from log_orden_documento l inner join log_producto p on l.id_producto=p.id 
      inner join log_orden_compra oc on l.id_orden_compra=oc.id inner join log_compra c on l.id_compra=c.id "
      . "where  p.nombre like '%$nombre%' or c.nro_documento like '%$nombre%' or oc.numero like '%$nombre%' order by l.id desc  ";
  
      $ejecutar = $ocado->ejecutar($sql);
      return $ejecutar;
  }


}
