<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
  const table = 'user';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function insertRegister($data)
  {
    //input data user
    return $this->db->insert($this::table, $data);
  }

  public function findAll()
  {
    return $this->db->get($this::table)->row_array();
  }

  public function findByEmail($email)
  {
    //mendapatkan data berdasarkan email
    return $this->db->get_where($this::table, array('email' => $email))->row_array();
  }

  public function auth($email, $password)
  {
    $user = $this->findByEmail($email);
    if (!$user) {
      return false;
    }
    return password_verify($password, $user['password']);
  }
}
