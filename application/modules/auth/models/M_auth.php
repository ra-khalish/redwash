<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model{

  public function insertReg($table, $data) {
    $this->db->insert($table, $data);
  }

  public function insertTkn($table, $users_token) {
    $this->db->insert($table, $users_token);
  }

  public function getUserlogin($table, $where) {
    return $this->db->get_where($table, $where)->row_array();
  }

  public function getUser($table, $email)
  {
    return $this->db->get_where($table, ['user_email' => $email])->row_array();
  }

  public function getToken($table, $token)
  {
    return $this->db->get_where($table, ['user_token' => $token])->row_array();
  }
}