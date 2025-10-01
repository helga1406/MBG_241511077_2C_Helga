<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\BahanModel;

class Permintaan extends BaseController
{
    public function index()
    {
        $model = new PermintaanModel();
        $data['permintaan'] = $model
            ->where('pemohon_id', session()->get('id')) // hanya permintaan milik dapur yang login
            ->findAll();

        return view('permintaan/index', $data);
    }

    public function create()
    {
        $bahanModel = new BahanModel();
        // Ambil bahan yang stok > 0 dan belum kadaluarsa
        $data['bahan'] = $bahanModel
            ->where('jumlah >', 0)
            ->where('status !=', 'kadaluarsa')
            ->findAll();

        return view('permintaan/create', $data);
    }

    public function store()
    {
        $permintaanModel = new PermintaanModel();
        $detailModel     = new PermintaanDetailModel();

        $dataPermintaan = [
            'pemohon_id'   => session()->get('id'),
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'menunggu', // default
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        // Simpan permintaan utama
        $permintaanModel->insert($dataPermintaan);
        $permintaan_id = $permintaanModel->getInsertID();

        // Simpan detail permintaan (loop daftar bahan)
        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlahs   = $this->request->getPost('jumlah_diminta');

        if ($bahan_ids && $jumlahs) {
            foreach ($bahan_ids as $i => $bahan_id) {
                if (!empty($bahan_id) && $jumlahs[$i] > 0) {
                    $detailModel->insert([
                        'permintaan_id' => $permintaan_id,
                        'bahan_id'      => $bahan_id,
                        'jumlah_diminta'=> $jumlahs[$i]
                    ]);
                }
            }
        }

        return redirect()->to('/permintaan')->with('msg', 'Permintaan berhasil dibuat!');
    }

    public function show($id)
    {
        $permintaanModel = new PermintaanModel();
        $detailModel     = new PermintaanDetailModel();

        $data['permintaan'] = $permintaanModel->find($id);
        $data['detail']     = $detailModel
            ->select('permintaan_detail.*, bahan_baku.nama')
            ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
            ->where('permintaan_id', $id)
            ->findAll();

        return view('permintaan/show', $data);
    }
}
