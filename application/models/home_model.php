<?php
class Home_model extends CI_Model
{
    function checkRecord($table, $where)
    {
        $query = $this->db->get_where($table, $where);
        return $query->row();
    }

    function getRecords($table, $select_fields='', $where='', $order='')
    {
        if(count($select_fields) > 0){
            $this->db->select(implode(',', $select_fields));
        }
        if(count($where) > 0){
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if(!empty($order)){
            $this->db->order_by("$order");
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function saveRecord($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function updateRecord($table, $fields, $data)
    {
        foreach ($fields as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    function deleteRecord($table, $fields)
    {
        foreach ($fields as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
}
