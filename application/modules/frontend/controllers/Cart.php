<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Cart extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('common_model');
        $this->global_setting = $this->common_model->getGlobalSettings();
        $this->load->library('M_pdf');
        $this->config->load('paypal');

        $config = array(
            'Sandbox' => $this->config->item('Sandbox'), // Sandbox / testing mode option.
            'APIUsername' => $this->config->item('APIUsername'), // PayPal API username of the API caller
            'APIPassword' => $this->config->item('APIPassword'), // PayPal API password of the API caller
            'APISignature' => $this->config->item('APISignature'), // PayPal API signature of the API caller
            'APISubject' => '', // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
            'APIVersion' => $this->config->item('APIVersion'), // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
            'DeviceID' => $this->config->item('DeviceID'),
            'ApplicationID' => $this->config->item('ApplicationID'),
            'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
        );

        // Show Errors
        if ($config['Sandbox']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }

        // Load PayPal library
        $this->load->library('paypal/paypal_pro', $config);
    }

    public function checkout() {
        $this->load->model('Location_model');
        $list = $this->Location_model->getStates();
        $cartdata = $this->cart->contents();
        $this->template->set('list', $list);
        //print_r($cartdata);
        $this->template->set('cart_data', $cartdata);
        $this->template->set('global_setting', $this->global_setting);
        $this->template->set('page', 'checkout');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title($this->global_setting['site_title'] . ' | Brand Services')
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('checkout');
    }

    function placeOrder() {
        $this->load->library('form_validation');
        $cartdata = $this->cart->contents();
        $session_data = $this->session->userdata('user_account');
        //print_r($cartdata);
//        die();
        $result = array();
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $result ['status'] = 0;
            $result ['msg'] = validation_errors();
            echo json_encode($result);
            exit;
        } else {
                $this->session->unset_userdata('PayPalResult');
                $cart['items'] = $cartdata;
                $cart['shopping_cart'] = array(
                    'items' => $cart['items'],
                    'subtotal' => $this->cart->total(),
                    'shipping' => 0,
                    'handling' => 0,
                    'tax' => 0
                );
                
                $idata = array();
                $os = array();
                $order_no = date("Ymd") . "-" . time() . "-" . mt_rand();
            $os['ord_order_number'] = $order_no;
            $os['ord_user_fk'] = '1';
            $os['ord_item_summary_total'] = $this->cart->total();
            $os['ord_sub_total'] = $this->cart->total();
            $os['ord_total'] = $this->cart->total();
            $os['ord_total_rows'] = count($idata);
            $os['ord_total_items'] = count($idata);
            $os['ord_status'] = "Placed";
            $os['ord_date'] = date("Y-m-d H:i:s");
            $os['ord_bill_name'] = $this->input->post('first_name') . " " . $this->input->post('last_name');
            $os['ord_bill_address_01'] = $this->input->post('address');
            $os['ord_bill_city'] = $this->input->post('city');
            $os['ord_bill_state'] = $this->input->post('state');
            $os['ord_bill_post_code'] = $this->input->post('zipcode');
            $os['ord_email'] = $this->input->post('email');
            $os['ord_phone'] = $this->input->post('phone');
            $os['delivery_option'] = "Online Payment";
            $os['user_id'] = $session_data['user_id'];
			
			$city = $this->common_model->getRecords('tbl_cities', array('id','name'), array('id' => $os['ord_bill_city']) );
			$state = $this->common_model->getRecords('tbl_states', array('id','name'), array('id' => $os['ord_bill_state']) );
		
			
            $cart['shipping_name'] = $os['ord_bill_name'];
			$cart['shiptostreet'] = $os['ord_bill_address_01'];
			$cart['shiptostreet2'] = $os['ord_bill_address_01'];
			$cart['shiptocity'] = $city[0]['name'];
			$cart['shiptostate'] = $state[0]['name'];
			$cart['shiptozip'] = $os['ord_bill_post_code'];
			$cart['shiptophonenum'] = $os['ord_phone'];
           
            
            $cart['shopping_cart']['form_data'] = $os;
                $cart['shopping_cart']['grand_total'] = number_format($cart['shopping_cart']['subtotal'] + $cart['shopping_cart']['shipping'] + $cart['shopping_cart']['handling'] + $cart['shopping_cart']['tax'], 2);
                $this->load->vars('cart', $cart);
                $this->session->set_userdata('shopping_cart', $cart);
                $this->template->set('page', 'order_review');
                $this->template->set('cart', $cart);
                $this->template->set_theme('default_theme');
                $this->template->set_layout('frontend')
                        ->title($this->global_setting['site_title'] . ' | Review Order')
                        ->set_partial('header', 'partials/header')
                        ->set_partial('footer', 'partials/footer');
				 $this->template->build('paypal/demos/express_checkout/index');
               
            } 
    }

    public function thankYou() {
        $this->template->set('page', 'cart');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title($this->global_setting['site_title'] . ' | Brand Services')
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('frontpages/thank_you');
    }

    public function cart() {
        $cartdata = $this->cart->contents();
        $this->template->set('cart_data', $cartdata);
        $this->template->set('global_setting', $this->global_setting);
        $this->template->set('page', 'cart');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title($this->global_setting['site_title'] . ' | Brand Services')
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('cart');
    }

    public function addToCart() {
        //print_r($_POST);
        $data = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name' => $this->input->post('name'),
            'options' => array('Size' => '1','product_desc'=>$this->input->post('desc'),'product_img'=>$this->input->post('product_img'))
        );
		
		if( !empty( $this->input->post('project_id') )) {
			  $this->session->set_userdata('project_id', $this->input->post('project_id'));
		}
		
        $insert = $this->cart->insert($data);
	
        if ($insert) {
            $map['status'] = '1';
            $map['msg'] = 'Item added to cart';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = 'Unable to add item t cart';
            echo json_encode($map);
            exit();
        }
    }
	
	public function addToCartProject() {
		$this->cart->destroy();
        //print_r($_POST);
        $data = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name' => $this->input->post('name'),
            'options' => array('Size' => '1','product_desc'=>$this->input->post('desc'),'product_img'=>$this->input->post('product_img'))
        );
		
		if( !empty( $this->input->post('project_id') )) {
			  $this->session->set_userdata('project_id', $this->input->post('project_id'));
		}
		
        $insert = $this->cart->insert($data);
	
        if ($insert) {
            $map['status'] = '1';
            $map['msg'] = 'Item added to cart';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = 'Unable to add item t cart';
            echo json_encode($map);
            exit();
        }
    }
	
    public function removeCartItem() {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => '0',
        );
        $remove = $this->cart->update($data);
        if ($remove) {
            $map['status'] = '1';
            $map['msg'] = 'Item removed from cart';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = 'Unable to remove item';
            echo json_encode($map);
            exit();
        }
    }

    public function updateCart() {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => $this->input->post('qty'),
        );
        $remove = $this->cart->update($data);
        if ($remove) {
            $map['status'] = '1';
            $map['msg'] = 'Item removed from cart';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = 'Unable to remove item';
            echo json_encode($map);
            exit();
        }
    }

}
