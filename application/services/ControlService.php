<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class ControlService
{
    public function __construct()
    {
        $_ci =& get_instance();
        $this->_ci = $_ci;
        //$this->_ci->load->model('controlModel');
    }
}
