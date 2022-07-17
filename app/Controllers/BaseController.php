<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\StokBarangModel;
use App\Models\BarangModel;
use App\Models\SatuanBarangModel;
use App\Models\JenisBarangModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\PengeluaranModel;
use App\Models\SupplierModel;
use App\Models\OutletModel;
use App\Models\BarangKeluarModel;
use App\Models\PesananModel;
use App\Models\AturanBarangModel;
use App\Models\ResepDetailModel;
use App\Models\PembelianModel;
use App\Models\PembelianDetailModel;
use App\Models\PenjualanBarangModel;
use App\Models\PenjualanBarangDetailModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->stokBarangModel = new StokBarangModel();
        $this->barangModel = new BarangModel();
        $this->satuanBarangModel = new SatuanBarangModel();
        $this->jenisBarangModel = new JenisBarangModel();

        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
        $this->pengeluaranModel = new PengeluaranModel();
        $this->supplierModel = new SupplierModel();
        $this->outletModel = new OutletModel();
        $this->barangKeluarModel = new BarangKeluarModel();

        $this->pesananModel = new PesananModel();

        $this->aturanModel = new AturanBarangModel();
        $this->resepDetailModel = new ResepDetailModel();
        $this->pembelianModel = new PembelianModel();
        $this->pembelianDetailModel = new PembelianDetailModel();
        $this->penjualanBarangModel = new PenjualanBarangModel();
        $this->penjualanBarangDetailModel = new PenjualanBarangDetailModel();
    }

    function tanggal($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    function sendNotification($id_user, $judul, $pesan, $url)
    {
        $today = date('Y-m-d H:i:s');
        $builder = $this->db->table('tbl_notifikasi');

        $builder->insert([
            'notifikasi_user_id' => $id_user,
            'notifikasi_judul' => $judul,
            'notifikasi_pesan' => $pesan,
            'notifikasi_url' => $url,
            'notifikasi_tanggal' => $today,
        ]);
    }
}
