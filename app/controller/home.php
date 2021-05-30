<?php
class Home extends SENE_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
    $this->load("a_apikey_model", "aakm");
  }
  public function index()
  {
    $data = array();
    $this->setTitle('Seme Framework Introduction!');
    $this->setDescription("Congratulation, you have done well.");
    $this->setKeyword('Seme Framework');
    $this->setAuthor('Seme Framework');

   $data['aakm'] = $this->aakm->get();

    $this->putThemeContent("home/home",$data); //pass data to view

    $this->loadLayout("col-1",$data);
    $this->render();
  }
}