<?php
namespace Models;

use \Core\Model;

class Colaborador extends Model {

    private $uid;
    private $permissao;

  public function isLogged(){
      if(!empty($_SESSION['token'])){
          $token = $_SESSION['token'];

          $sql = "SELECT id, id_permission from colaborador WHERE token = :token";
          $sql = $this->db->prepare($sql);
          $sql->bindValue(':token', $token);
          $sql->execute();

          if ($sql->rowCount() > 0){
              $p = new Permissao();

              $data = $sql->fetch();

              $this->uid = $data['id'];




              //get the permissions for this user
              $this->permissao = $p->getPermissions($data['id_permission']);



              //print_r($this->permissao); exit;
              return true;
          }

      }

      return false;
  }

    public function temPermissao($permissao_slug){
        if (in_array($permissao_slug, $this->permissao)){
            return true;
        }else{
            return false;
        }
    }

  public function validateLogin($email, $senha)
  {
      try {
          $sql = "SELECT id FROM colaborador WHERE email = :email AND senha = :senha ";
          $sql = $this->db->prepare($sql);
          $sql->bindValue(':email', $email);
          $sql->bindValue(':senha', $senha);
          $sql->execute();


          if ($sql->rowCount() > 0) {

              $data = $sql->fetch();
              $token = md5(time() . rand(0, 999) . $data['id'] . time());

              $sql = "UPDATE colaborador SET token = :token WHERE id = :id";
              $sql = $this->db->prepare($sql);
              $sql->bindValue(':token', $token);
              $sql->bindValue(':id', $data['id']);
              $sql->execute();

              $_SESSION['token'] = $token;

              return true;
          }
          }catch(\PDOException $e){
          $e->getMessage();
          return false;
     }

  }

  public function salvar($data){
      try {

          $sql = "INSERT INTO colaborador (nome, email, senha, atendente, unidade, id_permission) VALUES (:nome, :email, :senha, :atendente, :unidade, :id_permission)";
          $sql = $this->db->prepare($sql);
          $sql->bindValue(':nome', $data->nome);
          $sql->bindValue(':email', $data->email);
          $sql->bindValue(':senha', $data->senha);
          $sql->bindValue(':atendente', $data->atendente);
          $sql->bindValue(':unidade', $data->unidade);
          $sql->bindValue(':id_permission', $data->nivel);
          return  $sql->execute();

      }catch(\PDOException $e){
          $e->getMessage();
      }

      return false;
  }

  public function getGroups(){
      $array = array();

      $sql = "SELECT * FROM permission_groups";
      $sql= $this->db->query($sql);
      $sql->execute();

      if ($sql->rowCount() > 0){
          $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
      }
      return $array;
  }

  public function getAllItems(){
      $array = array();

      $sql = "SELECT * FROM colaborador ORDER BY nome desc";
      $sql = $this->db->query($sql);
      $sql->execute();

      if ($sql->rowCount() > 0){
          $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
      }

      return $array;
  }

  public function get($id){
       $array = array();

          $sql = "SELECT id, nome, email, senha, atendente, unidade, id_permission FROM colaborador WHERE id = :id";
          $sql = $this->db->prepare($sql);
          $sql->bindValue(':id', $id);
          $sql->execute();

          if ($sql->rowCount() > 0){
              $array = $sql->fetch(\PDO::FETCH_ASSOC);
          }

          return $array;
  }

    public function listaPermissao(){
        $array = array();

        $sql = "SELECT * FROM permission_groups";
        $sql = $this->db->query($sql);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

  public function update($data){

        $sql = "UPDATE colaborador 
                   SET nome          = :nome, 
                       email         = :email, 
                       atendente     = :atendente,
                       unidade       = :unidade, 
                       id_permission = :id_permission  
                 WHERE id = :id";
        
        $sql = $this->db->prepare($sql);

        $sql->bindValue(':nome', $data->nome);
        $sql->bindValue(':email', $data->email);
        $sql->bindValue(':atendente', $data->atendente);
        $sql->bindValue(':unidade', $data->unidade);
        $sql->bindValue(':id_permission', $data->id_permission);
        $sql->bindValue(':id', $data->id);

        return  $sql->execute();
  }

  public function delete($id){

      try {
          $sql = "DELETE FROM  colaborador WHERE  id = :id";
          $sql = $this->db->prepare($sql);
          $sql->bindValue(':id', $id);
          $sql->execute();
          return true;
      }catch (\PDOException $e){
          $e->getMessage();
          return false;
      }
  }


  public function getId(){
      return $this->uid;
  }

}