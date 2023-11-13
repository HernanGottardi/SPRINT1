<?php
interface IUsuarios
{
	public function listarUsuarios($request, $response, $args) ;
	public function altaUsuario($request, $response, $args);
	public function BorrarUsuario($request, $response, $args);
	public function ModificarUsuario($request, $response, $args);
}

?>
