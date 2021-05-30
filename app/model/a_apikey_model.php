<?php
class A_ApiKey_Model extends SENE_Model
{
    public $tbl = 'a_apikey';
    public $tbl_as = 'ak';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }
    public function set($di)
    {
        return $this->db->insert($this->tbl,$di);
    }
    public function update($id,$du)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->tbl,$du);
    }
    public function del($id,$du)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->tbl);
    }
    public function get()
    {
        return $this->db->get();
    }
    public function getById($id)
    {
        $this->db->where('id',$id);
        return $this->db->get_first();
    }
}