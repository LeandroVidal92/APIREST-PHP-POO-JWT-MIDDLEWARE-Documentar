<?php
require_once 'user.php';
require_once 'iUserApi';

class userApi extends user implements IUserApi
{

public function TraerUno($request,$response,$args)
{
	$id=$args['id'];
	$user=user::TraerUnUser($id);
	if(!$user)
	{
		$obj= new stdclass();
		$obj->error= "el usuario no existe";
		$Respuesta=$response->withJson($obj,500);



	}
	else
	{
		$Respuesta= $response->withJson($user,200);

	}
	return $Respuesta; 
}


public function TraerTodos($request,$response,$args)
{
	$todosLosUsers= user::TraerTodoLosUser();
	$Respuesta= $response->withJson($todosLosUsers,200);
	return $Respuesta;

}

}







  ?>