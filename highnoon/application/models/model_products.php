<?php

class Model_products extends CI_Model {

    public function get_random_products()
    {
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(3);
        $query = $this->db->get('products');
        return $query->result();
    }

    public function get_product_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->result();
    }
}