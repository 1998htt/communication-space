<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('comment_model');
        $this->load->model('user_model');
    }

    public function index(){
        $this->load->view('admin_index');
    }
    public function new_blog(){
        $loginUser = $this->session->userdata('loginUser');
        $types=$this->article_model->get_types_by_user($loginUser->user_id);
        $this->load->view('new_blog',array(
            'types'=>$types
        ));
    }
    public function post_blog(){

        $title=htmlspecialchars($this->input->post('title'));
        $content=htmlspecialchars($this->input->post('content'));
        $type_id=$this->input->post('type_id');
        $loginUser = $this->session->userdata('loginUser');
        $rows=$this->article_model->save_article($title,$content,$type_id,$loginUser->user_id);
        if($rows>0){
            redirect('admin/list_blogs');
        }else{
            echo 'fail';
        }
    }
    public function list_blogs(){
        $loginUser = $this->session->userdata('loginUser');
        $articles=$this->article_model->get_articles_by_user($loginUser->user_id);
        $this->load->view('list_blogs',array(
            'articles'=>$articles
        ));
    }
    public function delete_articles(){
        $ids=$this->input->get('ids');
        $rows=$this->article_model->delete_articles($ids);
        if($rows>0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function get_blog_by_id(){
        $user_id = $this->session->userdata('loginUser')->user_id;
        $id=$this->input->get('id');
        $this->article_model->update_by_article_id($id);
        $results=$this->article_model->get_articles_by_user($user_id);
        $comment_results=$this->comment_model->get_comment_by_articleid($id);
        $nextArticle=null;
        $preArticle=null;
        foreach ($results as $index=>$result){
            if($id==$result->article_id){
                $row=$result;
                if($index>0){
                    $preArticle=$results[$index-1];
                }
                if($index<count($results)-1){
                    $nextArticle=$results[$index+1];
                }
                break;
            }
        }
        if($results){
            $this->load->view('viewPost',array(
                'row'=>$row,
                'preArticle'=>$preArticle,
                'nextArticle'=>$nextArticle,
                'comment_results'=>$comment_results,
            ));

        }else{
            echo 'fail';
        }
    }
    public function save_comment(){
        $id=$this->input->post('id');
        $content=$this->input->post('content');
        $user_id = $this->session->userdata('loginUser')->user_id;
        $rows=$this->comment_model->save($id,$content,$user_id);
        if($rows>0){
            redirect("admin/get_blog_by_id?id=$id");
        }else{
            echo 'fail';
        }
    }
    public function get_comment_to_me(){

        $user_id=$this->session->userdata('loginUser')->user_id;
        $results=$this->comment_model->get_comment($user_id);
        if($results){
            $this->load->view('blogComments',array(
                'results'=>$results
            ));
        }
    }
    public function delete_comment(){
//        $user_id=$this->session->userdata('loginUser')->user_id;
        $comment_id=$this->input->get('comment_id');
        $row=$this->comment_model->delete_comment($comment_id);
        if($row>0){
            redirect('admin/get_comment_to_me');
        }
        else{
            echo 'fail';
        }
}
    public function delete_comment_by_commUser(){
    $user_id=$this->session->userdata('loginUser')->user_id;
    $commUser=$this->input->get('commUser');
    $row=$this->comment_model->delete_comment_by_commUser($commUser,$user_id);
        if($row>0){
            redirect('admin/get_comment_to_me');
        }else{
        echo 'fail';
        }
    }
    public function get_blog_type(){
        $user_id=$this->session->userdata('loginUser')->user_id;
        $results=$this->article_model->get_types_by_user($user_id);
        if($results){
            $this->load->view('blogCatalogs',array(
                'results'=>$results
            ));
        }
    }
//    public function update_type(){
//        $type_id = $this->input->get('type_id');
//        $type_name = $this->input->get('type_name');
//        $this->article_model->update_type($type_id);
//    }
    //修改密码
    public function chpwd(){
        $this->load->view('chpwd');
    }
    public function update_pwd(){
        $user_id=$this->session->userdata('loginUser')->user_id;
        $password=$this->session->userdata('loginUser')->password;
        $old_pwd = $this->input->get('old_pwd');
        $new_pwd = $this->input->get('new_pwd');
        $re_new_pwd = $this->input->get('re_new_pwd');
        $row = $this->user_model->get_by_user_id($user_id);
        if($row && ($password == $old_pwd)){
            if($new_pwd == $re_new_pwd && $new_pwd !=null){
                echo 'success';
                $this->user_model->save_pwd($new_pwd,$user_id);
            }else if($new_pwd == null || $re_new_pwd == null){
                echo 'empty';
            }else{
                echo 'notmatch';
            }
        }else{
            echo "failed";
        }


    }
    //修改心情
    public function userSettings(){
        $this->load->view('userSettings');
    }
    public function user_mood(){
        $user_id=$this->session->userdata('loginUser')->user_id;
        $mood = $this->input->post('space_name');
        $row = $this->user_model->save_mood($mood,$user_id);
        if($row){
            redirect('admin/userSettings');
        }else{
            echo "failed";
        }
    }
    public function show_detail(){
//        $user_id = $this->session->userdata('loginUser')->user_id;
        $id=$this->input->get('article_id');
        $this->article_model->update_by_article_id($id);//点击率
        $row=$this->article_model->get_articles_by_article_id($id);//文章
        $comment_results=$this->comment_model->get_comment_by_articleid($id);//评论
        if($row){
            $this->load->view('viewPost1',array(
                'row'=>$row,
                'comment_results'=>$comment_results,
            ));

        }else{
            echo 'fail';
        }
    }
    public function user_save_comment(){
        $article_id = $this->input->get('article_id');
        $content = $this->input->post('content');
        $user_id = $this->session->userdata('loginUser')->user_id;
        $rows=$this->comment_model->save($article_id,$content,$user_id);
        if($rows>0){
            redirect("admin/show_detail?article_id=$article_id");
        }else{
            echo 'fail';
        }
    }
}