<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('UserModel');
  }

  public function index()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header_form');
      $this->load->view('form/login');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email    = $this->input->post('email');
    $password = $this->input->post('password');

    $user     = $this->UserModel->findByEmail($email);
    $is_valid = $this->UserModel->auth($email, $password);

    if ($is_valid) {
      $data = array(
        'name'      => $user['name'],
        'email'     => $user['email'],
        'role'      => $user['role'],
        'status'    => $user['status'],
        'logged_in' => true
      );

      if ($data['status'] == 0) {
        $this->session->set_flashdata('failed', '<b>Email has not been Activated!</b>');
        redirect('auth');
      } elseif ($data['status'] == 1) {
        //session akun yang sedang login
        $this->session->set_userdata($data);
        if ($data['role'] == 0) {
          redirect('user');
        } elseif ($data['role'] == 1) {
          redirect('user/admin');
        }
      }
    } else {
      if (!$user) {
        $this->session->set_flashdata('failed', '<b>Email not Found!</b>');
      } elseif (!$is_valid) {
        $this->session->set_flashdata('failed', '<b>Wrong Password!</b>');
      }
      redirect('auth');
    }
  }

  public function register()
  {
    //form validation rules
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|matches[password1]', [
      'matches' => 'Password not match!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password]');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('failed', form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'));

      //menampilkan tampilan register
      $this->load->view('templates/header_form');
      $this->load->view('form/register');
    } else {
      //ambil nilai input
      $data = [
        'email'     => $this->input->post('email'),
        'name'      => $this->input->post('name'),
        'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'role'      => 0,
        'status'    => 1
      ];

      // mkdir & chmod 777 hanya untuk linux, jika windows 0777 dihapus
      //membuat folder utk user baru
      if (mkdir($data['email'], 0777)) {
        chmod($data['email'], 0777);

        //dikirim ke model
        $this->UserModel->insertRegister($data);
        $this->session->set_flashdata('success', '<b>Registration Success!</b>');
        redirect('auth');
      } else {
        $this->session->set_flashdata('failed1', '<b>Registration Failed!<br>Email Already!</b>');
        redirect('auth/register');
      }
    }
  }

  public function logout()
  {
    $userdata = array('email', 'name', 'role', 'status');
    $this->session->set_userdata('logged_in', 0);

    //utk menghapus data dari session login
    $this->session->unset_userdata($userdata);
    $this->session->set_flashdata('success', '<b>Logout Success!</b>');
    redirect('auth');
  }
}
