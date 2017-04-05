<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("product_model");
		$data['user_session'] = $this->session->userdata('user_account');
		
		if ($data['user_session']['role_id'] == '1') {
            $this->sidebar = 'partials/admin_sidebar';
        } else {
            $this->sidebar = 'partials/user_sidebar';
        }
		
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
//        $this->load->library('form_validation');
    }

    /* Frontend : Manage Blog Start */

    public function productList() {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        #START Action :: Fetch all active Blog added by admin :   
        $data['arr_product_data'] = $this->product_model->getAllProducts('','','');
//        print_r($data['arr_product_data']);


        $this->template->set('page', 'productlist');
        $this->template->set('arr_product_data', $data['arr_product_data']);
        $this->template->set('user_session', $data['user_session']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/product/product_list');
    }

    /* Function to add blog post end */

    public function addProduct() { 
		$this->load->library('upload');
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('blog/list');
        }
        $category = $this->common_model->getRecords(TABLES::$MST_PRODUCT_CATEGORIES, '*', array('status' => '1'), $order_by = 'category_name DESC');
        $subcategory = $this->common_model->getRecords(TABLES::$TRANS_PRODUCT_SUB_CATEGORIES, '*', '', $order_by = 'sub_category_name DESC');
       //$data = $this->common_model->commonFunction();
		if(!empty($_POST)) {

			if(isset($_FILES['image_file'])) {
				if ($_FILES['image_file']['name'] != '') {
						
						$config['file_name'] = time() . rand();
						$config['upload_path'] = 'uploads/papers/thumbnail/';
						$config['allowed_types'] = 'jpg|jpeg|gif|png|PNG';
						$config['max_size'] = '9000000';
						
						$this->upload->initialize($config);
						
						if ($this->upload->do_upload('image_file')) {  
							$data['upload_data'] = $this->upload->data();
						
							$image_path = $data['upload_data']['file_name'];
							$ar = list($width, $height) = getimagesize($data['upload_data']['full_path']);
						   
							
							$image_config = array(
								'source_image' => $data['upload_data']['full_path'],
								'new_image' => "uploads/papers/thumbnail/",
								'maintain_ratio' => false,
								'width' => 400,
								'height' => 300
							);
							$this->load->library('image_lib');
							$this->image_lib->initialize($image_config);
							$resize_rc = $this->image_lib->resize();
							$image_path = $data['upload_data']['file_name'];
						
						} else {
							$error = array('error' => $this->upload->display_errors());
							$errmsg = $error['error'];
							$this->session->set_userdata("error", "<span class='success'>".$errmsg."</span>");
							redirect(base_url() . "admin/add-product/");
							//$image_path = '';
						}
				   
				}
			}
			if(isset($_FILES['img_file'])) {		
				if ($_FILES['img_file']['name'] != '') {
				
					$config['file_name'] = time() . rand();
					$config['upload_path'] = 'uploads/papers';
					$config['allowed_types'] = 'pdf|doc|docx';
					$config['max_size'] = '9000000';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					if ($this->upload->do_upload('img_file')) {  
						//$data1['upload_data'] = $this->upload->data();
						$upload_result = $this->upload->data();   
						$img_path = $upload_result['file_name'];
					} else {
						$error = array('error' => $this->upload->display_errors());
						$errmsg = $error['error'];
						$this->session->set_userdata("error", "<span class='success'>".$errmsg."</span>");
						redirect(base_url() . "admin/add-product/");
					}

					$data['user_session'] = $this->session->userdata('user_account');
					$config = array(
						'field' => 'slug',
						'slug' => 'slug',
						'table' => TABLES::$MST_PRODUCTS,
						'id' => 'product_id',
					);
					$this->load->library('slug', $config);
					$slugdata = array(
						'slug' => $this->input->post('name'),
					);
					$slug = $this->slug->create_uri($slugdata);
					$tags = '';
					if(!empty($_POST['tags'])) {
						//$tags = implode(',', $_POST['tags'] );
						$tags = trim($_POST['tags']);
					}	
					
					$arr_post_data = array(
						"name" => $this->input->post('name'),
						"long_desc" => $this->input->post('long_desc'),
						"price" => $this->input->post('price'),
						'cat_id' => $this->input->post('cat_id'),
						'status' => $this->input->post('status'),
						'paper_file' => $img_path,
						'image_file' => $image_path,
						'is_featured' => $this->input->post('is_featured'),
						'slug' => $slug . ".html",
						'tags' => $tags,
						'created_by' => $data['user_session']['user_id'],
						'created_on' => date( 'Y:m:d h:r:s' )
					);
					$this->common_model->insertRow($arr_post_data, TABLES::$MST_PRODUCTS);
					$this->session->set_userdata('success_msg', "Your product has been updated successfully.");
					redirect(base_url() . 'admin/product-list');
				}	
            }
		}	
			
        $data['arr_variant_data'] = $this->common_model->getRecords(TABLES::$MST_VARIANTS, '*', array('status' => '1'));
        $this->template->set('arr_variant_data', $data['arr_variant_data']);
        $this->template->set('category', $category);
        $this->template->set('subcategory', $subcategory);
        $this->template->set('page', 'productlist');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/product/product_add');
    }
	
	public function deletePaper($post_id)
    {
		if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error', "Please sign in to post your blog.");
            redirect('admin/product-list');
        }
		
		if (!$this->common_model->deleteRows( array($post_id),TABLES::$MST_PRODUCTS,'product_id')) {
			$this->session->set_userdata('msg', "Record deleted successfully.");
            redirect('admin/product-list');
        }
		
	}
	
	 public function editPaper($post_id)
     {  
		$this->load->library('upload');
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('product-list');
        }
        $category = $this->common_model->getRecords(TABLES::$MST_PRODUCT_CATEGORIES, '*', array('status' => '1'), $order_by = 'category_name DESC');
        $subcategory = $this->common_model->getRecords(TABLES::$TRANS_PRODUCT_SUB_CATEGORIES, '*', '', $order_by = 'sub_category_name DESC');
		
        $data = $this->common_model->commonFunction();
		
		$arrProductData = $this->product_model->getProductById($post_id);
		
		if(!empty($_POST)) {
			
			$image_path = !empty( $arrProductData ) ? $arrProductData[0]['image_file'] : '';
			$img_path	=  !empty( $arrProductData ) ? $arrProductData[0]['paper_file']: '';
			
		
			if(isset($_FILES['image_file'])) {
				if ($_FILES['image_file']['name'] != '') {
						
						$config['file_name'] = time() . rand();
						$config['upload_path'] = 'uploads/papers/thumbnail/';
						$config['allowed_types'] = 'jpg|jpeg|gif|png';
						$config['max_size'] = '9000000';
						
						$this->upload->initialize($config);
						
						if ($this->upload->do_upload('image_file')) {  
							$data['upload_data'] = $this->upload->data();
						
							$image_path = $data['upload_data']['file_name'];
							$ar = list($width, $height) = getimagesize($data['upload_data']['full_path']);
						   
							
							$image_config = array(
								'source_image' => $data['upload_data']['full_path'],
								'new_image' => "uploads/papers/thumbnail/",
								'maintain_ratio' => false,
								'width' => 400,
								'height' => 300
							);
							$this->load->library('image_lib');
							$this->image_lib->initialize($image_config);
							$resize_rc = $this->image_lib->resize();
							$image_path = $data['upload_data']['file_name'];
						
						} else {
							$error = array('error' => $this->upload->display_errors());
							$errmsg = $error['error'];
							$this->session->set_userdata("error", "<span class='success'>".$errmsg."</span>");
							redirect(base_url() . "admin/edit-paper/" .$post_id );
						
						}
				   
				}
			}	
			if(isset($_FILES['img_file'])) {
				if ($_FILES['img_file']['name'] != '') {
				
					$config['file_name'] = time() . rand();
					$config['upload_path'] = 'uploads/papers';
					$config['allowed_types'] = 'pdf|doc|docx';
					$config['max_size'] = '9000000';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					if ($this->upload->do_upload('img_file')) {  
						//$data1['upload_data'] = $this->upload->data();
						$upload_result = $this->upload->data();   
						$img_path = $upload_result['file_name'];
					} else {
						$error = array('error' => $this->upload->display_errors());
						$errmsg = $error['error'];
						$this->session->set_userdata("error", "<span class='success'>".$errmsg."</span>");
						redirect(base_url() . "admin/edit-paper/" .$post_id );
					}

					$data['user_session'] = $this->session->userdata('user_account');
					$config = array(
						'field' => 'slug',
						'slug' => 'slug',
						'table' => TABLES::$MST_PRODUCTS,
						'id' => 'product_id',
					);
					
					$tags = '';
					if(!empty($_POST['tags'])) {
						//$tags = implode(',', $_POST['tags'] );
						$tags = trim($_POST['tags']);
					}	
				}
			}	
			
			$arr_post_data = array(
					"name" => $this->input->post('name'),
					"long_desc" => $this->input->post('long_desc'),
					"price" => $this->input->post('price'),
					'cat_id' => $this->input->post('cat_id'),
					'status' => $this->input->post('blog_status'),
					'paper_file' => $img_path,
					'image_file' => $image_path,
					'is_featured' => $this->input->post('is_featured'),
					'tags' =>  $this->input->post('tags'),
					'created_on' => date( 'Y:m:d h:r:s' )
			);
				/*print_r($arr_post_data);
				die;*/
				$condition = array("product_id" => $post_id);
				$this->common_model->updateRow(TABLES::$MST_PRODUCTS, $arr_post_data, $condition);
				
				$this->session->set_userdata("msg", "<span class='success'>Record updated successfully!</span>");
				redirect(base_url() . "admin/product-list" );
		}	
			//$this->session->set_userdata("msg", "<span class='success'>Record updated successfully!</span>");
			//redirect(base_url() . "admin/product-list");	
		
		
		$arrProducts = array();
		if(!empty($arrProductData)) {
			$arrProducts = $arrProductData[0];
		}
		/* $this->common_model->insertRow($arr_post_data, TABLES::$MST_PRODUCTS); */
		$this->template->set('global', $data['global']);
		 $this->template->set('post_info', $arrProducts);
        $this->template->set('post_id', $post_id);
		$this->template->set('category', $category);
		$this->template->set('subcategory', $subcategory);
		$this->template->set('page', 'productedit');
		$this->template->set_theme('default_theme');
		$this->template->set_layout('backend')
				->title('Sass Consultant | Search paper')
				->set_partial('header', 'partials/header')
				->set_partial('sidebar', $this->sidebar)
				->set_partial('footer', 'partials/footer');
		$this->template->build('admin/product/product_edit');
		
	}

	
    private function upload_files($path, $files) {
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|gif|png',
            'max_size' => '9000000',
        );

        $this->load->library('upload', $config);

        $images = array();
        $data1 = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['thumbnail[]']['name'] = $files['name'][$key];
            $_FILES['thumbnail[]']['type'] = $files['type'][$key];
            $_FILES['thumbnail[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['thumbnail[]']['error'] = $files['error'][$key];
            $_FILES['thumbnail[]']['size'] = $files['size'][$key];



            $this->upload->initialize($config);

            if ($this->upload->do_upload('thumbnail[]')) {
                $this->upload->data();
                $data1['upload_data'] = $this->upload->data();
                $fileName = $data1['upload_data'];

                $images[] = $fileName;

                $config['file_name'] = time() . rand();
                //$ar = list($width, $height) = getimagesize($data1['full_path']);
                $upload_result1 = $this->upload->data();
                $image_config1 = array(
                    'source_image' => $upload_result1['full_path'],
                    'new_image' => "uploads/products/thumbnails/135x163",
                    'maintain_ratio' => false,
                    'width' => 135,
                    'height' => 163
                );
                $this->load->library('image_lib');
                $this->image_lib->initialize($image_config1);
                $resize_rc = $this->image_lib->resize();
            } else {
                return false;
            }
        }

        return $images;
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
