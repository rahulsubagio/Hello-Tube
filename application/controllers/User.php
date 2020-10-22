<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('UserModel');
    $this->load->model('PostModel');

    //controller ini hanya bisa di akses jika user sudah login
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }
  }

  public function index()
  {
    $file['getfile'] = $this->PostModel->fileByEmail();
    $file['getshare'] = $this->PostModel->fileByShareON();

    $this->load->view('templates/header_dash');
    $this->load->view('dashboard/user');
    $this->load->view('dashboard/dash_user', $file);
    $this->load->view('templates/footer_dash');
  }

  public function admin()
  {
    $data['user'] = $this->UserModel->findAll();
    $data['getshare'] = $this->PostModel->fileByShareON();

    $this->load->view('templates/header_dash');
    $this->load->view('dashboard/admin');
    $this->load->view('dashboard/dash_admin', $data);
    $this->load->view('templates/footer_dash');
  }

  public function privateVideo()
  {
    $file['getfile'] = $this->PostModel->fileByEmail();
    $file['getshare'] = $this->PostModel->fileByShareOFF();

    $this->load->view('templates/header_dash');
    $this->load->view('dashboard/user');
    $this->load->view('dashboard/private_video', $file);
    $this->load->view('templates/footer_dash');
  }

  public function upload()
  {
    $now = date('Y-m-d H:i:s');
    $email = $this->session->userdata('email');

    $config['allowed_types'] = 'mp4';
    $config['upload_path'] = './' . $email . '/';
    $config['max_size'] = 0;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file_name')) {
      redirect('user');
    } else {
      $data = $this->upload->data();
      $file = array(
        'file_name'   => $data['file_name'],
        'email'       => $email,
        'upload_time' => $now,
        'share'       => 1
      );

      $this->PostModel->insertFile($file);
      redirect('user');
    }
  }

  public function shareOn($file_id)
  {
    $this->PostModel->share_on($file_id);
    redirect('user');
  }

  public function shareOff($file_id)
  {
    $this->PostModel->share_off($file_id);
    redirect('user');
  }
}
