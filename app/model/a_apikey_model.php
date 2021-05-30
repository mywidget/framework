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

  /**
   * Start transaction
   * @return boolean      1 success, false failed
   */
  public function trans_start()
  {
    $r = $this->db->autocommit(0);
    if ($r) {
      return $this->db->begin();
    }
    return false;
  }

  /**
   * Commit transaction
   * @return boolean      1 success, false failed
   */
  public function trans_commit()
  {
    return $this->db->commit();
  }

  /**
   * Rollback transaction
   * @return boolean      1 success, false failed
   */
  public function trans_rollback()
  {
    return $this->db->rollback();
  }

  /**
   * Close / End transaction
   * @return boolean      1 success, false failed
   */
  public function trans_end()
  {
    return $this->db->autocommit(1);
  }

  /**
   * get last ID before insert
   * @param  int $nation_code    Nation Code or Country Code
   * @return int                 last id, 0 failed
   */
  public function getLastId($nation_code)
  {
    $this->db->select_as("COALESCE(MAX($this->tbl_as.id),0)+1", "last_id", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where("nation_code", $nation_code);
    $d = $this->db->get_first('', 0);
    if (isset($d->last_id)) {
      return $d->last_id;
    }
    return 0;
  }

  /**
   * Insert data to a table row
   * @param  array   $di    key value pair for inserting data to a table
   * @return boolean        1 success, false failed
   */
  public function set($di)
  {
    return $this->db->insert($this->tbl, $di);
  }

  /**
   * Update data in a table row
   * @param  array   $nation_code     Nation Code or Country Code
   * @param  array   $id              ID from a table
   * @return boolean                  1 success, false failed
   */
  public function update($nation_code, $id, $du)
  {
    $this->db->where('nation_code', $nation_code);
    $this->db->where('id', $id);
    return $this->db->update($this->tbl, $du);
  }

  /**
   * Delete data in a table row
   * @param  array   $nation_code     Nation Code or Country Code
   * @param  array   $id              ID from a table
   * @return boolean                  1 success, false failed
   */
  public function del($nation_code, $id)
  {
    $this->db->where('nation_code', $nation_code);
    $this->db->where('id', $id);
    return $this->db->delete($this->tbl);
  }

  /**
   * Retrieve all rows
   * @return array        Array of object
   */
  public function get()
  {
    return $this->db->get();
  }

  /**
   * [getById description]
   * @param  int    $nation_code Nation Code or Country Code
   * @param  int    $id          ID from a table
   * @return object              Success if return Single row data object, otherwise return empty object
   */
  public function getById($nation_code,$id)
  {
    $this->db->where('nation_code', $nation_code);
    $this->db->where('id', $id);
    return $this->db->get_first();
  }
}