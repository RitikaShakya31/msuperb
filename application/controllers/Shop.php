<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $contact = $this->CommonModel->getRowById('contactdetails', 'cid', '1');
        // $this->email = $contact[0]['f_email'];
        // $this->phone = $contact[0]['f_contact'];
        // $this->address = $contact[0]['address'];
        // $this->fb = $contact[0]['facebook'];
        // $this->insta = $contact[0]['instagram'];
        // $this->youtube = $contact[0]['youtube'];
    }
    public function addToCart()
    {
        error_reporting(0);
        $product_id = $this->input->post('pid');
        $product = $this->input->post('product');
        $qty = $this->input->post('qty');
        $pr = explode('-', $product);
        if ($pr[0] == 'variant') {
            $product = $this->CommonModel->getRowByIdfield('product', 'product_id', $product_id, array('product_id', 'sale_price', 'market_price', 'product_name', 'quantity_type'));
            $product_variant = $this->CommonModel->getSingleRowById('product_variant', ['id' => $pr[1]]);
            $imgdata = getSingleRowById('product_image', array('product_id' => $product_id));
            $data = array(
                'id' => $product[0]['product_id'] . '-' . $pr[1],
                'variant' => $pr[1],
                'qty' => $qty,
                'quantity_type' => $product[0]['quantity_type'],
                'price' => $product_variant['sale_price'],
                'market_price' => $product_variant['market_price'],
                'name' => clean($product[0]['product_name']),
                'variant_name' => clean($product_variant['product_title']),
                'image' => $imgdata['image_path']
            );
        } else {
            $product = $this->CommonModel->getRowByIdfield('product', 'product_id', $product_id, array('product_id', 'sale_price', 'market_price', 'product_name', 'quantity_type'));
            $imgdata = getSingleRowById('product_image', array('product_id' => $product_id));
            $data = array(
                'id' => $product[0]['product_id'] . '-0',
                'variant' => 0,
                'qty' => $qty,
                'quantity_type' => $product[0]['quantity_type'],
                'price' => $product[0]['sale_price'],
                'market_price' => $product[0]['market_price'],
                'name' => clean($product[0]['product_name']),
                'variant_name' => 'Pack of 1',
                'image' => $imgdata['image_path']
            );
        }
        $this->cart->insert($data);

        if ($this->session->has_userdata('login_user_id')) {
            $result = ['login_user_id' => true];
        } else {
            $result = ['login_user_id' => false];
        }
        echo json_encode($result);
    }
    public function cart()
    {
        $data['title'] = 'Cart -  SVGH Healthcare private limited | Indore Madhya Pradesh';
        // $this->load->view('cart', $data);
    }
    public function fetch_data_cart()
    {
        $this->load->view('cart-list');
    }

    public function fetch_cart()
    {
        $this->load->view('cart-product');
    }
    public function delete_item()
    {
        $product_id = $this->input->post('pid');
        $data = array(
            'rowid' => $product_id,
            'qty' => 0
        );
        $this->cart->update($data);
    }
    public function update_qty()
    {
        extract($this->input->post());
        $data = array(
            'rowid' => $rowid,
            'qty' => $qty
        );
        $this->cart->update($data);
    }
    public function fetch_totalitems()
    {
        echo $this->cart->total_items();
    }
    public function fetch_totalamount()
    {
        echo '₹' . $this->cart->total() . '/-';
        // $oldPrice = 0;
        // foreach ($this->cart->contents() as $items) {
        //     $oldPrice += $items['market_price'];
            
        // }
        // echo $oldPrice;
    }

    public function product_discount()
    {
        $totalDiscount = 0;

        foreach ($this->cart->contents() as $items) {
            $data = getSingleRowById('product', array('product_id' => $items['id']));

            $oldPrice = +$data['market_price'];
            $newPrice = +$data['sale_price'];
            $oldPrice = bcmul($oldPrice, $items['qty']);
            $newPrice = bcmul($newPrice, $items['qty']);


            $itemDiscount = $oldPrice - $newPrice;
            $totalDiscount += $itemDiscount;
        }

        echo '- ₹' . $totalDiscount . '';
    }
    public function webhook()
    {
        $insert = $this->CommonModel->insertRowReturnId('logs', ['name' => 'test sync']);
    }
}
