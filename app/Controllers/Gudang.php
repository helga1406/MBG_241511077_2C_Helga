<?php

namespace App\Controllers;

use App\Models\BahanModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class Gudang extends BaseController
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
            'status'             => $this->hitungStatus($jumlah, $tglExpired), // status otomatis
            'created_at'         => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('gudang/bahan'))->with('success', 'Bahan berhasil ditambahkan.');
    }

    public function bahanEdit($id)
    {
        $bahan = $this->bahanModel->find($id);
        if (!$bahan) {
            return redirect()->to(base_url('gudang/bahan'))->with('error', 'Data tidak ditemukan.');
        }
        return view('gudang/bahan/edit', ['bahan' => $bahan]);
    }

    public function bahanUpdate($id)
    {
        $jumlah     = (int)$this->request->getPost('jumlah');
        $tglMasuk   = $this->request->getPost('tanggal_masuk');
        $tglExpired = $this->request->getPost('tanggal_kadaluarsa');

        // Validasi
        $error = $this->validateBahan($jumlah, $tglMasuk, $tglExpired);
        if ($error) {
            return redirect()->back()->with('error', $error);
        }

        $this->bahanModel->update($id, [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $jumlah,
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $tglMasuk,
            'tanggal_kadaluarsa' => $tglExpired,
            'status'             => $this->hitungStatus($jumlah, $tglExpired) // status otomatis
        ]);

        return redirect()->to(base_url('gudang/bahan'))->with('success', 'Bahan berhasil diupdate.');
    }

    public function bahanDeleteConfirm($id)
    {
        $bahan = $this->bahanModel->find($id);
        if (!$bahan) {
            return redirect()->to(base_url('gudang/bahan'))->with('error', 'Data tidak ditemukan.');
        }

        // Hitung ulang status berdasarkan tanggal hari ini
        $bahan['status'] = $this->hitungStatus($bahan['jumlah'], $bahan['tanggal_kadaluarsa']);

        return view('gudang/bahan/delete', ['bahan' => $bahan]);
    }

    public function bahanDelete($id)
    {
        $bahan = $this->bahanModel->find($id);
        if (!$bahan) {
            return redirect()->to(base_url('gudang/bahan'))->with('error', 'Data bahan tidak ditemukan.');
        }

        $today = date('Y-m-d');
        if (!($today >= $bahan['tanggal_kadaluarsa'])) {
            return redirect()->to(base_url('gudang/bahan'))->with('error', 'Hanya bahan kadaluarsa yang bisa dihapus.');
        }

        $this->bahanModel->delete($id);
        return redirect()->to(base_url('gudang/bahan'))->with('success', 'Bahan berhasil dihapus.');
    }

    // ================= PERMINTAAN =================

    public function permintaanIndex()
    {
        $permintaan = $this->permintaanModel
            ->select('permintaan.id, users.name as nama_pemohon, permintaan.menu_makan, permintaan.jumlah_porsi, permintaan.tgl_masak, permintaan.status, permintaan.created_at')
            ->join('users', 'users.id = permintaan.pemohon_id')
            ->orderBy('permintaan.created_at', 'ASC')
            ->findAll();

        return view('gudang/permintaan/index', ['permintaan' => $permintaan]);
    }

}
