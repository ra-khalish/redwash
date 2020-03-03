<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model{

  public function insertReg($table, $data) {
    $this->db->insert($table, $data);
  }

  public function insertTkn($table, $users_token) {
    $this->db->insert($table, $users_token);
  }

  public function getUser($table, $where) {
    return $this->db->get_where($table, $where)->row_array();
}
}