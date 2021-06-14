<?php
defined('BASEPATH') or exit('No direct script');

class Auth extends CI_Controller
{
    public function ambilData()
    {
        $table = $this->input->post('table');
        $hasil = ambilData($table);
        echo json_encode($hasil->result());
    }

    public function ambilDataDua()
    {
        $table = $this->input->post('table');
        $hasil = ambilDataDua($table)->result();
        echo json_encode($hasil);
    }

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];

        $this->load->view('auth/login', $data);
    }

    public function x()
    {
        //perusahaan
        $db1 = $this->load->database('we', true);
        $ptList = $db1->query('SELECT id, name FROM ansena_department')->result();
        $ptArray = array();
        foreach ($ptList as $row) {
            $ptArray['pt' . $row->id] = $row->name;
        }
        $db1->close();

        return $ptArray;
    }

    public function prosesLogin()
    {
        $nama = $this->input->post('nama');
        $pass = md5($this->input->post('password'));
        $cek = ambilWhere(array('nama_user' => $nama), 'user');
        $hasil = $cek->row_array();
        $password = $hasil['password'];
        $role = $hasil['role'];
        $pt = $hasil['pt'];

        $query = $this->db->query("SELECT id FROM user WHERE nama_user = '$nama'")->row_array();
        $userId = $query['id'];

        //perusahaan
        $array = $this->x();
        if (isset($array['pt' . $pt])) {
            $perusahaan = $array['pt' . $pt];
        }

        if ($pass == $password) {
            $_SESSION['role']   = $role;
            $_SESSION['user']   = $nama;
            $_SESSION['pt']     = $pt;
            $_SESSION['login']  = true;
            $_SESSION['perusahaan'] = $perusahaan;
            $_SESSION['id'] = $userId;
            echo 2;
        } else {
            echo 1;
        }
    }

    public function cekUser()
    {
        $nama = $this->input->post('nama');
        $cekUser = ambilWhere(array('nama_user' => $nama), 'user')->num_rows();

        echo $cekUser;
    }

    public function cekNama()
    {
        $nama = $this->input->post('nama');
        $hasil = ambilWhere(array('nama_user' => $nama), 'user')->num_rows();
        echo $hasil;
    }

    public function cekPass()
    {
        $nama = $this->input->post('nama');
        $password = md5($this->input->post('pass'));
        $cekPass = ambilWhere(array('nama_user' => $nama), 'user')->result();
        echo json_encode($cekPass);
        return false;
        foreach ($cekPass as $k) {
            $pass = $k->password;
        }
        if ($password == $pass) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function cekPassAlasan()
    {
        $nama = $this->input->post('nama');
        $pass = md5($this->input->post('pass'));
        $cek = $this->db->query("SELECT password FROM user WHERE nama_user = '$nama'")->row_array();
        if ($cek['password'] == $pass) {
            echo 'oke';
        } else {
            echo 'tidak';
        }
    }

    public function prosesRegister()
    {
        $nama = $this->input->post('nama');
        $akses = $this->input->post('akses');
        $pass = md5($this->input->post('pass'));
        $pt = 3;
        if ($akses == 1) {
            $status = 'Admin';
        } else if ($akses == 2) {
            $status = 'Preview';
        } else {
            $status = 'Marketing';
        }

        $data = [
            'nama_user' => $nama,
            'role'      => $akses,
            'password'  => $pass,
            'status'    => $status,
            'pt'        => $pt
        ];

        $cekNama = ambilWhere(array('nama_user'  => $nama), 'user')->num_rows();
        if ($cekNama == 0) {
            input('user', $data);
        }

        echo $cekNama;
    }

    public function user()
    {
        $db = $this->load->database('we', true);
        $pt = $db->query('SELECT fullname, id FROM ansena_department WHERE income = 1')->result();
        $data = [
            'title' => 'User',
            'pt'    => $pt
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('auth/user');
        $this->load->view('layout/footer');
    }

    public function logout()
    {
        session_destroy();
        redirect('auth');
    }
}
