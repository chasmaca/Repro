<?php

$borradoDepartamento = "DELETE FROM departamento WHERE departamento_id = ?";
$borrarUsuarioDepartamento = "DELETE FROM usuariodepartamento where usuario_id = ?";
$borrarImpresora = "DELETE FROM impresoras where impresora_id = ?";
$borrarSubdepartamento = "delete from subdepartamento where departamento_id = ? and subdepartamento_id = ?";
$sentenciaBorradoProducto = "DELETE FROM detalle WHERE DETALLE_ID=? AND TIPO_ID = ?";
$sentenciaBorradoUsuario = "DELETE FROM usuario WHERE USUARIO_ID = ?";
?>