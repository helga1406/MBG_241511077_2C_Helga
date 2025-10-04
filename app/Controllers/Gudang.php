<?php

namespace App\Controllers;

use App\Models\BahanModel;

class Gudang extends BaseController
{
    protected $bahanModel;

    public function __construct()
    {
        $this->bahanModel = new BahanModel();
    }

    // ================= DASHBOARD =================
    public function dashboard()
    {
        return view('gudang/dashboard');
    }

    // ================= HELPER PRIVATE FUNCTION =================
    private function validateBahan($jumlah, $tglMasuk, $tglExpired)
    {
        if ($jumlah < 0) {
            return 'Jumlah tidak boleh kurang dari 0.';
        }
        if ($tglExpired < $tglMasuk) {
            return 'Tanggal kadaluarsa tidak boleh sebelum tanggal masuk.';
        }
        return null;
    }

    // ================= CRUD BAHAN =================

    public function bahanCreate()
    {
        return view('gudang/bahan/create');
    }

    public function bahanStore()
    {
        $nama       = $this->request->getPost('nama');
        $kategori   = $this->request->getPost('kategori');
        $jumlah     = (int)$this->request->getPost('jumlah');
        $satuan     = $this->request->getPost('satuan');
        $tglMasuk   = $this->request->getPost('tanggal_masuk');
        $tglExpired = $this->request->getPost('tanggal_kadaluarsa');

        // Validasi
        $error = $this->validateBahan($jumlah, $tglMasuk, $tglExpired);
        if ($error) {
            return redirect()->back()->withInput()->with('error', $error);
        }

        $this->bahanModel->save([
            'nama'               => $nama,
            'kategori'           => $kategori,
            'jumlah'             => $jumlah,
            'satuan'             => $satuan,
            'tanggal_masuk'      => $tglMasuk,
            'tanggal_kadaluarsa' => $tglExpired,
            'created_at'         => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('gudang/bahan'))->with('success', 'Bahan berhasil ditambahkan.');
    }
}