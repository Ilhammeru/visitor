<?php
defined('BASEPATH') or exit('No direct script allowed');

class Visitor extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();
      $this->load->model('MainModel', 'database');
    }

    public function index($halaman = 0)
    {
        $mainQuery = $this->db->query("SELECT * FROM visit");
        $visit = $mainQuery->result();
        $visitRows = $mainQuery->num_rows();

        $queryPt = "SELECT ";
        if (isset($_SESSION['login'])) {
            $data = [
                'title'     => 'Data visitor',
                // 'visit'     => ambilData('visit')->result(),
                // 'jumlah'    => ambilData('visit')->num_rows(),
                // 'pt'        => ambilDataDb('we', 'ansena_department')->result(),
                // 'marketing' => ambilDataEmpat('ac_payroll_item')->result(),
                // 'brand'     => ambilDataDb('we', 'ansena_franchise_list')->result(),
                // 'department'    => ambilDataDbWhere('we', 'ansena_department')->result(),
                // 'alasan'        => ambilWhere(array('role'  => 1), 'alasan')->result(),
                // 'jAlasan'       => ambilData('alasan')->num_rows()
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('visitor/visitor', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('dashboard/redirect');
        }
    }

    public function masterEdit($halaman = 0)
    {
        $mainQuery = $this->db->query("SELECT * FROM visit");
        $visit = $mainQuery->result();
        $visitRows = $mainQuery->num_rows();

        $queryPt = "SELECT ";
        if (isset($_SESSION['login'])) {
            $data = [
                'title'     => 'Data visitor',
                // 'visit'     => ambilData('visit')->result(),
                // 'jumlah'    => ambilData('visit')->num_rows(),
                // 'pt'        => ambilDataDb('we', 'ansena_department')->result(),
                // 'marketing' => ambilDataEmpat('ac_payroll_item')->result(),
                // 'brand'     => ambilDataDb('we', 'ansena_franchise_list')->result(),
                // 'department'    => ambilDataDbWhere('we', 'ansena_department')->result(),
                // 'alasan'        => ambilWhere(array('role'  => 1), 'alasan')->result(),
                // 'jAlasan'       => ambilData('alasan')->num_rows()
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('visitor/master-edit', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('dashboard/redirect');
        }
    }

    public function tambahVisit()
    {
        //load db we
        $id = $_SESSION['pt'];
        $db = $this->load->database('we', true);

        //provinsi
        $queryKota = "SELECT city_name, id_city, id_prov FROM adm_city";
        $kota = $this->database->getData($queryKota, 'we')->result();

        //alasan 
        $queryAl = $this->db->query("SELECT id, alasan 
                                        FROM alasan 
                                        WHERE role > 0");
        $alasan = $queryAl->result();
        $alasanRows = $queryAl->num_rows();

        

        $data = [
            'title'         => 'Tambah Visitor',
            // 'department'    => ambilDataDbWhere('we', 'ansena_department')->result(),
            'alasan'        => $alasan,
            'jAlasan'       => $alasanRows,
            'kota'          => $kota
        ];

        $this->load->view('visitor/tambahVisit', $data);
    }

    public function ambilVisitPagination($halaman)
    {
        $per_page = 10;
        $idPt = $_SESSION['pt'];
        if ($halaman != 0) {
            $halaman = ($halaman - 1) * $per_page;
        }
        $today = date('Y-m-d');

        $this->db->select('nama');
        $this->db->where('pt', $idPt) //sesuai id pt
            ->where('kategori > ', 1) //kategori bukan anak anak
            ->where('tanggal_input', date('Y-m-d')); //sesuai dengan tanggal berjalan
        $jumlahBaris = $this->db->get('visit')->num_rows(); //dari table visit (jumlah baris_)

        if ($jumlahBaris == 0) {
            $jumlahBaris = "tidak ada data";
            echo json_encode($jumlahBaris);
        } else {
            $this->db->select('nama, id_visit, brand, pt, alasan, tanggal_input, hp, is_close, tanggal_join');
            $this->db->where('pt', $idPt)
                ->where('kategori > ', 1)
                ->where('tanggal_input', date('Y-m-d'));
            $this->db->limit($per_page, $halaman);
            $this->db->order_by('tanggal_input', 'ASC');
            $this->db->order_by('nama', 'ASC');
            $hasil = $this->db->get('visit')->result();
            foreach ($hasil as $row) {
                $tanggal[]  = $this->tanggal($row->tanggal_input);
                $isClose[]  = $row->is_close;
                $join[]     = $row->tanggal_join;
            }

            //perusahaan
            $db1 = $this->load->database('we', true);
            $perusahaan = $db1->query('SELECT id, db, name FROM ansena_department WHERE income = 1 AND id =' . $idPt)->result();
            $perusahaanArray = array();
            foreach ($perusahaan as $r) :
                $perusahaanArray['p' . $r->id] = $r->name;
                $db = $r->db;
                //brand
                $dbBrand = $this->load->database($db, true);
                $brand = $dbBrand->query('SELECT nama_franchise, id, id_franchise, office FROM ansena_franchise_list')->result();
                $brandArray = array();
                foreach ($brand as $row) {
                    $brandArray['b' . $row->id_franchise] = $row->nama_franchise;
                }
                $dbBrand->close();
            endforeach;
            $db1->close();

            $config['base_url'] = base_url() . 'visitor/ambilVisitPagination';
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

            $queryClosing = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE close IS null
                                                    AND tanggal_input = '$today'")->num_rows();

            $data['pagination'] = $this->pagination->create_links();
            $data['hasil']      = $hasil;
            $data['brandArray'] = $brandArray;
            $data['halaman']    = $halaman;
            $data['tanggal']    = $tanggal;
            $data['closing']    = $queryClosing;
            $data['isClose']    = $isClose;
            $data['join']       = $join;

            echo json_encode($data);
        }
    }

    public function ambilVisitTanggal($tanggalAwal, $tanggalAkhir, $halaman)
    {
        $per_page = 10;
        if ($halaman != 0) {
            $halaman = ($halaman - 1) * $per_page;
        } else {
            $halaman = 0;
        }

        $id = $_SESSION['pt'];
        //jumlah baris
        $this->db->select('id_visit');
        $this->db->where('tanggal_input >=', $tanggalAwal)
            ->where('tanggal_input <=', $tanggalAkhir)
            ->where('pt', $id)
            ->where('kategori >', 1);
        $jumlahBaris = $this->db->get('visit')->num_rows();
        if ($jumlahBaris == 0) {
            $jumlahBaris = "tidak ada data";
            echo json_encode($jumlahBaris);
        } else {
            // $hasil = $this->db->query("SELECT id_visit, nama, pt, brand, hp, tanggal_input, tanggal_join FROM visit WHERE tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' ORDER BY tanggal_input ASC");
            $this->db->select('id_visit, nama, pt, brand, hp, tanggal_input, tanggal_join, is_close, kategori');
            $this->db->where('tanggal_input >=', $tanggalAwal)
                ->where('tanggal_input <=', $tanggalAkhir)
                ->where('pt', $id)
                ->where('kategori >', 1);
            $this->db->limit($per_page, $halaman);
            $this->db->order_by('tanggal_input', 'asc');
            $this->db->order_by('nama', 'asc');
            $hasil = $this->db->get('visit')->result();
            foreach ($hasil as $row) {
                $tanggal[] = $this->tanggal($row->tanggal_input);
                $isClose[] = $row->is_close;
                $join[]    = $row->tanggal_join;
            }


            //perusahaan
            $db1 = $this->load->database('we', true);
            $perusahaan = $db1->query('SELECT id, db, name FROM ansena_department WHERE id = ' . $id)->result();
            $perusahaanArray = array();
            foreach ($perusahaan as $row) :
                $perusahaanArray['p' . $row->id] = $row->name;
                $db = $row->db;

                //brand
                $dbBrand = $this->load->database($db, true);
                $brand = $dbBrand->query('SELECT nama_franchise, id, id_franchise, office FROM ansena_franchise_list')->result();
                $brandArray = array();
                foreach ($brand as $row) {
                    $brandArray['b' . $row->id_franchise] = $row->nama_franchise;
                }
                $dbBrand->close();
            endforeach;
            $db1->close();

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

            $data['pagination'] = $this->pagination->create_links();
            $data['hasil']      = $hasil;
            $data['brandArray'] = $brandArray;
            $data['halaman']    = $halaman;
            $data['tanggal']    = $tanggal;
            $data['tglTitleA']  = $this->tanggal($tanggalAwal);
            $data['tglTitleK']  = $this->tanggal($tanggalAkhir);
            $data['closing']    = ambilClosing()->num_rows();
            $data['isClose']    = $isClose;
            $data['join']       = $join;

            echo json_encode($data);
        }
    }

    public function cariBrand()
    {
        $per_page = 10;
        $halaman = $this->input->post('halaman');
        if ($halaman > 1) {
            $halaman = $halaman * $per_page - 10;
        } else {
            $halaman = 0;
        }
        $jumlahData = ambilData('visit')->num_rows();
        $link = ceil($jumlahData / $per_page);
        $jumlahData = ambilData('visit')->num_rows();
        $per_page = 10;
        $link = ceil($jumlahData / $per_page);

        $data = $this->input->post('data');

        //cari kategori inputan
        $id = $_SESSION['pt'];
        $hasilPencarian = $this->db->query("SELECT nama, hp, brand FROM visit WHERE nama LIKE '$data%' OR hp LIKE '$data%'")->num_rows(); //cek apakah yang diinput nama, hp atau brand

        //ambil id brand
        $db = $this->load->database('we', true);
        $cekDbBrand = $db->query('SELECT db FROM ansena_department WHERE id = ' . $id)->row_array();
        $dbB = $cekDbBrand['db'];

        $dbBrand = $this->load->database($dbB, true);
        $hasilPencarianBrand = $dbBrand->query("SELECT id_franchise, nama_franchise FROM ansena_franchise_list WHERE nama_franchise LIKE '$data%'")->num_rows();
        $dbBrand->close();
        // jika selain brand
        if ($hasilPencarianBrand > 0) {
            $hasil = $this->db->query("SELECT nama, hp, brand, tanggal_input, id_visit FROM visit WHERE nama LIKE '$data%' OR hp LIKE '$data%'")->result(); //hasil pencarian

            //ambil db
            $cekDb = $db->query("SELECT id, db FROM ansena_department WHERE income = 1 AND id = $id")->result();
            foreach ($cekDb as $row) {
                $db = $row->db;
            }

            //brand
            $dbBrand = $this->load->database($db, true);
            $brand = $dbBrand->query('SELECT id_franchise, nama_franchise FROM ansena_franchise_list')->result();
            $brandArr = array();
            foreach ($brand as $row) {
                $brandArr['b' . $row->id_franchise] = $row->nama_franchise;
            }
            $dbBrand->close();

            $data = [
                'visit'     => $hasil,
                'brandArr'  => $brandArr,
                'brandList' => $brand,
                'per_page'  => 0,
                'halaman'   => $halaman,
                'cek'       => 1,
                'jBrand'    => $hasilPencarianBrand
            ];
            $this->load->view('visitor/detailBrand', $data);
        } else {
            if ($hasilPencarianBrand > 0) {
                $id = $_SESSION['pt'];
                //ambil id brand
                $db = $this->load->database('we', true);
                $cekDb = $db->query('SELECT db FROM ansena_department WHERE id = ' . $id)->row_array();
                $dbB = $cekDb['db'];

                $dbBrand = $this->load->database($dbB, true);
                $brandCek = $dbBrand->query("SELECT id_franchise, nama_franchise FROM ansena_franchise_list WHERE nama_franchise LIKE '$data%'")->row_array();
                $idBrand = $brandCek['id_franchise'];

                $hasil = $this->db->query('SELECT nama, id_visit, brand, hp, tanggal_input FROM visit WHERE brand = ' . $idBrand)->result();

                //brand
                $brand = $dbBrand->query('SELECT id_franchise, nama_franchise FROM ansena_franchise_list')->result();
                $brandArr = array();
                foreach ($brand as $row) {
                    $brandArr['b' . $row->id_franchise] = $row->nama_franchise;
                }
                $dbBrand->close();

                $data = [
                    'visit'     => $hasil,
                    'brandArr'  => $brandArr,
                    'brandList' => $brand,
                    'per_page'  => 0,
                    'halaman'   => $halaman,
                    'cek'       => 1,
                    'jBrand'    => $hasilPencarianBrand
                ];
                $this->load->view('visitor/detailBrand', $data);
            } else {
                echo 'gagal';
            }
        }
    }

    public function ambilPt()
    {
        $db = $this->load->database('we', true);
        $hasil = $db->query('SELECT name FROM ansena_department WHERE id = ' . $_SESSION['pt'])->row_array();
        echo $hasil['name'];
    }

    public function ambilDetail()
    {
        $id = $this->input->post('id');
        $hasil = $this->db->query('SELECT nama, brand, marketing, pt, hp, alasan, kategori, umur, tanggal_join, tanggal_input FROM visit WHERE id_visit = ' . $id)->result();
        foreach ($hasil as $h) {
            $ptId = $h->pt;
        }

        //alasan
        $alasanList = $this->db->query('SELECT id, alasan FROM alasan WHERE role = 1')->result();

        //kategori
        $kategoriList = $this->db->query('SELECT id_visit, kategori FROM visit')->result();
        $kategoriArray = array();
        foreach ($kategoriList as $kat) {
            $kategoriArray['kat' . $kat->id_visit] = $kat->kategori;
        }


        //perusahaan
        $db1 = $this->load->database('we', true);
        $idP = $_SESSION['pt'];
        $perusahaan = $db1->query("SELECT id, db, name FROM ansena_department WHERE id = $idP")->result();
        $perusahaanArray = array();
        foreach ($perusahaan as $row) :
            $perusahaanArray['p' . $row->id] = $row->name;
            $dbB = $row->db;
        endforeach;

        //brand
        $dbBrand = $this->load->database($dbB, true);
        $daftarBrand = $dbBrand->query('SELECT nama_franchise, id, id_franchise FROM ansena_franchise_list')->result();
        $brand = $dbBrand->query('SELECT nama_franchise, id, id_franchise, office FROM ansena_franchise_list')->result();
        $brandArray = array();
        foreach ($brand as $row) {
            $brandArray['b' . $row->id_franchise] = $row->nama_franchise;
        }
        $dbBrand->close();
        $db1->close();

        //marketing
        $db4 = $this->load->database('we', true);
        if ($_SESSION['pt'] == 14) {
        } else {
            $daftarMarketing = $db4->query("SELECT name, id FROM ac_payroll_item WHERE office = $ptId AND division = 13 AND is_active = 1 ORDER BY name ASC")->result();
        }
        // $marketing = $db4->query('SELECT id, name FROM ac_payroll_item WHERE is_active = 1')->result();
        $marketing = ambilNama($_SESSION['pt']);
        $marketingArray = array();
        foreach ($marketing as $row) {
            $marketingArray['m' . $row->id] = $row->name;
        }
        $db4->close();


        $attr = [
            'hasil'         => $hasil,
            'pt'            => $perusahaan,
            'perusahaan'    => $perusahaanArray,
            'brand'         => $brandArray,
            'marketing'     => $marketingArray,
            'alasanList'    => $alasanList,
            'daftarMar'     => $daftarMarketing,
            'daftarBrand'   => $daftarBrand,
            'katArray'      => $kategoriArray
        ];
        $this->load->view('visitor/editVisitor', $attr);
    }

    public function ambilNama()
    {
        $id = $this->input->post('id');

        $hasil = ambilNama($id);
        echo json_encode($hasil);
    }

    public function ambilBrand()
    {
        $id = $this->input->post('id');
        $cekDb = $this->load->database('we', true);
        $hasilDb = $cekDb->query('SELECT db FROM ansena_department WHERE id = ' . $id)->row_array();
        $db = $hasilDb['db'];

        //brand
        $dbBrand = $this->load->database($db, true);
        $hasilBrand = $dbBrand->query('SELECT nama_franchise, id_franchise FROM ansena_franchise_list');
        $dbBrand->close();
        echo json_encode($hasilBrand->result());
    }

    public function ambilAlasan()
    {
        $id = $this->input->post('id');
        $hasil = $this->db->query("SELECT alasan, kategori, umur, prospek FROM visit WHERE id_visit = $id")->result();
        foreach ($hasil as $row) {
            $alasan = $row->alasan;
            $kategori = $row->kategori;
            $umur       = $row->umur;
            $prospek    = $row->prospek;
        }

        $data[] = [
            'alasan'    => $alasan,
            'kategori'  => $kategori,
            'umur'      => $umur,
            'prospek'   => $prospek
        ];

        echo json_encode($data);
    }

    public function tambahVisitor()
    {
        $str = $this->input->post('hp');
        $pattern = '/[^0-9]+/';
        $hp = preg_replace($pattern, '', $str);

        $cekHp = substr($hp, 0, 2);

      if ($cekHp == 62) {

        $lastNumber = preg_replace('/'. $cekHp .'/', '0', $hp);

      } else {

        $lastNumber = $hp;

      }

        $tanggal    = $this->input->post('tanggal');
        $nama       = $this->input->post('nama');
        $hp         = str_replace('-', '', $this->input->post('hp'));
        $pt         = $this->input->post('perusahaan');
        $brand      = $this->input->post('brand');
        $mark       = $this->input->post('marketing');
        $alas       = $this->input->post('alasan');
        $kelamin    = $this->input->post('kelamin');
        $umur       = $this->input->post('umur');
        $kota       = $this->input->post('kota');
        $kategori   = $this->input->post('kategori');
        $prospek    = $this->input->post('prospek');
        $sumber     = $this->input->post('sumber');
        $tgl        = date('Y-m-d');

        $cek = $this->db->query("SELECT nama FROM visit WHERE hp = $hp AND brand = $brand AND pt = $pt")->num_rows();
        if ($cek > 0) {
            echo 'Data sama';
        } else {
            $simpan = [
                'nama'  => $nama,
                'hp'    => $lastNumber,
                'sumber'    => $sumber,
                'pt'    => $pt,
                'brand'         => $brand,
                // 'tanggal_input' => $tgl,
                'marketing'     => $mark,
                'alasan'        => $alas,
                'j_kelamin'     => $kelamin,
                'umur'          => $umur,
                'id_kota'       => $kota,
                'kategori'      => $kategori,
                'prospek'       => $prospek,
                'tanggal_input' => $tanggal,
                'jam_visit'     => date('H:i'),
                'created_time'  => date('Y-m-d H:i:s')
            ];
            input('visit',  $simpan);

            //hitung jumlah inputan pada tanggal berjalan dan di masukan ke dalam variable
            $this->db->select('is_close');
            $this->db->where('is_close =', null)
                ->where('tanggal_input', date('Y-m-d'));
            $hasil = $this->db->get('visit');
            $_SESSION['isClose'] = $hasil->num_rows();
            
            print_r($simpan);
        }
    }

    public function editVisitor()
    {
        $id     = $this->input->post('id');
        $nama   = $this->input->post('nama');
        $pattern = '/[^0-9]+/';
        $hp     = preg_replace($pattern, '', $this->input->post('hp'));
        $pt     = $this->input->post('perusahaan');
        $brand  = $this->input->post('brand');
        $mark   = $this->input->post('marketing');
        $alas   = $this->input->post('alasan');
        $umur   = $this->input->post('umur');
        $kate   = $this->input->post('kategori');
        $pros   = $this->input->post('prospek');
        $tgl    = date('Y-m-d');
        $tanggalForm = $this->input->post('tanggal');

        //ambil tanggal input terakhir pada datbaase
        $cekTanggal = $this->db->query("SELECT tanggal_input
                                    FROM visit
                                    WHERE id_visit = $id")->row_array();

        $tanggalAwal = $cekTanggal['tanggal_input'];

        $edit = [
            'nama'  => $nama,
            'hp'    => $hp,
            'pt'    => $pt,
            'brand'         => $brand,
            'marketing'     => $mark,
            'alasan'        => $alas,
            'umur'          => $umur,
            'kategori'      => $kate,
            'prospek'       => $pros,
            'tanggal_input' => $tanggalForm
        ];

        $cek = $this->db->query("SELECT nama FROM visit WHERE hp = '$hp' AND brand = '$brand' AND alasan = '$alas' ")->num_rows();
        $cek2 = $this->db->query("SELECT alasan, brand FROM visit WHERE hp = '$hp' AND brand = '$brand'")->result();
        $cek3 = $this->db->query("SELECT nama FROM visit WHERE hp = '$hp' AND brand = '$brand'")->num_rows();
        foreach ($cek2 as $row) {
            $alasan = $row->alasan;
        }

        if ($cek3 == 1) {
            echo 'brand sama';
        } else {
            edit('visit',  $edit, array('id_visit'    => $id));
            if ($tanggalAwal == $tanggalForm) {
                echo 'tanggal tidak berubah';
            } else {
                echo $id;
            }
        }
    }

    public function editVisitor2()
    {
        $id     = $this->input->post('id');
        $nama   = $this->input->post('nama');
        $hp     = $this->input->post('hp');
        $pt     = $this->input->post('perusahaan');
        $brand  = $this->input->post('brand');
        $mark   = $this->input->post('marketing');
        $alas   = $this->input->post('alasan');
        $umur   = $this->input->post('umur');
        $kate   = $this->input->post('kategori');
        $pros   = $this->input->post('prospek');
        $tgl    = date('Y-m-d');
        $tanggalForm = $this->input->post('tanggal');

        //ambil tanggal input terakhir pada datbaase
        $cekTanggal = $this->db->query("SELECT tanggal_input
                                    FROM visit
                                    WHERE id_visit = $id")->row_array();

        $tanggalAwal = $cekTanggal['tanggal_input'];

        $edit = [
            'nama'  => $nama,
            'hp'    => $hp,
            'pt'    => $pt,
            'brand'         => $brand,
            'marketing'     => $mark,
            'alasan'        => $alas,
            'umur'          => $umur,
            'kategori'      => $kate,
            'prospek'       => $pros,
            'tanggal_input' => $tanggalForm
        ];
        edit('visit',  $edit, array('id_visit'    => $id));

        if ($tanggalAwal == $tanggalForm) {
            echo 'tanggal tidak berubah';
        } else {
            echo $id;
        }
    }

    public function hapus()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');

        hapus($table, array('id_visit' => $id));
    }

    public function ambilProv()
    {
        $id = $this->input->post('id');

        //load db we
        $db = $this->load->database('we', true);
        //provinsi
        $hasil = $db->query('SELECT id_prov, city_name FROM adm_city WHERE id_city = ' . $id)->row_array();
        $idProv = $hasil['id_prov'];
        $city = $hasil['city_name'];

        //ambil provinsi
        $prov = $db->query('SELECT prov_name FROM adm_prov WHERE id_prov = ' . $idProv)->row_array();
        $namaProv =  $prov['prov_name'];

        echo $namaProv;
    }

    public function cekDataDenganHp()
    {
        $hp = $this->input->post('hp');
        $hasil = $this->db->query('SELECT j_kelamin, umur FROM visit WHERE hp = ' . $hp);
        if ($hasil->num_rows() == 0) {
            echo json_encode('tidak ada');
        } else {
            echo json_encode($hasil->result());
        }
    }

    public function auto()
    {
        $data = $_GET['term'];
        $id = $_SESSION['pt'];
        //ambil Db brand
        $db = $this->load->database('we', true);
        $cekDb = $db->query('SELECT db FROM ansena_department WHERE id = ' . $id)->row_array();
        $dbB = $cekDb['db'];

        //brand
        $dbBrand = $this->load->database($dbB, true);
        $brand = $dbBrand->query("SELECT nama_franchise FROM ansena_franchise_list WHERE nama_franchise LIKE '$data%'")->result();
        $dbBrand->close();

        $nama = $this->db->query("SELECT nama FROM visit WHERE nama LIKE '$data%' lIMIT 1")->result();
        $hp = $this->db->query("SELECT hp FROM visit WHERE hp LIKE '$data%' lIMIT 1")->result();
        $array = array();
        foreach ($nama as $row) {
            $array[] = $row->nama;
        }
        foreach ($hp as $row) {
            $array[] = $row->hp;
        }
        foreach ($brand as $row) {
            $array[] = $row->nama_franchise;
        }
        echo json_encode($array);
    }

    /**
    * @param post data
    */
    public function sortingData()
    {
        $data   = $_POST['data'];
        $page   = $_POST['page'];
        $pt     = $_SESSION['pt'];

        $perPage = 10;
        if ($page != 0) {
            $page = ($page - 1) * $perPage;
        }

        $queryAll = $this->db->query("SELECT id_visit
                                        FROM visit
                                        WHERE nama LIKE '%$data%'");
        $rows = $queryAll->num_rows();

        $mainQuery = $this->db->query("SELECT id_visit, nama, hp
                                            FROM visit 
                                            WHERE nama LIKE '%$data%'
                                            LIMIT $perPage OFFSET $page");

        if ($mainQuery->num_rows() == 0) {
            $mainQuery = $this->db->query("SELECT id_visit, nama, hp
                                            FROM visit 
                                            WHERE hp LIKE '%$data%'
                                            LIMIT $perPage OFFSET $page");                      
        }

        
    }

    public function issetBrand()
    {
        //ambil db brand
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
        return $brandArray;
    }

    public function closing()
    {
        //ambil data untuk closing
        $idPt = $_SESSION['pt'];
        $this->db->select('brand, prospek, kategori');
        $this->db->where('is_close =', null)
            ->where('pt', $idPt)
            ->where('tanggal_input', date('Y-m-d'));
        $hasil = $this->db->get('visit');

        foreach ($hasil->result() as $row) {
            $brandA[]   = $row->brand; //brand
            $arr = array_unique($brandA); //brand
            $katVisit = $row->kategori; //kategori
        }

        //ambilBrand
        $dbBrand = $this->load->database('we', true);
        $brandList = $dbBrand->query('SELECT id_franchise, nama_franchise FROM ansena_franchise_list')->result();
        $brandArray = array();
        foreach ($brandList as $r) {
            $brandArray['b' . $r->id_franchise] = $r->nama_franchise;
        }
        $dbBrand->close();

        //jumlah respon
        $this->db->select('kategori');
        $this->db->where('tanggal_input', date('Y-m-d'))
            ->where('kategori', 3)
            ->where('pt', $idPt)
            ->where('is_close =', null);
        $jumRespon = $this->db->get('visit')->num_rows();

        //jumlah no respon
        $this->db->select('kategori');
        $this->db->where('tanggal_input', date('Y-m-d'))
            ->where('kategori', 2)
            ->where('pt', $idPt)
            ->where('is_close =', null);
        $jumNoRespon = $this->db->get('visit')->num_rows();

        //jumlah anak
        $this->db->select('kategori');
        $this->db->where('tanggal_input', date('Y-m-d'))
            ->where('kategori', 1)
            ->where('pt', $idPt)
            ->where('is_close =', null);
        $jumAnak = $this->db->get('visit')->num_rows();


        $data = [
            'hasil'     => $hasil->result(),
            'brandA'    => $arr,
            'katVisit'  => $katVisit,
            'respon'    => $jumRespon,
            'no'        => $jumNoRespon,
            'anak'      => $jumAnak,
            'brand'     => $this->issetBrand()
        ];

        $this->load->view('visitor/closing', $data);
    }

    public function prosesClosing()
    {
        $hariIni = date('Y-m-d');
        $tanggalPost = $this->input->post('tanggal');

        if ($hariIni == $tanggalPost) {
            //ambil data hari sesuai post dan ubah is_close
            $this->db->select('is_close');
            $this->db->where('tanggal_input', $tanggalPost);
            $hasil = $this->db->get('visit');
            $pt = $_SESSION['pt'];

            $dataUpdate = [
                'is_close'  => 1
            ];

            edit('visit', $dataUpdate, array('pt' => $pt, 'tanggal_input' => $tanggalPost));
        }
    }

    public function getVisitor($halaman) {

      $today = date('Y-m-d');
        $idPt = $_SESSION['pt'];

      //query
      $queryMaster = "SELECT id_visit
            FROM visit
            WHERE tanggal_join IS null
            AND is_close IS null
            AND pt = $idPt
            AND kategori > 1
            AND tanggal_input = '$today'";
      $resultMaster = $this->database->getData($queryMaster, 'visit');

      $jumlahData = $resultMaster->num_rows();
      $perPage = 10;

      if($halaman != 0) {
        $halaman = ($halaman - 1) * $perPage;
      }

      if ($jumlahData > 0) {

        //limit
        $queryLimit = "SELECT nama, hp, brand, pt, tanggal_input, id_visit
                    FROM visit
                    WHERE tanggal_join IS null
                    AND is_close IS null
                    AND kategori > 1
                    AND pt = $idPt
                    AND tanggal_input = '$today'
                    LIMIT $halaman, $perPage";
        $resultLimit = $this->database->getData($queryLimit, 'visit');

        //pt array
        $ptArray = array();

        if ($idPt != '41') {
            $queryPt = "SELECT id, name, db
                    FROM ansena_department
                    WHERE income = 1
                    AND id = $idPt";
            $resultPt = $this->database->getData($queryPt, 'we')->row_array();

            $dbPt = $resultPt['db'];
        } else {
            $dbPt = 'we';
        }

        //brand array
        $brandArray = array();

        $queryBrand = "SELECT id_franchise, nama_franchise, office
                      FROM ansena_franchise_list";
        $resultBrand = $this->database->getData($queryBrand, $dbPt);

        foreach($resultBrand->result() as $row) {

          $brandArray['b' . $row->id_franchise] = $row->nama_franchise;

        }
        
        foreach($resultLimit->result() as $r) {

          //brand name list
          if (isset($brandArray['b' . $r->brand])) {
            $brandName[] = $brandArray['b' . $r->brand];
          } else if ($idPt == '41') {
              $brandName[] = 'Pola Kain';
          }

          //other
          $nama[] = $r->nama;
          $hp[] = $r->hp;
          $tanggal[] = date('d M Y', strtotime($r->tanggal_input));
          $pesan = 'data ditemukan';
          $idVisit[] = $r->id_visit;

        }

        $config['base_url'] = base_url() . 'visitor/ambilVisitPagination';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $jumlahData;
        $config['per_page'] = $perPage;

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

        $pagination = $this->pagination->create_links();


      } else {

        $brandName[] = 0;
        $nama[] = 0;
        $hp[] = 0;
        $tanggal[] = 0;
        $pesan = 'tidak ada data';
        $pagination = 0;
        $idVisit[] = 0;

      }

      $data['namaBrand']  = $brandName;
      $data['nama']       = $nama;
      $data['hp']         = $hp;
      $data['tanggal']    = $tanggal;
      $data['idVisit']    = $idVisit;
      $data['pagination'] = $pagination;
      $data['pesan']      = $pesan;

      echo json_encode($data);

    }

    public function getVisitorMasterEdit($halaman) {

      $today = date('Y-m-d');
        $idPt = $_SESSION['pt'];

      //query
      $queryMaster = "SELECT id_visit
            FROM visit
            WHERE pt = $idPt
            AND kategori > 2
            AND tanggal_input = '$today'";
      $resultMaster = $this->database->getData($queryMaster, 'visit');

      $jumlahData = $resultMaster->num_rows();
      $perPage = 10;

      if($halaman != 0) {
        $halaman = ($halaman - 1) * $perPage;
      }

      if ($jumlahData > 0) {

        //limit
        $queryLimit = "SELECT nama, hp, brand, pt, tanggal_input, id_visit
                    FROM visit
                    WHERE kategori > 2
                    AND pt = $idPt
                    AND tanggal_input = '$today'
                    LIMIT $halaman, $perPage";
        $resultLimit = $this->database->getData($queryLimit, 'visit');

        //pt array
        $ptArray = array();

        if ($idPt != '41') {
            $queryPt = "SELECT id, name, db
                    FROM ansena_department
                    WHERE income = 1
                    AND id = $idPt";
            $resultPt = $this->database->getData($queryPt, 'we')->row_array();

            $dbPt = $resultPt['db'];
        } else {
            $dbPt = 'we';
        }

        //brand array
        $brandArray = array();

        $queryBrand = "SELECT id_franchise, nama_franchise, office
                      FROM ansena_franchise_list";
        $resultBrand = $this->database->getData($queryBrand, $dbPt);

        foreach($resultBrand->result() as $row) {

          $brandArray['b' . $row->id_franchise] = $row->nama_franchise;

        }
        
        foreach($resultLimit->result() as $r) {

          //brand name list
          if (isset($brandArray['b' . $r->brand])) {
            $brandName[] = $brandArray['b' . $r->brand];
          } else if ($idPt == '41') {
              $brandName[] = 'Pola Kain';
          }

          //other
          $nama[] = $r->nama;
          $hp[] = $r->hp;
          $tanggal[] = date('d M Y', strtotime($r->tanggal_input));
          $pesan = 'data ditemukan';
          $idVisit[] = $r->id_visit;

        }

        $config['base_url'] = base_url() . 'visitor/ambilVisitPagination';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $jumlahData;
        $config['per_page'] = $perPage;

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

        $pagination = $this->pagination->create_links();


      } else {

        $brandName[] = 0;
        $nama[] = 0;
        $hp[] = 0;
        $tanggal[] = 0;
        $pesan = 'tidak ada data';
        $pagination = 0;
        $idVisit[] = 0;

      }

      $data['namaBrand']  = $brandName;
      $data['nama']       = $nama;
      $data['hp']         = $hp;
      $data['tanggal']    = $tanggal;
      $data['idVisit']    = $idVisit;
      $data['pagination'] = $pagination;
      $data['pesan']      = $pesan;

      echo json_encode($data);

    }

    public function detailVisitor()
    {
      $idVisit = $this->input->post('idVisit');

      $query = "SELECT nama, hp, brand, pt, marketing, kategori, alasan, prospek, tanggal_input
              FROM visit
              WHERE id_visit = $idVisit";
      $result = $this->database->getData($query, 'visit');
    }

    public function newEditVisitor()
    {
      $idVisitor = $this->input->post('idVisitor');
      $today = date('Y-m-d');
      $idPt = $_SESSION['pt'];

      $query = "SELECT nama, hp, brand, pt, marketing, kategori, alasan, prospek, tanggal_input, umur, j_kelamin, sumber
              FROM visit
              WHERE id_visit = $idVisitor";
      $result = $this->database->getData($query, 'visit');

      // get db pt
      if ($idPt == '41') {
          $dbPt = 'we';
      } else {
          $queryPt = "SELECT db FROM ansena_department WHERE id = $idPt";
          $resultPt = $this->database->getData($queryPt, 'we')->row_array();
    
          $dbPt = $resultPt['db'];
      }

      //brand array
      $brandArray = array();
      $queryBrand = "SELECT id_franchise, nama_franchise
                  FROM ansena_franchise_list";
      $resultBrand = $this->database->getData($queryBrand, $dbPt);

      //alasan array
      $alasanArray = array();
      $queryAlasan = "SELECT alasan, id FROM alasan WHERE role > 0";
      $resultAlasan = $this->database->getData($queryAlasan, 'visit');

      if ($idPt == 41) {
            $resultOfAlasan = [
                '0'   => [
                    'id'      => 11,
                    'alasan'  => 'Modal'
                ],
                '1'   => [
                    'id'      => 12,
                    'alasan'  => 'Diskusi'
                ],
                '2'   => [
                    'id'      => 13,
                    'alasan'  => 'Design sendiri'
                ],
                '3'   => [
                    'id'      => 14,
                    'alasan'  => 'Tidak tertarik katalog'
                ],
                '4'   => [
                    'id'      => 15,
                    'alasan'  => 'Ongkir'
                ],
                '5'   => [
                    'id'      => 16,
                    'alasan'  => 'Beli satuan'
                ]
            ];
      } else {
          $resultOfAlasan = $resultAlasan->result();
      }

      //marketing list
      $marketingArray = array();
      $queryMarketing = "SELECT id, name
                        FROM ac_payroll_item
                        WHERE office = $idPt
                        AND division = 13
                        ORDER BY name ASC";
      $resultMarketing = $this->database->getData($queryMarketing, 'we');

      //looping
      foreach($resultBrand->result() as $br) {
        $brandArray['b' . $br->id_franchise] = $br->nama_franchise;
      }

      foreach($resultAlasan->result() as $al) {
        $alasanArray['al' . $al->id] = $al->alasan;
      }

      foreach($resultMarketing->result() as $mar) {
        $marketingArray['m' . $mar->id] = $mar->name;
      }


      foreach($result->result() as $row) {

        if (isset($brandArray['b' . $row->brand])) {

            $brandName = $brandArray['b' . $row->brand];

        } else {

            $brandName = 'Pola Kain';

        }

        if (isset($marketingArray['m' . $row->marketing])) {
          $selectedMarketing = $marketingArray['m' . $row->marketing];
        } else {
            $selectedMarketing = 'Pola kain';
        }

        $alasan = $row->alasan;

        if($alasan > 0) {

          if (isset($alasanArray['al' . $alasan])) {

            $newAlasan = $alasanArray['al' . $alasan];

          } else {
              
            switch ($alasan) {
                case '11':
                    $newAlasan = 'Rundingan';
                    break;

                case '12':
                    $newAlasan = 'Modal';
                    break;

                case '13':
                    $newAlasan = 'Design sendiri';
                    break;

                case '14':
                    $newAlasan = 'Model lain';
                    break;

                case '15':
                    $newAlasan = 'Ongkir';
                    break;

                case '16':
                    $newAlasan = 'Sample';
                    break;
            }

          }

        } else {

          $newAlasan = 'Tidak ada alasan';

        }

        $kategori = $row->kategori;
        $prospek = $row->prospek;
        $tanggalShow = date('d F Y', strtotime($row->tanggal_input));
        $tanggalInput = $row->tanggal_input;
        $nama = $row->nama;
        $hp = $row->hp;
        $umur = $row->umur;
        $jKel = $row->j_kelamin;
        $marketingId = $row->marketing;
        $brandId = $row->brand;
        $sumber = $row->sumber;

        //condition
        if($kategori == 1) {

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
      $data['alasanList'] = $resultOfAlasan;
      $data['kategori'] = $newKategori;
      $data['kategoriId'] = $kategori;
      $data['prospek'] = $prospek;
      $data['alasan'] = $newAlasan;
      $data['brand'] = $brandName;
      $data['tanggalShow'] = $tanggalShow;
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

    public function changeDate()
    {
      $date = $this->input->post('lastDate');

      echo date('d F Y', strtotime($date));
    }

    public function postEdit() {

      $nama = $this->input->post('nama');
      $hp = $this->input->post('hp');
      $sumber = $this->input->post('sumber');
      $marketing = $this->input->post('marketing');
      $brand = $this->input->post('brand');
      $kategori = $this->input->post('kategori');
      $umur = $this->input->post('umur');
      $alasan = $this->input->post('alasan');
      $prospek = $this->input->post('prospek');
      $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
      $idVisit = $this->input->post('idVisit');

      if($alasan == '') {

        $newAlasan = 0;

      } else {

        $newAlasan = $alasan;

      }

      if($prospek == '') {

        $newProspek = 0;

      } else {

        $newProspek = $prospek;

      }

      //edit data
      $dataEdit = [
        'nama'  => $nama,
        'hp'    => $hp,
        'sumber'    => $sumber,
        'marketing' => $marketing,
        'brand'     => $brand,
        'kategori'  => $kategori,
        'umur'  => $umur,
        'alasan'  => $newAlasan,
        'prospek' => $newProspek,
        'tanggal_input' => $tanggal
      ];

      $this->db->where('id_visit', $idVisit);
      $this->db->update('visit', $dataEdit);

      echo 'success';

    }

    public function deleteVisitor()
    {

      $idVisit = $this->input->post('idVisit');

      $this->db->where('id_visit', $idVisit);
      $this->db->delete('visit');

      $data['pesan'] = 'success';

      echo json_encode($data);

    }

    public function getMarketing()
    {

      $idPt = $_SESSION['pt'];

      if ($idPt == '41') {
          $id[] = '41';
          $name[] = 'Pola Kain';

          $data['id'] = $id;
          $data['name'] = $name;

          echo json_encode($data);
      } else {
            if ($idPt == '14') {
                $queryMarketing = "SELECT id, name
                            FROM ac_payroll_item
                            WHERE is_active = 1
                            AND office = $idPt
                            AND division = 81";
            } else {
                $queryMarketing = "SELECT id, name
                            FROM ac_payroll_item
                            WHERE is_active = 1
                            AND office = $idPt
                            AND division = 13";
            }

            $resultMarketing = $this->database->getData($queryMarketing, 'we');

            foreach ($resultMarketing->result() as $row) {

                $id[] = $row->id;
                $name[] = $row->name;
            }

            $data['id'] = $id;
            $data['name'] = $name;

            echo json_encode($data);
      }
    }

    public function getBrand()
    {
      $idPt = $_SESSION['pt'];

      if ($idPt == '41') {
          $id[] = '41';
          $brand[] = 'Pola Kain';

          $data['id'] = $id;
          $data['brand'] = $brand;

          echo json_encode($data);
      } else {
            //get db
            $queryDb = "SELECT db
                FROM ansena_department
                WHERE id = $idPt";
            $resultDb = $this->database->getData($queryDb, 'we')->row_array();

            $db = $resultDb['db'];

            $queryBrand = "SELECT id_franchise, nama_franchise
                  FROM ansena_franchise_list";
            $resultBrand = $this->database->getData($queryBrand, $db);

            foreach ($resultBrand->result() as $row) {

                $id[] = $row->id_franchise;
                $brand[] = $row->nama_franchise;
            }

            $data['id'] = $id;
            $data['brand'] = $brand;

            echo json_encode($data);
      }
    }

    public function getDataByTanggal($halaman = 0)
    {
      $tanggalAwal = $this->input->post('tanggalAwal');
      $tanggalAkhir = $this->input->post('tanggalAkhir');
      $idPt = $_SESSION['pt'];

      //query
      $queryMaster = "SELECT id_visit
              FROM visit
              WHERE tanggal_join IS null
              AND is_close IS null
              AND kategori > 1
              AND pt = $idPt
              AND tanggal_input >= '$tanggalAwal'
              AND tanggal_input <= '$tanggalAkhir'";
      $resultMaster = $this->database->getData($queryMaster, 'visit');

      $jumlahData = $resultMaster->num_rows();
      $perPage = '10';

      //if($halaman == '') {

        // $halaman = $this->input->post('halaman');


      // } else {
      //
      if ($halaman > 0) {
        $halaman = ($halaman - 1) * $perPage;
      }
      //
      // }

      if ($jumlahData > 0) {

        //limit
        $queryLimit = "SELECT nama, hp, brand, pt, tanggal_input, id_visit
                    FROM visit
                    WHERE tanggal_join IS null
                    AND is_close IS null
                    AND kategori > 1
                    AND pt = $idPt
                    AND tanggal_input >= '$tanggalAwal'
                    AND tanggal_input <= '$tanggalAkhir'
                    ORDER BY tanggal_input ASC, id_visit ASC
                    LIMIT $halaman, $perPage";
        $resultLimit = $this->database->getData($queryLimit, 'visit');

        //pt array
        $ptArray = array();

        if ($idPt == '41') {
            $dbPt = 'we';
        } else {
            $queryPt = "SELECT id, name, db
                      FROM ansena_department
                      WHERE income = 1
                      AND id = $idPt";
            $resultPt = $this->database->getData($queryPt, 'we')->row_array();
    
            $dbPt = $resultPt['db'];
        }

        //brand array
        $brandArray = array();

        $queryBrand = "SELECT id_franchise, nama_franchise, office
                      FROM ansena_franchise_list";
        $resultBrand = $this->database->getData($queryBrand, $dbPt);

        foreach($resultBrand->result() as $row) {

          $brandArray['b' . $row->id_franchise] = $row->nama_franchise;

        }

        foreach($resultLimit->result() as $r) {

          //brand name list
          if (isset($brandArray['b' . $r->brand])) {
            $brandName[] = $brandArray['b' . $r->brand];
          } else {
              $brandName[] = 'Pola Kain';
          }

          //other
          $nama[] = $r->nama;
          $hp[] = $r->hp;
          $tanggal[] = date('d M Y', strtotime($r->tanggal_input));
          $pesan = 'data ditemukan';
          $idVisit[] = $r->id_visit;
          $brandd[] = $r->brand;

        }

        $config['base_url'] = base_url() . 'visitor/getDataByTanggal/2';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $jumlahData;
        $config['per_page'] = $perPage;

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

        $pagination = $this->pagination->create_links();


      } else {

        $brandName[] = 0;
        $nama[] = 0;
        $hp[] = 0;
        $tanggal[] = 0;
        $pesan = 'tidak ada data';
        $pagination = 0;
        $idVisit[] = 0;

      }

      $data['namaBrand']  = $brandName;
      $data['nama']       = $nama;
      $data['hp']         = $hp;
      $data['tanggal']    = $tanggal;
      $data['idVisit']    = $idVisit;
      $data['pagination'] = $pagination;
      $data['pesan']      = $pesan;

      echo json_encode($data);
    }

    public function getDataByTanggalMasterEdit($halaman = 0)
    {
      $tanggalAwal = $this->input->post('tanggalAwal');
      $tanggalAkhir = $this->input->post('tanggalAkhir');
      $idPt = $_SESSION['pt'];

      //query
      $queryMaster = "SELECT id_visit
              FROM visit
              WHERE kategori > 2
              AND pt = $idPt
              AND tanggal_input >= '$tanggalAwal'
              AND tanggal_input <= '$tanggalAkhir'";
      $resultMaster = $this->database->getData($queryMaster, 'visit');

      $jumlahData = $resultMaster->num_rows();
      $perPage = '10';

      //if($halaman == '') {

        // $halaman = $this->input->post('halaman');


      // } else {
      //
      if ($halaman > 0) {
        $halaman = ($halaman - 1) * $perPage;
      }
      //
      // }

      if ($jumlahData > 0) {

        //limit
        $queryLimit = "SELECT nama, hp, brand, pt, tanggal_input, id_visit
                    FROM visit
                    WHERE kategori > 2
                    AND pt = $idPt
                    AND tanggal_input >= '$tanggalAwal'
                    AND tanggal_input <= '$tanggalAkhir'
                    ORDER BY tanggal_input ASC, id_visit ASC
                    LIMIT $halaman, $perPage";
        $resultLimit = $this->database->getData($queryLimit, 'visit');

        //pt array
        $ptArray = array();

        if ($idPt == '41') {
            $dbPt = 'we';
        } else {
            $queryPt = "SELECT id, name, db
                      FROM ansena_department
                      WHERE income = 1
                      AND id = $idPt";
            $resultPt = $this->database->getData($queryPt, 'we')->row_array();
    
            $dbPt = $resultPt['db'];
        }

        //brand array
        $brandArray = array();

        $queryBrand = "SELECT id_franchise, nama_franchise, office
                      FROM ansena_franchise_list";
        $resultBrand = $this->database->getData($queryBrand, $dbPt);

        foreach($resultBrand->result() as $row) {

          $brandArray['b' . $row->id_franchise] = $row->nama_franchise;

        }

        foreach($resultLimit->result() as $r) {

          //brand name list
          if (isset($brandArray['b' . $r->brand])) {
            $brandName[] = $brandArray['b' . $r->brand];
          } else {
              $brandName[] = 'Pola Kain';
          }

          //other
          $nama[] = $r->nama;
          $hp[] = $r->hp;
          $tanggal[] = date('d M Y', strtotime($r->tanggal_input));
          $pesan = 'data ditemukan';
          $idVisit[] = $r->id_visit;
          $brandd[] = $r->brand;

        }

        $config['base_url'] = base_url() . 'visitor/getDataByTanggal/2';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $jumlahData;
        $config['per_page'] = $perPage;

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

        $pagination = $this->pagination->create_links();


      } else {

        $brandName[] = 0;
        $nama[] = 0;
        $hp[] = 0;
        $tanggal[] = 0;
        $pesan = 'tidak ada data';
        $pagination = 0;
        $idVisit[] = 0;

      }

      $data['namaBrand']  = $brandName;
      $data['nama']       = $nama;
      $data['hp']         = $hp;
      $data['tanggal']    = $tanggal;
      $data['idVisit']    = $idVisit;
      $data['pagination'] = $pagination;
      $data['pesan']      = $pesan;

      echo json_encode($data);
    }

    public function cekData() {
        $hp = $_POST['hp'];
        $brand = $_POST['brand'];
        $pt = $_SESSION['pt'];

        $query = $this->db->query("SELECT id_visit, brand, tanggal_input, marketing, alasan, kategori, prospek, hp, nama, tanggal_join, sumber, j_kelamin, umur
                                            FROM visit 
                                            WHERE pt = $pt 
                                            AND brand = $brand
                                            AND hp = '$hp'");

        if ($query->num_rows() == 0) {
            echo 'continue';
        } else {
            //provinsi
            $queryKota = "SELECT city_name, id_city, id_prov FROM adm_city";
            $kota = $this->database->getData($queryKota, 'we')->result();

            //brand array
            //cek db 
            $ptId = $_SESSION['pt'];

            if ($ptId != '41') {
                $queryDb = "SELECT db FROM ansena_department WHERE id = $ptId";
                $resultDb = $this->database->getData($queryDb, 'we')->row_array();
                $dbPt = $resultDb['db'];
                $queryBrand = "SELECT id_franchise, nama_franchise
                                    FROM ansena_franchise_list";
                $resultBrand = $this->database->getData($queryBrand, $dbPt)->result();
    
                $brandArr = array();
                foreach($resultBrand as $b) {
                    $brandArr['b' . $b->id_franchise] = $b->nama_franchise;
                }
            } else {
                $resultBrand = '';
            }

            // marketing array 
            $queryM = "SELECT id, name 
                            FROM ac_payroll_item 
                            WHERE division = 13";
            $resultM = $this->database->getData($queryM, 'we')->result();

            $markArr = array();
            foreach ($resultM as $m) {
                $markArr['m' . $m->id] = $m->name; 
            }

            $latestMark = "SELECT id, name 
                                FROM ac_payroll_item
                                WHERE division = 13
                                AND is_active = 1
                                AND barcode IS NOT null";

            $resultLatestMark = $this->database->getData($latestMark, 'we')->result();

            //alasan array 
            if ($pt != 41) {
                $queryAlasan = $this->db->query("SELECT id, alasan
                                                        FROM alasan
                                                        WHERE role > 0");
                if ($queryAlasan->num_rows() > 0) {
                    $resultAlasan = $queryAlasan->result();
                } else {
                    $resultAlasan = '';
                }
            } else {
                $resultAlasan = [
              '0'   => [
                  'id'      => 11,
                  'alasan'  => 'Modal'
              ],
              '1'   => [
                  'id'      => 12,
                  'alasan'  => 'Diskusi'
              ],
              '2'   => [
                  'id'      => 13,
                  'alasan'  => 'Design sendiri'
              ],
              '3'   => [
                  'id'      => 14,
                  'alasan'  => 'Tidak tertarik katalog'
              ],
              '4'   => [
                  'id'      => 15,
                  'alasan'  => 'Ongkir'
              ],
              '5'   => [
                  'id'      => 16,
                  'alasan'  => 'Beli satuan'
              ]
            ];
            }

            foreach ($query->result() as $row) {
                $id = $row->id_visit;
                $brandDb = $row->brand;
                $tanggal = $row->tanggal_input;
                $marketing = $row->marketing;
                $alasan = $row->alasan;
                $kategori = $row->kategori;
                $prospek = $row->prospek;
                $nama = $row->nama;
                $join = $row->tanggal_join;
                $sumber = $row->sumber;
                $jkel = $row->j_kelamin;
                $umur = $row->umur;
            }

            //sumber 
            if ($sumber != '') {
                switch ($sumber) {
                    case '1':
                        $sumberName = 'Instagram ads';
                        break;

                    case '2':
                        $sumberName = 'Facebook ads';
                        break;

                    case '3':
                        $sumberName = 'Ayo waralaba';
                        break;

                    case '4':
                        $sumberName = 'Waralabaku';
                        break;
                    
                    case '5':
                        $sumberName = 'Dunia franchise';
                        break;

                    case '6':
                        $sumberName = 'Website';
                        break;

                    case '7':
                        $sumberName = 'Direct';
                        break;

                    case '8':
                        $sumberName = 'Tiktok Ads';
                        break;
                }
            } else {
                $sumberName = '-';
            }

            //kategori 
            if ($kategori != '') {
                switch ($kategori) {
                    case '3':
                        $kategoriName = 'Respon';
                        break;

                    case '2':
                        $kategoriName = 'No respon';
                        break;

                    case '3':
                        $kategoriName = 'Anak - anak';
                        break;
                }
            } else {
                $kategoriName = '';
            }

            //brand name 
            if (isset ($brandArr['b' . $brandDb])) {
                $brandName = $brandArr['b' . $brandDb];
            } else {
                $brandName = 'Pola Kain';
            }

            //marketing name 
            if ($pt == '41') {
                $marketingName = 'Pola Kain';
            } else {
                if (isset ($markArr['m' . $marketing])) {
                    $marketingName = $markArr['m' . $marketing];
                }
            }

            //condition join 
            if ($join != '') {
                $statusJoin = 'Sudah join';
                $tanggalJoin = date('d M Y', strtotime($join));
            } else {
                $statusJoin = 'Belum join';
                $tanggalJoin = '-';
            }

            $data = [
                'nama' => $nama,
                'hp' => $hp,
                'brandId' => $brandDb,
                'brandName' => $brandName,
                'brandList'     => $resultBrand,
                'marketingName' => $marketingName,
                'marketingId' => $marketing,
                'marketingList' => $resultLatestMark,
                'tanggalInput'  => $tanggal,
                'tanggalShow'   => date('d M Y', strtotime($tanggal)),
                'statusJoin'    => $statusJoin,
                'tanggalJoin'   => $tanggalJoin,
                // 'kota'          => $kota,
                'sumberName'    => $sumberName,
                'sumberId'      => $sumber,
                'jkel'          => $jkel,
                'umur'          => $umur,
                'kategoriName'  => $kategoriName,
                'kategoriId'    => $kategori,
                'prospek'       => $prospek,
                'alasanId'      => $alasan,
                'alasanList'    => $resultAlasan,
                'idVisit'       => $id,
                'message'       => 'break'
            ];

           $this->load->view('visitor/modal_confirmation', $data);

        }
    }

    // #################################################### helper #################################################### //

    public function tanggal($data) {
        $explode = explode('-', $data);
        $tahun = $explode[0];
        $bulan = $explode[1];
        $hari = $explode[2];
        if ($bulan == 1) {
            $bulan = 'Januari';
        } else if ($bulan == 2) {
            $bulan = 'Febuari';
        } elseif ($bulan == 3) {
            $bulan = 'Maret';
        } elseif ($bulan == 4) {
            $bulan = 'April';
        } elseif ($bulan == 5) {
            $bulan == 'Mei';
        } elseif ($bulan == 6) {
            $bulan = 'Juni';
        } elseif ($bulan == 7) {
            $bulan = 'Juli';
        } elseif ($bulan == 8) {
            $bulan = 'Agustus';
        } elseif ($bulan == 9) {
            $bulan = 'September';
        } elseif ($bulan == 10) {
            $bulan = 'Oktober';
        } elseif ($bulan == 11) {
            $bulan = 'November';
        } else {
            $bulan = 'Desember';
        }
        $tanggal = $hari . ' ' . $bulan . ' ' . $tahun;
        return $tanggal;
    }

    // #################################################### end helper #################################################### //

}
