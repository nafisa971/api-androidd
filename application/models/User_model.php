<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk login user
    public function login($username, $password) {
        // Mencari user berdasarkan username
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        // Jika user ditemukan, verifikasi password
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
}