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
use App\Models\StokObatModel;
use App\Models\ObatModel;
use App\Models\ResepModel;
use App\Models\PasienModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\PengeluaranModel;
use App\Models\SupplierModel;
use App\Models\BarangKeluarModel;
use App\Models\AksesModel;
use App\Models\HakAksesModel;
use App\Models\LPLPOModel;
use App\Models\PesananModel;
use App\Models\DokterModel;
use App\Models\AturanObatModel;
use App\Models\ResepDetailModel;
use App\Models\PembelianModel;
use App\Models\PembelianDetailModel;

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
        $this->stokObatModel = new StokObatModel();
        $this->obatModel = new ObatModel();
        $this->resepModel = new ResepModel();
        $this->pasienModel = new PasienModel();
        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
        $this->pengeluaranModel = new PengeluaranModel();
        $this->supplierModel = new SupplierModel();
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->lplpoModel = new LPLPOModel();
        $this->pesananModel = new PesananModel();
        $this->dokterModel = new DokterModel();
        $this->aturanModel = new AturanObatModel();
        $this->resepDetailModel = new ResepDetailModel();
        $this->pembelianModel = new PembelianModel();
        $this->pembelianDetailModel = new PembelianDetailModel();

        // Access Rights
        $this->aksesModel = new AksesModel();
        $this->hakAksesModel = new HakAksesModel();
        $hakAkses = $this->hakAksesModel->findAll();
        $loginId = session()->get('roles');
        if (isset($loginId)) {
            foreach ($hakAkses as $akses) {
                if ($akses['id_role'] == $loginId['id_role']) {
                    $this->accessRights[] = $this->aksesModel->find($akses['id_menu']);
                }
            }
        }
    }

    public function tgl_indo($tanggal)
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

        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal

        return $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
