<?php
// if (!function_exists('Main')) {
    
    function ambilData($table)
    {
        $d = get_instance();
        $hasil = $d->db->get($table);
        return $hasil;
    }

    function ambilPagination($limit, $mulai, $table, $idPt)
    {
        $d = get_instance();
        $d->db->select('*');
        $d->db->limit($limit, $mulai);
        $d->db->order_by('tanggal_input', 'ASC');
        $d->db->where('tanggal_input', date('Y-m-d'));
        $d->db->where('kategori >', 1);
        // dept
        $d->db->where('pt', $idPt);
        $hasil = $d->db->get($table);
        return $hasil;
    }

    function ambilPaginationClosing($limit, $mulai, $table, $idPt)
    {
        $d = get_instance();
        $d->db->select('*');
        $d->db->limit($limit, $mulai);
        $d->db->order_by('tanggal_input', 'ASC');
        $d->db->where('pt', $idPt);
        $d->db->where('is_close =', null);
        $hasil = $d->db->get($table);
        return $hasil;
    }

    function ambilClosing()
    {
        $d = get_instance();
        $d->db->select('*');
        $d->db->order_by('tanggal_input', 'ASC');
        $d->db->where('tanggal_input', date('Y-m-d'));
        $d->db->where('is_close =', null);
        $hasil = $d->db->get('visit');
        return $hasil;
    }

    function ambilPaginationAlasan($limit, $mulai, $table)
    {
        $d = get_instance();
        $d->db->select('*');
        $d->db->limit($limit, $mulai);
        $d->db->where('role', 1);
        $hasil = $d->db->get($table);
        return $hasil;
    }

    function ambilSeleksi($limit, $mulai)
    {
        $d = get_instance();
        $d->db->select('*');
        $d->db->limit($limit, $mulai);
        $hasil = $d->db->get('visit');
        return $hasil;
    }

    function ambilWhere($where, $table)
    {
        $d = get_instance();
        $d->db->where($where);
        $hasil = $d->db->get($table);
        return $hasil;
    }

    function input($table, $data)
    {
        $d = get_instance();
        $d->db->insert($table, $data);
    }

    function edit($table, $data, $array)
    {
        $d = get_instance();
        $d->db->where($array);
        $d->db->update($table, $data);
    }

    function inputBatch($table, $data)
    {
        $d = get_instance();
        $d->db->insert_batch($table, $data);
    }

    function ubah($table, $data, $where)
    {
        $d = get_instance();
        $d->db->where($where);
        $d->db->update($table, $data);
    }

    function hapus($table, $array)
    {
        $d = get_instance();
        $d->db->where($array);
        $d->db->delete($table);
    }

    function bulan($data)
    {
        $ex = explode(',', $data);
        $bulan = $ex[0];
        $tahun = $ex[1];
        if ($bulan == 'January') {
            $bulan = 01;
        } elseif ($bulan == 'February') {
            $bulan = 02;
        } elseif ($bulan == 'March') {
            $bulan = 03;
        } elseif ($bulan == 'April') {
            $bulan = 04;
        } elseif ($bulan == 'May') {
            $bulan = 05;
        } elseif ($bulan == 'June') {
            $bulan = 06;
        } elseif ($bulan == 'July') {
            $bulan = 07;
        } elseif ($bulan == 'August') {
            $bulan = '08';
        } elseif ($bulan == 'September') {
            $bulan = '09';
        } elseif ($bulan == 'October') {
            $bulan = '10';
        } elseif ($bulan == 'November') {
            $bulan = '11';
        } else {
            $bulan = '12';
        }
        $tanggal = $tahun . '-' . $bulan;
        return $tanggal;
    }

    function hari($data)
    {
        $ex = explode('-', $data);
        $tahun = $ex[0];
        $bulan = $ex[1];
        $hari = $ex[2];

        if ($hari == 'Sat') {
            $hari = 'Sabtu';
        } elseif ($hari == 'Sun') {
            $hari = 'Minggu';
        } elseif ($hari == 'Mon') {
            $hari = 'Senin';
        } elseif ($hari == 'Tue') {
            $hari = 'Selasa';
        } elseif ($hari == 'Wed') {
            $hari = 'Rabu';
        } elseif ($hari == 'Thu') {
            $hari = 'Kamis';
        } else {
            $hari = 'Jumat';
        }

        return $hari;
    }
// }
