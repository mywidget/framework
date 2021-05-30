<?php
class Home extends SENE_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->lib("sene_json_engine", "json");
  }
  public function index(){
    $data = array();
    $data['status'] = 404;
    $data['message'] = 'Not found';
    $data['data'] = array();
    $this->json->out($data);
  }
}