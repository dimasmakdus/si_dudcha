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
use App\Models\PengeluaranModel;
use App\Models\SupplierModel;
use App\Models\BarangKeluarModel;

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

        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->stokObatModel = new StokObatModel();
        $this->obatModel = new ObatModel();
        $this->resepModel = new ResepModel();
        $this->pasienModel = new PasienModel();
        $this->permintaanModel = new PermintaanModel();
        $this->pengeluaranModel = new PengeluaranModel();
        $this->supplierModel = new SupplierModel();
        $this->barangKeluarModel = new BarangKeluarModel();
    }
}
