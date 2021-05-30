<?php
class ApiKey extends SENE_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load("a_apikey_model", "aakm");
    $this->lib("sene_json_engine", "json");
  }
  public function index(){
    $data = array();
    $data['status'] = 200;
    $data['message'] = 'Success';
    $data['data'] = $this->aakm->get();
    $this->json->out($data);
  }

  public function detail($id){
    $data = array();
    $id = (int) $id;
    if($id<=0){
      $data['status'] = 800;
      $data['message'] = 'invalid ID';
      $this->json->out($data);
    }

    $aakm = $this->aakm->getById($id);
    if(!isset($aakm->id)){
      $data['status'] = 804;
      $data['message'] = 'Data with supplied ID not found';
      $this->json->out($data);
    }else{
      $data['status'] = 200;
      $data['message'] = 'Success';
      $data['data'] = $aakm;
      $this->json->out($data);
    }
  }

  public function create(){
    $data = array();
    $data['status'] = 549;
    $data['message'] = 'one or more parameter are required';
    $data['data'] = array();

    //collect input
    $nation_code = $this->input->post('nation_code');
    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $is_active = (int) $this->input->post('is_active');

    //validation
    if(strlen($nation_code)==0){
      $data['status'] = 801;
      $data['message'] = 'invalid nation_code';
      $this->json->out($data);
    }
    if(strlen($code)==0){
      $data['status'] = 801;
      $data['message'] = 'invalid code';
      $this->json->out($data);
    }
    if(strlen($name)==0){
      $data['status'] = 802;
      $data['message'] = 'invalid name';
      $this->json->out($data);
    }
    if($is_active<0){
      $data['status'] = 803;
      $data['message'] = 'invalid is_active';
      $this->json->out($data);
    }

    //transaction open
    $this->aakm->trans_start();

    //data input
    $di = array();
    $di['nation_code'] = $nation_code;
    $di['id'] = $this->aakm->getLastId($nation_code);
    $di['code'] = $code;
    $di['name'] = $name;
    $di['cdate'] = 'NOW()';
    $di['ldate'] = 'NOW()';
    $di['is_active'] = $is_active;

    $res = $this->aakm->set($di);
    if($res){
      $data['status'] = 200;
      $data['message'] = 'success';
      $data['data'] = $this->aakm->get();
      $this->aakm->trans_commit();
    }else{
      $data['status'] = 900;
      $data['message'] = 'insert data failed';
      $this->aakm->trans_rollback();
    }

    //transaction closed
    $this->aakm->trans_end();

    //render response
    $this->json->out($data);
  }

  public function edit($nation_code,$id){
    $data = array();
    $data['status'] = 549;
    $data['message'] = 'one or more parameter are required';
    $data['data'] = array();

    $nation_code = $this->input->post('nation_code');
    if(strlen($nation_code)==0){
      $data['status'] = 801;
      $data['message'] = 'invalid nation_code';
      $this->json->out($data);
    }

    $id = (int) $id;
    if($id<=0){
      $data['status'] = 800;
      $data['message'] = 'invalid ID';
      $this->json->out($data);
    }

    $aakm = $this->aakm->getById($nation_code,$id);
    if(!isset($aakm->id)){
      $data['status'] = 804;
      $data['message'] = 'Data with supplied ID not found';
      $this->json->out($data);
    }

    //collect input
    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $is_active = (int) $this->input->post('is_active');

    //validation
    if(strlen($code)==0){
      $data['status'] = 801;
      $data['message'] = 'invalid code';
      $this->json->out($data);
    }
    if(strlen($name)==0){
      $data['status'] = 802;
      $data['message'] = 'invalid name';
      $this->json->out($data);
    }
    if($is_active<0){
      $data['status'] = 803;
      $data['message'] = 'invalid is_active';
      $this->json->out($data);
    }

    //data update
    $du = array();
    $du['nation_code'] = $nation_code;
    $du['code'] = $code;
    $du['name'] = $name;
    $du['ldate'] = 'NOW()';
    $du['is_active'] = $is_active;

    $res = $this->aakm->update($nation_code,$id,$du);
    if($res){
      $data['status'] = 200;
      $data['message'] = 'success';
      $data['data'] = $this->aakm->get();
    }else{
      $data['status'] = 900;
      $data['message'] = 'update data failed';
    }
    $this->json->out($data);
  }

  public function delete($nation_code,$id){
    $data = array();
    $data['status'] = 549;
    $data['message'] = 'one or more parameter are required';
    $data['data'] = array();

    $nation_code = $this->input->post('nation_code');
    if(strlen($nation_code)==0){
      $data['status'] = 801;
      $data['message'] = 'invalid nation_code';
      $this->json->out($data);
    }

    $id = (int) $id;
    if($id<=0){
      $data['status'] = 800;
      $data['message'] = 'invalid ID';
      $this->json->out($data);
    }

    $aakm = $this->aakm->getById($nation_code,$id);
    if(!isset($aakm->id)){
      $data['status'] = 804;
      $data['message'] = 'Data with supplied ID not found';
      $this->json->out($data);
    }

    $res = $this->aakm->del($nation_code,$id);
    if($res){
      $data['status'] = 200;
      $data['message'] = 'success';
      $data['data'] = $this->aakm->get();
    }else{
      $data['status'] = 900;
      $data['message'] = 'delete data failed';
    }
    $this->json->out($data);
  }
}
         