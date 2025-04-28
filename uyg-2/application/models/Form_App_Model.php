<?php
class Form_App_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public $table_name = "users";

    public function insert($data = array())
    {
        return $this->db->insert($this->table_name, $data);
    }

    public function get_all()
    {
        return $this->db->get($this->table_name)->result();
    }

    /* Koşula göre tekbir kaydı getiren fonksiyon. */
    public function get($where = array())
    {
        return $this->db->where($where)->get($this->table_name)->row();
    }

    public function update($where = array(), $data = array())
    {
        return $this->db->where($where)->update($this->table_name, $data);
    }

    public function delete($where = array())
    {
        return $this->db->where($where)->delete($this->table_name);
    }
}
