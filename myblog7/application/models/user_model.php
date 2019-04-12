<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/3/17
 * Time: 22:48
 */
class User_model extends CI_Model
{
    public function get_by_name_pwd($name, $pwd)
    {
        $query = $this->db->get_where("t_user", array(
            'username' => $name,
            'password' => $pwd
        ));
        return $query->row();//->result();
    }
    //查询数据库
    public function get_by_name($username){
        return $this -> db ->get_where('t_user',array(
            'username'=>$username
        ))->row();
    }
    //插入数据库
    public function save($email,$username,$password,$gender){
            $this -> db ->insert('t_user',array(
            'email'=>$email,
            'username'=>$username,
            'password'=>$password,
            'sex'=>$gender,

        ));
        //返回影响的行数
        return $this -> db -> affected_rows();
    }
    public function get_by_user_id($user_id){
        return $this->db->get_where('t_user',array(
           'user_id'=> $user_id
        ))->row();
    }
    public function save_pwd($new_pwd,$user_id){
        $this->db->set('password',$new_pwd);
        $this->db->where('user_id',$user_id);
        $this->db->update('t_user');
        return $this->db->affected_rows();
    }
    public function save_mood($mood,$user_id){
        $this->db->set('mood',$mood);
        $this->db->where('user_id',$user_id);
        $this->db->update('t_user');
        return $this->db->affected_rows();
    }
}