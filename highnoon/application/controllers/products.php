<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

    public function holsters($product_id)
    {
        $this->load->model('model_products');

        $info = $this->model_products->get_product_by_id($product_id);

        $data = array(
            'content' => 'product_single',
            'title' => 'High Noon Holsters | ',
            'info' => $info
        );
        $this->load->vars($data);
        $this->load->view('template', $data);
    }
}

/* End of file products.php */
/* Location: ./application/controllers/products.php */