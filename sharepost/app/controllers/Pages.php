<?php
  class Pages extends Controller {
    private $postModel;
    public function __construct(){
      //echo 'Pages loaded';
      //$this->postModel =$this->model("Post");
    }
    public function index(){

      if(isLoggedIn()){
        redirect('posts/index');
      }
      //$posts= $this->postModel->getPosts();
        $data= [
          'title' => 'Sharepost',
          
        ];
        $this->view('pages/index',$data);
        //echo "hei";
    }
    public function about(){

      //echo $id;
      $data= [
        'title' => 'About us',
        'des'=> 'App to share images'
      ];
      $this->view('about/about',$data);

    }
  }