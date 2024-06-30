<?php
    require_once "conexion.php";
    class Entradas extends Conexion { 
      public function insertarProductos($datos){
        try {
            $sql = "call insertarProductos(?,?,?,?)";
            $query = Conexion::getConexion()->prepare($sql); 
            $query-> bindParam(1, $datos['codigo'],PDO::PARAM_STR);
            $query-> bindParam(2, $datos['producto'],PDO::PARAM_STR);
            $query-> bindParam(3, $datos['precio'],PDO::PARAM_STR);
            $query-> bindParam(4, $datos['imagen'],PDO::PARAM_STR);
        
            return $query->execute();
        } catch(PDOException $ex) {
            echo "Error al insertar los datos: " . $ex->getMessage();
           
        }
        finally{
          $query==null; 
        }
     }

             public function actualizarProductos($datos){
            try{ 
              $sql="call actualizarProductos(?,?,?)";
              $query=Conexion:: getConexion()-> prepare($sql); 
              $query-> bindParam(1, $datos['codigo'],PDO::PARAM_STR);
              $query-> bindParam(2, $datos['producto'],PDO::PARAM_STR);
              $query-> bindParam(3, $datos['precio'],PDO::PARAM_STR);
               return $query->execute();
             }
              catch(PDOException $ex){
              echo"Error al actualizar los datos". $ex ->getMessage();
            }
            finally{
              $query==null; 
            }
          }


    public function eliminarProductos($datos){
      try{ 
        $sql="call eliminarProductos(?)";
        $query=Conexion:: getConexion()-> prepare($sql); 
      
        $query-> bindParam(1, $datos,PDO::PARAM_STR);
         return $query->execute();
    }
    catch(PDOException $ex){
      echo"Error al eliminar los datos". $ex ->getMessage();
  }
  finally{
    $query==null; 
  }
}
public function listarProductos(){
  try{ 
    $sql="call listarProductos()";
    $query=Conexion::getConexion()-> prepare($sql); 
    $query->execute();
     return $query->fetchAll(); //lams a todos los parametros
}
catch(PDOException $ex){
  echo"Error al listar los datos". $ex ->getMessage();
}
  finally{
      $query == null; 
  }
}
public function listardetalle(){
  try{ 
    $sql="call listardetalle()";
    $query=Conexion::getConexion()-> prepare($sql); 
    $query->execute();
     return $query->fetchAll(); 
}
catch(PDOException $ex){
  echo"Error al listar los datos". $ex ->getMessage();
}
  finally{
      $query == null; 
  }
}
public function listartotal(){
  try{ 
    $sql="call listartotal()";
    $query=Conexion::getConexion()-> prepare($sql); 
    $query->execute();
     return $query->fetchAll(); 
}
catch(PDOException $ex){
  echo"Error al listar los datos". $ex ->getMessage();
}
  finally{
      $query == null; 
  }
}
public function obtenerId($codigo){
    try{
      $sql="call obtenerId(?)";
      $query=Conexion::getConexion()->prepare($sql);
      $query->bindParam(1,$codigo,PDO::PARAM_STR);
      $query->execute();
      return $query->fetch(); // llamas a solo uno 
    }
    catch(PDOException $ex){
      echo"Error al obtener los datos". $ex ->getMessage();
    }
      finally{
          $query == null; 
      }
}


  }
?>