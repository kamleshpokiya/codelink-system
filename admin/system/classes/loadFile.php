<?php
class loadFile
{
    public function view($viewName, $data = [])
    {
         if (file_exists("../application/views/" . $viewName . ".php")) {
            include "../application/views/header.php";
            include "../application/views/sidebar.php";
            require_once "../application/views/$viewName.php";
            include "../application/views/footer.php";
        } else {
            include "../application/views/error.php";
        }
    }
    public function single_view($page, $data = []){
        if (file_exists("../application/views/" . $page . ".php")) {
            require_once "../application/views/$page.php";
        }
        else {
            include "../application/views/error.php";
        }
    }
    public function model($model)
    {
        if (file_exists("../application/model/" . $model . ".php")) {
            require_once "../application/model/$model.php";
            return new $model;
        } else {
            echo "$model this model not exist";
        }
    }
    
}
