<?php

namespace App\Controllers\UserControllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

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
class UserBaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $session_ignore_urls=['login-view','login-check',"/"];
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
        $this->session = \Config\Services::session(); 
        helper(['common_functions','url']);
      
        
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        if ( in_array($request->getPath(),$this->session_ignore_urls))
        {

        }
        else{
                // trying to acces admin pages 
            if ( $this->session->get('user_data'))
            {
                
            }
            else{
                //$this->load->helper('url');
                header('Location:'.base_url().'/login-view');
                exit();
                //return redirect()->to('url'); 
            
            }
        }

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
