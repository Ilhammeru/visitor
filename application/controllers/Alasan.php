<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alasan extends CI_Controller
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            $data = [
                'title'     => 'Database Alasan',
                'jumlah'    => ambilData('alasan')->num_rows()
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('alasan/alasan', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('dashboard/redirect');
        }
    }

    public function ambilAlasan()
    {
        $per_page = 10;
        $halaman = $this->input->post('halaman');
        if ($halaman > 1) {
            $halaman = $halaman * $per_page - 10;
        } else {
            $halaman = 0;
        }
        $jumlahData = ambilWhere(array('role' => 1), 'alasan')->num_rows();
        $link = ceil($jumlahData / $per_page);


        $hasil = ambilPaginationAlasan($per_page, $halaman, 'alasan')->result();

        // $hasil = $this->db->query('SELECT alasan, id FROM alasan WHERE role = 1')->result();
        // echo json_encode($hasil);
        $data = [
            'hasil'         => $hasil,
            'jumlahData'    => $jumlahData,
            'halaman'       => $halaman,
            'per_page'      => $link
        ];

        $this->load->view('alasan/detail', $data);
    }

    public function prosesAlasan()
    {
        $alasan = explode(',', $this->input->post('alasan'));
        $pass = md5($this->input->post('pass'));
        $nama = $_SESSION['user'];

        //cek pass di database
        $this->db->select('password');
        $this->db->where('nama_user', $nama);
        $cekPass = $this->db->get('user');
        $passDb = $cekPass->row_array();


        for ($i = 0; $i < count($alasan); $i++) {
            $al = $alasan[$i];
        }
        if ($al == '') {
            echo 'Tidak ada';
        } else if ($passDb['password'] != $pass) {
            echo 'password salah';
        } else {
            $result = array();
            foreach ($alasan as $key => $val) {
                $result[] = array(
                    'alasan'    => $alasan[$key],
                    'role'      => 1
                );
            }
            inputBatch('alasan', $result);
        }
    }

    public function prosesEdit()
    {
        $id = $this->input->post('id');
        $alasan = $this->input->post('alasan');
        $data = [
            'alasan' => $alasan
        ];
        ubah('alasan', $data, array('id' => $id));
    }

    public function cekAlasan()
    {
        $alasan = $this->input->post('alasan');
        $hasil = ambilWhere(array('alasan' => $alasan), 'alasan')->num_rows();
        echo $hasil;
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $hasil = ambilWhere(array('id' => $id), 'alasan')->result();
        echo json_encode($hasil);
    }

    public function ambilId()
    {
        $id = $this->input->post('id');
        $hasil = ambilWhere(array('id'  => $id), 'alasan')->result();
        echo json_encode($hasil);
    }

    public function hapus()
    {
        $id = $this->input->post('id');
        ubah('alasan', array('role' => 0), array('id' => $id));
    }
}
