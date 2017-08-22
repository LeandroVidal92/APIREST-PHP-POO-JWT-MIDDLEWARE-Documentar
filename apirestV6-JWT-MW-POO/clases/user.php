<?php 

class user

{
	public $Id;
	public $Nombre;
	public $Apellido;
	public $Mail;
	public $Pass;
	public $Habilitado;
	public $Usuario;

  //ALTA USUARIO
	 public function InsertarUser()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (Nombre,Apellido,Mail,Pass,Habilitado,Usuario)values('$this->Nombre','$this->Apellido','$this->Mail','$this->Pass','$this->Habilitado','$this->Usuario')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }
  //BAJA USUARIO
 	public function BorrarUser()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from cds 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

  //MODIFICA USUARIO
	public function ModificarUser()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update cds 
				set titel='$this->titulo',
				interpret='$this->cantante',
				jahr='$this->año'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	


  //TRAE TODOS LOS USUARIO
  	public static function TraerTodoLosUser()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select Id,Nombre,Apellido,Mail,Pass,Habilitado,Usuario from Usuario ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "user");		
	}
  //TRAE UN  USUARIO
	public static function TraerUnUser($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,Nombre,Apellido,Mail,Pass,Habilitado,Usuario from Usuario where id = $id");
			$consulta->execute();
			$unuser= $consulta->fetchObject('user');
			return $unuser;				

			
	}

	

}




 ?>