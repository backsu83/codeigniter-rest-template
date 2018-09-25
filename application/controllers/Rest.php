<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

class Rest extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    public function index_get()
    {
        // 로거 채널 생성
        echo 'get';
    }

    public function index_post()
    {
        echo 'post';
    }
}
