<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/3/20
 * Time: 14:02
 */
class Article_model extends CI_Model{
    public function get_all_articles(){
        $sql = "select t.*,a.type_name from t_article t,t_article_type a where t.user_id=a.user_id and t.type_id=a.type_id order by t.post_date desc";
        return $this->db->query($sql)->result();
    }
    public function get_articles_by_user($user_id){
     //多表查询
     $this->db->select('a.*,t.type_name');
     $this->db->from('t_article a');
     $this->db->join('t_article_type t','a.type_id = t.type_id');
     $this->db->where('a.user_id',$user_id);
     $this->db->order_by('a.post_date','desc');
     return $this->db->get()->result();
    }
    public function get_types_by_user($user_id){
        $sql = "select t.*,
        (select count(*) from t_article a where a.type_id = t.type_id) num
         from t_article_type t where t.user_id=$user_id";
        return $this->db->query($sql)->result();
    }
    public function save_article($title,$content,$type_id,$user_id){
        $this->db->insert('t_article',array(
            'title'=>$title,
            'content'=>$content,
            'user_id'=>$user_id,
            'type_id'=>$type_id,
        ));
        return $this->db->affected_rows();
    }
    public function delete_articles($ids){
        $sql='delete from t_article where article_id in('.$ids.')';
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    public function update_by_article_id($id){
        $sql = "update t_article set clicked = clicked+1 where article_id=$id";
        $this->db->query($sql);
    }
//    public function get_blog_type($user_id){
//        $sql="select * from t_article_type where user_id=$user_id";
//        return $this->db->query($sql)->result();
//    }
    public function update_type($type_id,$type_name){
        $this->db->set('type_name',$type_name);
        $this->db->where('type_id',$type_id);
        $this->db->update('t_article_type');
        return $this->db->affected_rows();

    }
   public function get_articles_by_article_id($id){
        $sql="select t.* from t_article t where t.article_id=$id";
        return $this->db->query($sql)->row();
   }
}
