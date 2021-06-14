<?php
defined('BASEPATH') or exit('No direct script allowed');
class User extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MainModel', 'database');
    }

    public function cekUser()
    {
        $id = $this->input->post('id');
        $hasil = ambilWhere(array('id' => $id), 'user')->result();
        echo json_encode($hasil);
    }

    public function hapus()
    {
        $id = $this->input->post('id');
        hapus('user', array('id' => $id));
    }

    public function ambilUser()
    {
        $idPt = $_SESSION['pt'];
        if ($_SESSION['role'] == 1) {
            $user = $this->db->query("SELECT nama_user, status, pt, id FROM user WHERE pt = $idPt")->result();
        } else if ($_SESSION['role'] == 0) {
            $user = $this->db->query("SELECT nama_user, status, pt, id FROM user")->result();
        }

        $db = $this->load->database('we', true);
        $pt = $db->query('SELECT name, id FROM ansena_department WHERE income = 1')->result();
        $ptArr = array();
        foreach ($pt as $row) {
            $ptArr['p' . $row->id] = $row->name;
        }
        $db->close();

        $data = [
            'hasil' => $user,
            'pt'    => $ptArr
        ];

        $this->load->view('auth/detailUser', $data);
    }

    public function prosesEdit()
    {
        $id     = $this->input->post('id');
        $nama   = $this->input->post('nama');
        $akses  = $this->input->post('akses');
        $pt     = $this->input->post('pt');
        $database = $this->input->post('database');
        if ($akses == 1) {
            $aksess = 'Admin';
        } else if ($akses == 5) {
            $aksess = 'Pemasaran';
        } else {
            $aksess = 'User';
        }

        $data = [
            'nama_user' => $nama,
            'role'      => $akses,
            'status'    => $aksess,
            'pt'        => $pt,
            'db'        => $database,
            'id'        => $id
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function detail()
    {
        $id = $this->input->post('id');

        $query = $this->db->query("SELECT nama_user, password, role, pt, status 
                                        FROM user 
                                        WHERE id = $id")->row_array();
        
        $nama = $query['nama_user'];
        $role = $query['role'];
        $status = $query['status'];
        $pt = $query['pt'];

        $queryDb = "SELECT db 
                        FROM ansena_department
                        WHERE id = $pt";
        $resultDb = $this->database->getData($queryDb, 'we')->row_array();
        $dbName = $resultDb['db'];

        //array pt 
        $ptArray = array();
        $queryPt = "SELECT id, name 
                            FROM ansena_department 
                            WHERE income = 1";
        $resultPt = $this->database->getData($queryPt, 'we')->result();

        foreach($resultPt as $row ) {
            $ptArray['p' . $row->id] = $row->name;
            $ptList[] = $row->name;
            $ptId[] = $row->id;
        }

        if (isset($ptArray['p' . $pt])) {
            $ptName = $ptArray['p' . $pt];
        }

        $data = [
            'nama'  => $nama,
            'role'  => $role,
            'status'    => $status,
            'pt'    => $pt,
            'ptName'    => $ptName,
            'db'    => $dbName,
            'daftarPt'  => $resultPt
        ];

        $this->load->view('auth/editUser', $data);
    }

    public function resetPassword()
    {
        $data = [
            'title' => 'Reset password'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('auth/resetPassword', $data);
        $this->load->view('layout/footer');
    }

    public function prosesReset()
    {
        $passLama = md5($this->input->post('passLama'));
        $pass = md5($this->input->post('passBaru'));

        $nama = $_SESSION['user'];
        $cekAkun = $this->db->query("SELECT password FROM user WHERE nama_user = '$nama'")->row_array();
        if ($passLama == $cekAkun['password']) {
            //proses edit password
            $dataEdit = [
                'password'  => $pass
            ];

            edit('user', $dataEdit, array('nama_user' => $nama));
            echo 'oke';
        } else {
            echo 'password tidak sama';
        }
    }

    public function getPt() {
        $query = "SELECT name, id
                        FROM ansena_department 
                        WHERE income = 1";
        $result = $this->database->getData($query, 'we');

        echo json_encode($result->result());
    }
}
