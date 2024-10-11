<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function login() {
        // Mengatur validasi input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $response = array(
                'status' => false,
                'message' => validation_errors()
            );
            echo json_encode($response);
            return;
        }

        // Mengambil input
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Memanggil model untuk verifikasi user
        $user = $this->User_model->login($username, $password);

        if ($user) {
            // Jika login sukses
            $response = array(
                'status' => true,
                'message' => 'Login berhasil',
                'data' => array(
                    'id' => $user->id,
                    'username' => $user->username
                )
            );
        } else {
            // Jika login gagal
            $response = array(
                'status' => false,
                'message' => 'Username atau password salah'
            );
        }

        // Mengirimkan respon JSON
        echo json_encode($response);
    }
}