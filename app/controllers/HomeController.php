<?php

class HomeController extends Controller {
    public function index() {
        
        $userModel = $this->model('User');
        $data = [
            'title' => 'MyMVC',
            'users' => $userModel->getUsers()
        ];
        //print_r($data);
        //$this->redirect('form');
        $this->view('home', $data);
    }

    public function blog(){
        echo "this blog page";
    }
}