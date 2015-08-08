<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect('/core/index');
    }
}
