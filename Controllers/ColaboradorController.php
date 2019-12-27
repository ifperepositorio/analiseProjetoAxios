<?php
namespace Controllers;

use \Core\Controller;
use Models\Colaborador;


class ColaboradorController extends Controller {


    private $arrayInfo;
    private $col;

    public function __construct()
    {
        $this->col = new Colaborador();

        if (!$this->col->isLogged()){
            header("Location:".BASE_URL."login");
            exit;
        }
        //impede o acesso pela url se o cara não tem permissão
        if (!$this->col->temPermissao('cad_colaborador')) {
            header("Location:".BASE_URL);
            exit;
        }


    }

    public function index() {

            $this->arrayInfo = array(
                'colaborador' => $this->col
            );

            $col = new Colaborador();

            $this->arrayInfo['list'] = $col->getAllItems();

            $this->arrayInfo['listGroups'] = $col->getGroups();

            $this->loadTemplate('colaborador_add', $this->arrayInfo);

        }

    public function save() {

        try {
            $col = new Colaborador();
            $post = $_POST ?? null;
            $data = $this->obj($post);

            if ($col->salvar($data))
                echo json_encode(["success" => true, "message" => "Salvo com sucesso", "data" => $data]);


        }catch (\Exception $e){
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function edit($id){
        $col = new Colaborador();

        $this->arrayInfo = array(
            'colaborador' => $this->col

        );

        $this->arrayInfo['permissaoList'] = $col->listaPermissao();

        $this->arrayInfo['info'] = $col->get($id);

        if(!empty($id)){

            $this->loadTemplate('colaborador_edit', $this->arrayInfo);
        }else{
            header("Location:".BASE_URL."colaborador");
            exit;
        }
    }

    public function edit_action($id){
        try {

            $col = new Colaborador();

            $this->arrayInfo = array(
                'colaborador' => $this->col
    
            );
            
            $post = $_POST ?? null;
            $data = $this->obj($post);
            

            $result = $col->update($data);

            echo json_encode([
                "success" => true, 
                "message" => "Salvo com sucesso", 
                "data" => $data
            ]);
        }
        catch (\Exception $e)
        {
            echo json_encode([
                "success" => false, 
                "message" => $e->getMessage()
            ]);
        }

    }

    public function del($id){

        if (!empty($id)){
            $col = new Colaborador();

            if ($col->delete($id)){
                $_SESSION['sucMsg'] = 'Colaborador excluido com sucesso';
                header("Location: ".BASE_URL."colaborador");
                exit;
            }
        }else{
            header("Location: ".BASE_URL."colaborador");
            exit;
        }
    }

    public function obj($post){
        $request = new \stdClass();

        foreach ($post as $k => $v){
            $request->$k = $v;
        }

        return $request;
    }


}
