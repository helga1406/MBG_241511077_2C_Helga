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

    private function hitungStatus($jumlah, $kadaluarsa)
    {
        $today = date('Y-m-d');
        if ($jumlah <= 0) {
            return "Habis";
        } elseif ($today >= $kadaluarsa) {
            return "Kadaluarsa";
        } elseif ((strtotime($kadaluarsa) - strtotime($today)) / 86400 <= 3) {
            return "Segera Kadaluarsa";
        }
        return "Tersedia";
    }

    // ================= CRUD BAHAN =================
    public function bahanIndex()
    {
        $bahan = $this->bahanModel->findAll();
        foreach ($bahan as &$row) {
            $row['status'] = $this->hitungStatus($row['jumlah'], $row['tanggal_kadaluarsa']);
        }
        return view('gudang/bahan/index', ['bahan' => $bahan]);
    }

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