<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class Dapur extends BaseController
{
    protected $bahanModel;
    protected $permintaanModel;
    protected $permintaanDetailModel;

    public function __construct()
    {
        $this->bahanModel = new BahanModel();
        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
    }

    // ================= DASHBOARD =================
    public function dashboard()
    {
        return view('dapur/dashboard');
    }

    // ================= PERMINTAAN =================

    // Form ajukan permintaan
    public function permintaanCreate()
    {
        // Ambil bahan yang masih ada stok & belum kadaluarsa
        $bahan = $this->bahanModel
            ->where('jumlah >', 0)
            ->where('tanggal_kadaluarsa >', date('Y-m-d'))
            ->findAll();

        return view('dapur/permintaan/create', ['bahan' => $bahan]);
    }

    // Simpan permintaan baru
    public function permintaanStore()
    {
        // Insert ke tabel permintaan
        $this->permintaanModel->insert([
            'pemohon_id'   => session()->get('id'),
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'menunggu',
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        $permintaanId = $this->permintaanModel->getInsertID();

        // Insert detail bahan
        $bahan_id = $this->request->getPost('bahan_id');
        $jumlah   = $this->request->getPost('jumlah');

        if ($bahan_id && $jumlah) {
            foreach ($bahan_id as $i => $bid) {
                if (!empty($bid) && !empty($jumlah[$i])) {
                    $this->permintaanDetailModel->insert([
                        'permintaan_id'  => $permintaanId,
                        'bahan_id'       => $bid,
                        'jumlah_diminta' => $jumlah[$i],
                    ]);
                }
            }
        }

        return redirect()->to(base_url('dapur/permintaan'))
            ->with('success', 'Permintaan berhasil diajukan.');
    }

    // Lihat daftar permintaan (punya dapur yang login)
    public function permintaanIndex()
    {
        $permintaan = $this->permintaanModel
            ->select('permintaan.*, users.name as nama_pemohon')
            ->join('users', 'users.id = permintaan.pemohon_id')
            ->where('pemohon_id', session()->get('id'))
            ->orderBy('permintaan.created_at', 'ASC')
            ->findAll();

        // Tambahkan detail bahan tiap permintaan
        foreach ($permintaan as &$p) {
            $p['detail'] = $this->permintaanDetailModel
                ->select('permintaan_detail.*, bahan_baku.nama, bahan_baku.satuan')
                ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                ->where('permintaan_detail.permintaan_id', $p['id'])
                ->findAll();
        }

        return view('dapur/permintaan/index', ['permintaan' => $permintaan]);
    }
}
