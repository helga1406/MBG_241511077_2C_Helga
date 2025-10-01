<?php

namespace App\Controllers;

use App\Models\BahanModel;

class Bahan extends BaseController
{
    public function index()
    {
        $model = new BahanModel();
        $bahan = $model->findAll();

        // Hitung status otomatis setiap kali ditampilkan
        foreach ($bahan as &$b) {
            $today = date('Y-m-d');

            if ($b['jumlah'] == 0) {
                $b['status'] = 'habis';
            } elseif ($today >= $b['tanggal_kadaluarsa']) {
                $b['status'] = 'kadaluarsa';
            } elseif ((strtotime($b['tanggal_kadaluarsa']) - strtotime($today)) / 86400 <= 3) {
                $b['status'] = 'segera_kadaluarsa';
            } else {
                $b['status'] = 'tersedia';
            }
        }

        $data['bahan'] = $bahan;
        return view('bahan/index', $data);
    }

    public function create()
    {
        return view('bahan/create');
    }

    public function store()
    {
        $model = new BahanModel();

        $jumlah = $this->request->getPost('jumlah');
        $tgl_kadaluarsa = $this->request->getPost('tanggal_kadaluarsa');
        $today = date('Y-m-d');

        // Hitung status otomatis
        if ($jumlah == 0) {
            $status = 'habis';
        } elseif ($today >= $tgl_kadaluarsa) {
            $status = 'kadaluarsa';
        } elseif ((strtotime($tgl_kadaluarsa) - strtotime($today)) / 86400 <= 3) {
            $status = 'segera_kadaluarsa';
        } else {
            $status = 'tersedia';
        }

        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $jumlah,
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $tgl_kadaluarsa,
            'status'             => $status,
            'created_at'         => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);

        return redirect()->to('/bahan')->with('msg', 'Bahan berhasil ditambahkan!');
    }
}
