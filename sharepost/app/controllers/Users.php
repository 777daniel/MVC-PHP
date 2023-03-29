<?php
     class Users extends Controller {
        //private $userModel;
        public function __construct(){
        
        }
        public function register(){
            if($_SERVER['REQUEST_METHOD'] =='POST'){

                //die('SUCCESS');
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'name'=>trim($_POST['name']),
                    'email'=>trim($_POST['email']),
                    'password'=>trim($_POST['password']),
                    'confirm_password'=>trim($_POST['confirm_password']),
                    'name_err'=>'',
                    'email_err'=>'',
                    'password_err'=>'',
                    'confirm_password_err'=>''
                ];

                if(empty($data['email'])){
                    $data['email_err']='Please enter email';
                }else{
                    
                    if($this->model('User')->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                      }

                }

                if(empty($data['name'])){
                    $data['name_err']='Please enter name';
                }

                if(empty($data['password'])){
                    $data['password_err']='Please enter password';
                }elseif(strlen($data['password'])<6){
                    $data['password_err']='minimum 6 characters needed';
                }

                if(empty($data['confirm_password'])){
                    $data['confirm_password_err']='Please re-enter password';
                }else{
                    if($data['password']!=$data['confirm_password']){
                        $data['confirm_password_err']='password do not match';
                    }
                }

                if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                   $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                   if($this->model('User')->register($data)){
                    flash('register_success',"Registration is successful");
                    redirect('users/login');
                   }
                }
                else{
                    $this->view('register/index',$data);
                }
            }
            else{
                //echo 'load form';
                $data=[
                    'name' =>'',
                    'email' =>'',
                    'password'=>'',
                    'confirm_password'=>'',
                    'name_err'=>'',
                    'email_err'=>'',
                    'password_err'=>'',
                    'confirm_password_err'=>''

                ];

                $this->view('register/index',$data);
            }
        }
        public function login(){
            if($_SERVER['REQUEST_METHOD'] =='POST'){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                   
                    'email'=>trim($_POST['email']),
                    'password'=>trim($_POST['password']),
                    'email_err'=>'',
                    'password_err'=>'',
                   
                ];

                if(empty($data['email'])){
                    $data['email_err']='Please enter email';
                }

                if(empty($data['password'])){
                    $data['password_err']='Please enter password';
                }elseif(strlen($data['password'])<6){
                    $data['password_err']='minimum 6 characters needed';
                }

                if($this->model('User')->findUserByEmail($data['email'])){

                }else{
                    $data['email_err'] = 'No user found';
                }

                if(empty($data['email_err']) && empty($data['password_err'])){
                    //die('SUCCESS');
                    $loggedInUser= $this->model('User')->login($data['email'],$data['password']);

                    if($loggedInUser){
                        $this->sessionCreate($loggedInUser);
                    }else{
                        $data['password_err']='Password incorrect';
                        $this->view('login/index',$data);
                    }
                }
                else{
                    $this->view('login/index',$data);
                }
                
            }
            else{
                //echo 'load form';
                $data=[
                    
                    'email' =>'',
                    'password'=>'',
                    'email_err'=>'',
                    'password_err'=>'',
                    

                ];

                $this->view('login/index',$data);
            }
        }
        public function sessionCreate($user){
            $_SESSION['user_id']= $user->id;
            $_SESSION['user_name']= $user->name;
            $_SESSION['user_email']= $user->email;

            redirect('posts/index');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            session_destroy();
            redirect('Users/login');

        }
     }