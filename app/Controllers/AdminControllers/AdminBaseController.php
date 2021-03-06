<?php

namespace App\Controllers\AdminControllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AdminBaseController
 *
 * AdminBaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends AdminBaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class AdminBaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $session_ignore_urls=['admin-login-view','admin-login-check'];
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
        $this->session = \Config\Services::session(); 
        if ( in_array($request->getPath(),$this->session_ignore_urls))
        {

        }
        else{
                // trying to acces admin pages 
            if ( $this->session->get('admin_user_data'))
            {
                if ( $this->session->get('admin_user_data')['is_admin']=="0")
                {
                    //$this->load->helper('url');
                        header('Location:'.base_url());
                        exit();
                }
            }
            else{
                header('Location:'.base_url());
                        exit();
            }
        }
        
        
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
