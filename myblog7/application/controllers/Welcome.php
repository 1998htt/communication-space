<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
        $this->load->model('article_model');
        $results = $this->article_model->get_all_articles();
        if($results){
            $this->load->view('home_page',array(
                'results'=>$results,
            ));

        }
    }
	public function user_home_page()
	{
	    //查文章
	    $loginUser= $this ->session ->userdata('loginUser');
        $this -> load -> model('article_model');//加载model文件
        $articles = $this -> article_model ->get_articles_by_user($loginUser->user_id);
        $types = $this -> article_model ->get_types_by_user($loginUser->user_id);
        $this ->load ->view('index',array(
            'articles'=>$articles,
            'types'=>$types
        ));
//        $this->load->view('index');
	}
    public function login()
    {
        $this->load->view('login');
    }
    public function logout()
    {
        $this -> session -> unset_userdata('loginUser');
        $this->load->view('login');
    }
    public function check_login()
    {
       $username =  $this->input->get('username');
       $password =  $this->input->get('password');
       $this -> load -> model('user_model');//加载model文件
        $result = $this -> user_model -> get_by_name_pwd($username,$password);
        if($result){
            echo 'success';
            $this -> session ->set_userdata('loginUser',$result);
//            redirect('welcome/index');
        }else{
            echo "failed";
        }
    }
    public function reg()
    {
        $this->load->view('reg');
    }
    public function check_name()
    {
       $name =  $this ->input -> get('uname');
       $this -> load -> model('user_model');//加载model文件
        $result = $this -> user_model -> get_by_name($name);
        if($result){
            echo 'failed';
        }else{
            echo 'success';
        }
    }
    public function do_reg()
    {
        //接受值
        $email = ($this->input->post('email'));
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        $gender = $this->input->post('gender');


        //验证
        $this -> load -> model('user_model');
       $rows =  $this -> user_model -> save($email,$username,$password,$gender);
       if($rows > 0 ){
           redirect('welcome/login');
//           $this -> load -> view('login');//地址栏不变
       }else{
           $this -> load -> view('reg');
       }
    }
    public function homepage(){
	    $this->load->model('article_model');
	    $results = $this->article_model->get_all_articles();
	    if($results){
            $this->load->view('home_page',array(
                'results'=>$results,
            ));

        }

    }
}
