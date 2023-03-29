<?php
    class Posts extends Controller {

        public function __construct(){
            if(!isLoggedIn()){
                redirect('pages/index');
            }

   
        }
        public function index(){

            $posts= $this->model('Post')->getPosts();
            //var_dump($posts);
            $data=[
                'posts' => $posts
            ];
            $this->view('posts/index',$data);

        }
        public function add(){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                //die("ggg");
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'title'=>trim($_POST['title']),
                    'body'=>trim($_POST['body']),
                    'user_id'=> $_SESSION['user_id'],
                    'title_err'=>'',
                    'body_err'=>''
                ];

                if(empty($data['title'])){
                    $data['title_err']= 'Please enter title';

                }
                if(empty($data['body'])){
                    $data['body_err']= 'Please enter body';

                }

                if(empty($data['title_err'])&& empty($data['body_err'])){
                   if($this->model('Post')->addPost($data)){
                    
                    
                    
                    redirect('posts');
                    flash('post_message', 'Post added');
                   }
                   else{
                    die('Something went wrong');
                   }
                }else{
                    $this->view('posts/add',$data);
                }
            
            }else{
                $data=[
                    'title'=>'',
                    'body'=>''
                ];
                $this->view('posts/add',$data);
            }
           
            
        }

        public function show($id){
            $post= $this->model('Post')->getPostById($id);
            $user= $this->model('User')->getUserById($post->user_id);
            $data=[
                'post'=>$post,
                'user'=>$user
            ];
            $this->view('posts/show',$data);
        }

        public function edit($id){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                //die("ggg");
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'id'=>$id,
                    'title'=>trim($_POST['title']),
                    'body'=>trim($_POST['body']),
                    'user_id'=> $_SESSION['user_id'],
                    'title_err'=>'',
                    'body_err'=>''
                ];

                if(empty($data['title'])){
                    $data['title_err']= 'Please enter title';

                }
                if(empty($data['body'])){
                    $data['body_err']= 'Please enter body';

                }

                if(empty($data['title_err'])&& empty($data['body_err'])){
                   if($this->model('Post')->updatePost($data)){
                    
                    redirect('posts');
                    flash('post_message', 'Post updated');
                   }
                   else{
                    die('Something went wrong');
                   }
                }else{
                    $this->view('posts/edit',$data);
                }
            
            }else{
                $post=$this->model('Post')->getPostById($id);

                //check for owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                $data=[
                    'id'=>$id,
                    'title'=> $post->title,
                    'body'=>$post->body
                ];
                $this->view('posts/edit',$data);
            }
           
            
        }

        public function delete($id){
            if($_SERVER['REQUEST_METHOD']=='POST'){

                $post=$this->model('Post')->getPostById($id);

                //check for owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }
                if($this->model('Post')->deletePost($id)){
                    flash('post_message','Post removed');
                    redirect('posts');
                }else{
                    die("Something went wrong");
                }}
            else{ 
                redirect('posts');
            
            }
                
            }
        


       
    }
    