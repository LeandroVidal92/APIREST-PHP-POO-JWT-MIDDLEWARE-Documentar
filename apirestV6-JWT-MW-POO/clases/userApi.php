<?php
require_once 'user.php';
require_once 'iUserApi';

class userApi extends user implements IUserApi
{

public function TraerUno($request,$response,$args)
{
	//Obtengo el Id por el cual filtramos
	$id=$args['id'];
	//utilizamos el metodo de la clase
	$user=user::TraerUnUser($id);
	//Desencripto Pass
	$user->Pass= base64_decode ($user->Pass);
	//si no encontro informamos que no existio y mandamos un 500 para detectar error
	if(!$user)
	{
		$obj= new stdclass();
		$obj->error= "el usuario no existe";
		$Respuesta=$response->withJson($obj,500);



	}
	else
	{
		//si encuentra lo devolvemos a travez del medotodo withJson del Response
		$Respuesta= $response->withJson($user,200);

	}
	return $Respuesta; 
}


public function TraerTodos($request,$response,$args)
{

	$todosLosUsers= user::TraerTodoLosUser();
	foreach ($todosLosUsers as  $user) {
		$user->Pass= base64_decode ($user->Pass);
	}
	$Respuesta= $response->withJson($todosLosUsers,200);
	return $Respuesta;

}

public function CargarUno($request,$response,$args)
{
	//Creamos un objeto standard
	$obj= new stdclass();
	//con el metodo getparsedbody traemos todos los elementos que nos envian en el cuerpo del post
	$ArrayDeParametros=$request->getParsedBody();
	//var_dump(json_decode($ArrayDeParametros));
	//asignamos los valores a variables
	$Nombre=$ArrayDeParametros['Nombre'];
	$Apellido=$ArrayDeParametros['Apellido'];
	$Mail=$ArrayDeParametros['Mail'];
	$Pass=$ArrayDeParametros['Pass'];
	//encripto Pass
	//$Pass=md5($pass);
	$Pass = base64_encode ($Pass);
	$Habilitado=$ArrayDeParametros['Habilitado'];
	$Usuario=$ArrayDeParametros['Usuario'];
	//generamos instancia de user
	$user = new user();
	//asignamos valores
	$user->Nombre=$Nombre;
	$user->Apellido=$Apellido;
	$user->Mail=$Mail;
	$user->Pass=$Pass;
	$user->Habilitado=$Habilitado;
	$user->Usuario=$Usuario;
	//utilizamos metodo
	$user->InsertarUser();
	//nose para que sirve
	$archivos = $request->getUploadedFiles();
	//respuesta
	$obj->respuesta="Guardo el Usuario";
	//devolvemos obj respuesta y 200 de todo ok
	return $response->WithJson($obj,200);


}

Public function BorrarUno($request,$response,$args)
{
//Objeto Standar
$obj= new stdclass();
//tomo parametro del body que recibo
$ArrayDeParametros= $request->getParsedBody();
//genero variable id
$_id=$ArrayDeParametros['id'];
//instancia user
$user= new user();
$user->Id=$_id;
//metodo que borra usuario y me devuelve >0 si borro
$Borrados=$user->BorrarUser();
$obj->cantidad=$Borrados;
if($Borrados>0)
{
$obj->resultado="Eliminado";
}
else
($obj->resultado="No Elimino Nada");
//devuelvo respuesta y 200
$Rta= $response->withJson($obj,200);
return $Rta;

}


}







  ?>