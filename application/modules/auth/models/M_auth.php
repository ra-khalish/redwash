<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model{

  public function insertReg($table, $data) {
    $this->db->insert($table, $data);
  }

  public function getUser($table, $email) {
    return $this->db->get_where($table, ['user_email' => $email])->row_array();
}
}