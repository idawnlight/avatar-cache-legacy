<?php
    /**
     * XPHP Project
     * By xtl
     * 
     */
    
    namespace Controller\Home;
    
    use X\Controller;
    use X\Log;
    
    class IndexController extends Controller {
        public function index($req){

            $data = array(
                "Node" => $this->app->config["Node"],
                "Version" => $this->app->config["Avatar_Version"]
            );
            
            //$model = $this->model("Home/IndexModel");

            //var_dump($model->where("name", "testname")->findOne()->value);
            
            return $this->view("Home/Index", $data);
            
        }
        
    }
    