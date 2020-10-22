<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostModel extends CI_Model
{
  const table = 'post';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    //Model ini hanya bisa di akses jika user sudah login
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }
  }

  public function insertFile($data)
  {
    //input data file
    return $this->db->insert($this::table, $data);
  }

  public function fileByEmail()
  {
    $email = $this->session->userdata('email');
    return $this->db->get_where($this::table, array('email' => $email))->result_array();
  }

  public function fileById($file_id)
  {
    return $this->db->get_where($this::table, array('file_id' => $file_id))->result_array();
  }

  public function fileByShareON()
  {
    return $this->db->get_where($this::table, array('share' => 1))->result_array();
  }

  public function fileByShareOFF()
  {
    // $email = $this->session->userdata('email');
    // $private = $this->_fileByShareOff();

    // if ($email == $private['email']) {
    return $this->db->get_where($this::table, array('share' => 0))->result_array();
    // } else {

    // }
  }

  private function _fileByShareOFF()
  {
    return $this->db->get_where($this::table, array('share' => 0))->result_array();
  }

  public function share_on($file_id)
  {
    $share = 1;
    $this->db->set('share', $share);
    $this->db->where('file_id', $file_id);
    $this->db->update($this::table);
  }

  public function share_off($file_id)
  {
    $share = 0;
    $this->db->set('share', $share);
    $this->db->where('file_id', $file_id);
    $this->db->update($this::table);
  }
}
