<?php defined('BASEPATH') or exit('No direct script access allowed');
class pdf
{

    public function __construct()
    {
        include_once APPPATH . '/third_party/fpdf184/fpdf.php';
    }
}
