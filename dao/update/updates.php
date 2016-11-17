<?php
$sentenciaUpdateUsuario = "UPDATE usuario set LOGON = ?, NOMBRE = ?, APELLIDO= ?, ROLE_ID= ?, PASSWORD=? WHERE USUARIO_ID = ?";
$sentenciaUpdateProducto = "UPDATE detalle SET DESCRIPCION = ?, PRECIO =? WHERE DETALLE_ID=? AND TIPO_ID = ?";
$sentenciaUpdateImpresoras = "UPDATE impresoras set modelo=?, edificio=?,ubicacion=?, fecha=STR_TO_DATE(?, '%d/%m/%Y %r'), serie=?, numero=? where impresora_id=?";
$sentenciaEstadoSolicitud = "UPDATE solicitud SET STATUS_ID=? WHERE SOLICITUD_ID = ?";
$sentenciaEstadoSolicitudPlantilla = "UPDATE solicitud SET STATUS_ID=?, usuario_plantilla=? WHERE SOLICITUD_ID = ?";
$sentenciaActualizaEstado = "UPDATE trabajo set status_id = ? where solicitud_id = ? and trabajo_id = 1";
$sentenciaUpdateTrabajoSubtotal = "UPDATE trabajo SET PrecioByN = ?, PrecioColor = ?, PrecioEncuadernacion = ?, PrecioVarios = ?, PrecioEspiral = ?, PrecioEncolado = ?, PrecioVarios1 = ?, PrecioVarios2 = ?  WHERE trabajo_id = ? AND solicitud_id = ?";
$sentenciaUpdateSubDepartamento = "update subdepartamento set subdepartamento_desc = ?, treintabarra = ? where departamento_id = ? and subdepartamento_id = ?";
$sentenciaUpdateDepartamento = "UPDATE departamento SET DEPARTAMENTOS_DESC = ?, ceco=? WHERE DEPARTAMENTO_ID = ?";
$sentenciaUpdateTrabajoDetalle = "UPDATE trabajodetalle SET UNIDADES=?,PRECIOTOTAL=? WHERE SOLICITUD_ID = ? AND TRABAJO_ID = ? AND TIPO_ID = ? AND DETALLE_ID = ?";
$sentenciaCierreSolicitud = "UPDATE solicitud SET STATUS_ID=? WHERE SOLICITUD_ID = ?";
$sentenciaUpdatePassword = "UPDATE usuario SET PASSWORD=? WHERE LOGON=?";
$sentenciaUpdateGastosImpresoraByN = "UPDATE gastos_impresora set byn_unidades = ?,  byn_precio = ?, byn_total = ? where departamento_id=? and  YEAR(periodo) = ? and MONTH(periodo) = ?";
$sentenciaUpdateGastosImpresoraColor = "UPDATE gastos_impresora set color_unidades = ?, color_precio = ?, color_total = ? where departamento_id=? and  YEAR(periodo) = ? and MONTH(periodo) = ?";
$sentenciaUpdateGastosMaquinaByN = "UPDATE gastos_maquina set byn_unidades = ?,  byn_precio = ?, byn_total = ? where departamento_id=? and YEAR(periodo) = ? and MONTH(periodo) = ?";
$sentenciaUpdateGastosMaquinaColor = "UPDATE gastos_maquina set color_unidades = ?, color_precio = ?, color_total = ? where departamento_id=? and YEAR(periodo) = ? and MONTH(periodo) = ?";

?>