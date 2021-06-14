<?php
defined('BASEPATH') or exit('No direct script allowed');

class Closing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'database');
    }

    public function index()
    {
        if (isset($_SESSION['login'])) {
            $idPt = $_SESSION['pt'];
            $this->db->select('tanggal_input');
            $this->db->where('is_close =', null);
            $this->db->where('pt', $idPt);
            $this->db->order_by('tanggal_input', 'asc');
            $hasil = $this->db->get('visit'); //hasil table visit
            if ($hasil->num_rows() > 0) {
                foreach ($hasil->result() as $row) {
                    $tanggal[] = $row->tanggal_input;
                }
                $tanggalInput = array_unique($tanggal);
                $data = [
                    'title' => 'Closing Data',
                    'hasil' => $hasil->result(),
                    'tanggal'   => $tanggalInput,
                    'cek'       => $hasil->num_rows()
                ];
                $this->load->view('layout/header', $data);
                $this->load->view('closing/closing', $data);
                $this->load->view('layout/footer');
            } else {
                $data['title'] = 'Tidak ada data';
                $this->load->view('layout/header', $data);
                $this->load->view('errors/error2');
                $this->load->view('layout/footer');
            }
        } else {
            redirect('dashboard/redirect');
        }
    }

    public function ambilTanggalClosing()
    {
        $this->db->select('tanggal_input');
        $this->db->where('is_close =', null);
        $this->db->order_by('tanggal_input', 'asc');
        $hasil = $this->db->get('visit'); //hasil table visit
        foreach ($hasil->result() as $row) {
            $tanggal[] = $row->tanggal_input;
        }
        $tanggalInput = array_unique($tanggal);

        echo json_encode($tanggalInput);
    }

    public function paginationClosing($halaman)
    {
        // $idPt = $_SESSION['pt'];
        // $limit = $this->input->post('limit');
        // $halaman = $this->input->post('halaman');
        // $per_page = 10;

        // if ($halaman > 1) {
        //     $halaman = $halaman * $per_page - 10;
        // } else {
        //     $halaman = 0;
        // }
        // $this->db->select('nama');
        // $this->db->where('is_close =', null);
        // $this->db->where('pt', $idPt);
        // $jumlahData = $this->db->get('visit');
        // $link = ceil($jumlahData->num_rows() / $per_page);


        // $hasil = ambilPaginationClosing($per_page, $halaman, 'visit', $idPt);

        // $db = $this->load->database('we', true);
        // $idP = $_SESSION['pt'];
        // $cekDb = $db->query('SELECT db FROM ansena_department WHERE id = ' . $idP)->row_array();
        // $dbB = $cekDb['db'];
        // $db->close();

        // //brand
        // $dbBrand = $this->load->database($dbB, true);
        // $brandList = $dbBrand->query("SELECT id_franchise, nama_franchise FROM ansena_franchise_list")->result();
        // $brandArr = array();
        // foreach ($brandList as $row) {
        //     $brandArr['b' . $row->id_franchise] = $row->nama_franchise;
        // }
        // $dbBrand->close();

        // $data = [
        //     'title' => 'Closing Data',
        //     'hasil' => $hasil->result(),
        //     'brand' => $brandArr,
        //     'per_page'  => $link,
        //     'cek'   => $this->input->halaman,
        //     'halaman'   => $halaman,
        // ];

        // $this->load->view('closing/closingPagination', $data);

        $idPt = $_SESSION['pt'];
        $per_page = 10;

        if ($halaman != 0) {
            $halaman = ($halaman - 1) * $per_page;
        } else {
            $halaman = 0;
        }

        //jumlah data 
        $this->db->select('id_visit');
        $this->db->where('pt', $idPt)
            ->where('tanggal_join =', null)
            ->where('is_close =', null);
        $jumlahBaris = $this->db->get('visit')->num_rows();

        //hasil
        $this->db->select('nama, id_visit, brand, tanggal_input, is_close, prospek, id_visit');
        $this->db->where('pt', $idPt)
            ->where('tanggal_join =', null)
            ->where('is_close =', null);
        $this->db->order_by('tanggal_input', 'asc');
        $this->db->order_by('nama', 'asc');
        $this->db->limit($per_page, $halaman);
        $hasil = $this->db->get('visit')->result();
        foreach ($hasil as $row) {
            $tanggal[]  = date('d F Y', strtotime($row->tanggal_input));
        }

        //ambilBrand
        $db = $this->load->database('we', true);
        $cekDb = $db->query("SELECT db FROM ansena_department WHERE id = $idPt")->row_array();
        $dbB = $cekDb['db'];
        $db->close();

        $brandArray = array();

        if ($idPt == '41') {
            $brandArray['b41'] = 'polakain';
        } else {
            $dbBrand = $this->load->database($dbB, true);
            $brand = $dbBrand->query('SELECT id_franchise, nama_franchise FROM ansena_franchise_list')->result();
            foreach ($brand as $row) {
                $brandArray['b' . $row->id_franchise] = $row->nama_franchise;
            }
        }

        $config['base_url'] = base_url() . 'visitor/ambilVisitTanggal';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $jumlahBaris;
        $config['per_page'] = $per_page;

        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['hasil']          = $hasil;
        $data['pagination']     = $this->pagination->create_links();
        $data['brandArr']       = $brandArray;
        $data['jumlah']         = $jumlahBaris;
        $data['halaman']        = $halaman;
        $data['tanggal']        = $tanggal;

        echo json_encode($data);
    }

    public function issetBrand()
    {
        $ptId = $_SESSION['pt'];

        if ($ptId == '41') {
            $brandArray['b41'] = 'Pola kain';
        } else {
            $db = $this->load->database('we', true);
            $id = $_SESSION['pt'];
            $cekDb = $db->query('SELECT db FROM ansena_department WHERE id = ' . $id)->row_array();
            $dbB = $cekDb['db'];
            $db->close();
    
            //brand
            $dbBrand = $this->load->database($dbB, true);
            $brandList = $dbBrand->query('SELECT id_franchise, nama_franchise FROM ansena_franchise_list')->result();
            $brandArray = array();
            foreach ($brandList as $r) {
                $brandArray['b' . $r->id_franchise] = $r->nama_franchise;
            }
            $dbBrand->close();
        }
        
        return $brandArray;
    }

    public function tampilkanClosing()
    {
        $tanggal = $this->input->post('tanggal');
        $idPt = $_SESSION['pt'];

        //ambil data untuk closing
        $this->db->select('brand, prospek, kategori');
        $this->db->where('is_close =', null)
            ->where('pt', $idPt)
            ->where('tanggal_input', $tanggal);
        $hasil = $this->db->get('visit');

        foreach ($hasil->result() as $row) {
            $brandA[]   = $row->brand; //brand
            $arr = array_unique($brandA); //brand
            $katVisit = $row->kategori; //kategori
        }

        //jumlah respon
        $this->db->select('kategori');
        $this->db->where('tanggal_input', $tanggal)
            ->where('kategori', 3)
            ->where('pt', $idPt)
            ->where('is_close =', null);
        $jumRespon = $this->db->query("SELECT id_visit FROM visit WHERE is_close IS null AND kategori = 3 AND tanggal_input = '$tanggal' AND pt = $idPt")->num_rows();
        // $jumRespon = $this->db->get('visit')->num_rows();

        //jumlah no respon
        $this->db->select('kategori');
        $this->db->where('tanggal_input', $tanggal)
            ->where('kategori', 2)
            ->where('pt', $idPt)
            ->where('is_close =', null);
        $jumNoRespon = $this->db->get('visit')->num_rows();

        //jumlah anak
        $this->db->select('kategori');
        $this->db->where('tanggal_input', $tanggal)
            ->where('kategori', 1)
            ->where('pt', $idPt)
            ->where('is_close =', null);
        $jumAnak = $this->db->get('visit')->num_rows();



        $data = [
            'hasil'     => $hasil->result(),
            'brandA'    => $arr,
            'brand'     => $this->issetBrand(),
            'katVisit'  => $katVisit,
            'tanggal'   => $tanggal,
            'respon'    => $jumRespon,
            'no'        => $jumNoRespon,
            'anak'      => $jumAnak
        ];

        $this->load->view('closing/listClosing', $data);
    }

    public function prosesClosing()
    {
        $tanggalPost = $this->input->post('tanggal');
        $pt = $_SESSION['pt'];
        //ambil data hari sesuai post dan ubah is_close
        $this->db->select('is_close, nama, id_visit, tanggal_input');
        $this->db->where('tanggal_input', $tanggalPost)
            ->where('pt', $pt);
        $hasil = $this->db->get('visit');

        $dataUpdate = [
            'is_close'  => 1
        ];

        //edit table 
        $this->db->where('tanggal_input', $tanggalPost);
        $this->db->update('visit', $dataUpdate);

        echo 'success';
    }

    public function ambilDataClosing()
    {
        $tanggal = date('Y-m-d');
        $pt = $_SESSION['pt'];

        //ambil database yang belum di closing
        $this->db->select('id_visit');
        $this->db->where('tanggal_input <=', $tanggal)
            ->where('is_close =', null)
            ->where('pt', $pt)
            ->where('kategori >', 1);
        $hasil = $this->db->get('visit')->num_rows();
        echo $hasil;
    }

    public function editClosing() {
        $idVisitor = $this->input->post('id');
        $today = date('Y-m-d');
        $idPt = $_SESSION['pt'];

        $query = "SELECT nama, hp, brand, pt, marketing, kategori, alasan, prospek, tanggal_input, umur, j_kelamin, sumber
              FROM visit
              WHERE id_visit = $idVisitor";
        $result = $this->database->getData($query, 'visit');

        // get db pt
        $queryPt = "SELECT db FROM ansena_department WHERE id = $idPt";
        $resultPt = $this->database->getData($queryPt, 'we')->row_array();

        $dbPt = $resultPt['db'];

        //brand array
        $brandArray = array();
        $queryBrand = "SELECT id_franchise, nama_franchise
                  FROM ansena_franchise_list";
        $resultBrand = $this->database->getData($queryBrand, $dbPt);

        //alasan array
        $alasanArray = array();
        $queryAlasan = "SELECT alasan, id FROM alasan WHERE role > 0";
        $resultAlasan = $this->database->getData($queryAlasan, 'visit');

        //marketing list
        $marketingArray = array();
        $queryMarketing = "SELECT id, name
                        FROM ac_payroll_item
                        WHERE office = $idPt
                        AND division = 13
                        ORDER BY name ASC";
        $resultMarketing = $this->database->getData($queryMarketing, 'we');

        //looping
        foreach ($resultBrand->result() as $br) {
            $brandArray['b' . $br->id_franchise] = $br->nama_franchise;
        }

        foreach ($resultAlasan->result() as $al) {
            $alasanArray['al' . $al->id] = $al->alasan;
        }

        foreach ($resultMarketing->result() as $mar) {
            $marketingArray['m' . $mar->id] = $mar->name;
        }


        foreach ($result->result() as $row) {

            if (isset($brandArray['b' . $row->brand])) {

                $brandName = $brandArray['b' . $row->brand];
            }

            if (isset($marketingArray['m' . $row->marketing])) {
                $selectedMarketing = $marketingArray['m' . $row->marketing];
            } else {
                $selectedMarketing = '-';
            }

            $alasan = $row->alasan;

            if ($alasan > 0) {

                if (isset($alasanArray['al' . $alasan])) {

                    $newAlasan = $alasanArray['al' . $alasan];
                }
            } else {

                $newAlasan = 'Tidak ada alasan';
            }

            $kategori = $row->kategori;
            $prospek = $row->prospek;
            $tanggalInput = date('d F Y', strtotime($row->tanggal_input));
            $nama = $row->nama;
            $hp = $row->hp;
            $umur = $row->umur;
            $jKel = $row->j_kelamin;
            $marketingId = $row->marketing;
            $brandId = $row->brand;
            $sumber = $row->sumber;

            //condition
            if ($kategori == 1) {

                $newKategori = 'Anak - anak';
            } else if ($kategori == 2) {

                $newKategori = 'No respon';
            } else if ($kategori == 3) {

                $newKategori = 'Respon';
            }
        }

        $data['nama'] = $nama;
        $data['hp'] = $hp;
        $data['alasan'] = $newAlasan;
        $data['sumber']   = $sumber;
        $data['alasanId'] = $alasan;
        $data['alasanList'] = $resultAlasan->result();
        $data['kategori'] = $newKategori;
        $data['kategoriId'] = $kategori;
        $data['prospek'] = $prospek;
        $data['alasan'] = $newAlasan;
        $data['brand'] = $brandName;
        $data['tanggalInput'] = $tanggalInput;
        $data['umur'] = $umur;
        $data['jKel'] = $jKel;
        $data['idVisit'] = $idVisitor;
        $data['marketingList'] = $resultMarketing->result();
        $data['marketingName'] = $selectedMarketing;
        $data['marketingId'] = $marketingId;
        $data['brandList'] = $resultBrand->result();
        $data['brandId'] = $brandId;

        echo json_encode($data);
    }
}
