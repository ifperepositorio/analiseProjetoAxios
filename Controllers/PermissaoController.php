<?php
namespace Controllers;

use \Core\Controller;
use Models\Colaborador;
use Models\Permissao;


class PermissaoController extends Controller {

    private $arrayInfo;
    private $col;

    public function __construct()
    {
        $this->col = new Colaborador();

        if (!$this->col->isLogged()){
            header("Location:".BASE_URL."login");
            exit;
        }

        if (!$this->col->temPermissao('cad_permissoes')) {
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function index() {
            $this->arrayInfo = array(
                'colaborador' => $this->col,
                'list' => array()
            );

            $p = new Permissao();
            $this->arrayInfo['list'] = $p->getAllGroups();


            $this->loadTemplate('permissao', $this->arrayInfo);
	}

	public function del($id_group){
         $p = new Permissao();

        $p->canDeleteGroup($id_group);

            header("Location:".BASE_URL.'permissao');
            exit;

    }

    public function add(){
        $this->arrayInfo = array(
            'colaborador' => $this->col,
            'errorItems' => array()

        );

        $p = new Permissao();

        $this->arrayInfo['permission_items'] = $p->getAllItems();

        if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
             $this->arrayInfo['errorItems'] = $_SESSION['formError'];
             unset($_SESSION['formError']);
        }

        $this->loadTemplate('permissions_add', $this->arrayInfo);
    }

    public function add_action(){

        $p = new Permissao();

        if(!empty($_POST['name'])){
            $nome = addslashes($_POST['name']);
            $id = $p->addGroup($nome);

            if (isset($_POST['items']) && count($_POST['items']) > 0){

                $items = $_POST['items'];

                foreach ($items as $item){
                  $p->linkItemToGroup($item, $id);
                }
            }
            echo "Adiciionado com sucesso ".$_POST['name'];
            header("Location: ".BASE_URL.'permissao');
            exit;
        }else{
            $_SESSION['formError'] = array('name');
            header("Location: ".BASE_URL.'permissao/add');
            exit;
        }

    }

    public function edit($id){

        if (!empty($id)){
            $this->arrayInfo = array(
                'colaborador' => $this->col,
                'errorItems' => array()

            );

            $p = new Permissao();

            $this->arrayInfo['permission_items'] = $p->getAllItems();
            $this->arrayInfo['permission_id'] = $id;
            $this->arrayInfo['permission_group_name'] = $p->getPermissionGroupName($id);
            $this->arrayInfo['permission_group_slugs'] = $p->getPermissions($id);

            if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){
                $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                unset($_SESSION['formError']);
            }

            $this->loadTemplate('permissions_edit', $this->arrayInfo);
        }else{
            header("Location: ".BASE_URL.'permissao');
            exit;
        }

    }

      public function edit_action($id){

        if (isset($id)){
            $p = new Permissao();

            if(!empty($_POST['name'])){
                $nome = addslashes($_POST['name']);

                $p->editName($nome, $id);

                $p->clearLinks($id);

                if (isset($_POST['items']) && count($_POST['items']) > 0){

                    $items = $_POST['items'];

                    foreach ($items as $item){
                        $p->linkItemToGroup($item, $id);
                    }
                }
                //adicionou com sucesso
                header("Location: ".BASE_URL.'permissao');
                exit;
            }else{
                $_SESSION['formError'] = array('name');
                header("Location: ".BASE_URL.'permissao/edit/'.$id);
                exit;
            }

        }else{
            header("Location: ".BASE_URL.'permissao');
            exit;
        }
   }

}