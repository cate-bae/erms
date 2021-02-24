<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
		$this->load->model('Product_model');
		$this->categories = categories();

	}

	public function index($category = NULL)
	{		
		
		$page_data['categories'] = $this->categories;

		if (isset($this->categories[$category])) 
		{
			$page_data['category'] = $this->categories[$category]->name;
			$page_data['products'] = $this->Product_model->all(['type' => (int) $category, 'request_status' => [0, 2], 'deleted' => 0, 'status' => 1]);
			if ( ! empty($page_data['products'])) 
			{
				$images = $this->Product_model->one_image_per_product(['product_id' => array_column_obj($page_data['products'], 'id')]);
				$page_data['images'] = $images ? set_key_obj($images, 'product_id') : [];
			}
			
			$data['body'] = $this->load->view('booking/category', $page_data, true);
		} 
		else 
		{
			$data['page_js'] = [
				base_url('assets/js/owl.carousel.min.js'),
				base_url('assets/plugins/owlcarousel/owl.carousel.js'),
				base_url('assets/js/home.js')
			];
			$data['page_css'] = [
				base_url('assets/css/owl.carousel.css')
			];

			// get max 4 images in products for categories
			foreach($page_data['categories'] as $key => $category)
			{
				$product_ids = $this->Product_model->product_ids(['type' => (int) $category->id, 'request_status' => [0, 2], 'deleted' => 0, 'status' => 1], 4);

				if (empty($product_ids)) continue;				

				$product_ids = array_column($product_ids, 'id');
				$page_data['images'][$category->id] = $this->Product_model->product_images(['product_id' => $product_ids]);
			}
			// dd($page_data);
			$data['body'] = $this->load->view('booking/home', $page_data, true);
		}
		$this->load->view('booking', $data);
	}

	public function search ()
	{
		$keyword = $this->input->get('keyword');
		if ( ! trim($keyword))
		{
			redirect(base_url());
		}

		$this->load->model('Account_model');
		$page_data['list'] = $this->Account_model->search_seller(trim($keyword));
		$page_data['keyword'] = trim($keyword);
		
		$data['body'] = $this->load->view('booking/search', $page_data, true);
		$this->load->view('booking', $data);
	}

	public function detail($product_id)
	{
		$data['page_js'] = [
			base_url('assets/js/product/detail.js')
		];

		$page_data['product'] = $this->Product_model->get(['id' => (int) $product_id, 'request_status' => [0, 2]]);
		$page_data['categories'] = $this->categories;
		$page_data['images'] = $this->Product_model->product_images(['product_id' => $page_data['product']->id]);
		$page_data['reviews'] = $this->Product_model->product_reviews(['product_id' => $page_data['product']->id]);
		
		$data['body'] = $this->load->view('booking/detail', $page_data, true);
		$this->load->view('booking', $data);
	}

	public function customer_signed_in ()
	{
		if (not_logged_in()) 
		{
			json_response(FALSE, 'Customer not signed in');
		}

		if (get_user_type() == 2) 
		{
			json_response(TRUE, 'Customer signed in');
		}

		json_response(FALSE, 'Customer not signed in');
	}

	public function order_service ($product_id)
	{
		if (get_user_type() != 2) 
		{
			json_response(FALSE, 'Only customers can book a service.');
		}

		$customer_id = get_user_data()['id'];
		
		$data = [
			'event_date' 	=> $this->input->post('event_date'),
			'event_time' 	=> $this->input->post('event_time'),
			'event_address' => $this->input->post('event_address'),
			'product_id' 	=> $product_id,
			'customer_id' 	=> get_user_data()['id'],
			'status'   	 	=> [0, 1]
		];

		if(empty($data['event_date']) || empty($data['event_time']) || empty($data['event_address']))
		{
			json_response(FALSE, 'Please provide order details.');
		}
		
		if (strtotime($data['event_date'].' '.$data['event_time']) < strtotime(date('Y-m-d H:i')))
		{
			json_response(FALSE, 'Event date and time has already passed.');
		}

		$this->load->model('Order_model');
		if ($this->Order_model->has_ordered($data))
		{
			json_response(FALSE, 'You have already ordered this product.');
		}
		$has_reserved = [
			'event_date' 	=> $this->input->post('event_date'),
			'product_id' 	=> $product_id,
			'status'   	 	=> 1
		];
		if ($this->Order_model->has_ordered($has_reserved))
		{
			json_response(FALSE, "Seller's product has been booked on the same date. Please select another seller or date");
		}
		unset($data['status']);
		
		try 
		{
			$this->db->trans_start();
			
			$this->Order_model->add($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, "Ordered successfully");
	}

	public function set_status($order_id, $status)
	{
		$data = ['status' => $status];
		if ($status == 3)
		{
			$data['cancel_time'] = date('Y-m-d H:i:s');
		}

		try 
		{
			$this->db->trans_start();
			
			$this->load->model('Order_model');
			$this->Order_model->update($data, $order_id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		$msg = 'cancelled';
		if ($status == 1) {
			$msg = 'approved';
		} else if ($status == 2) {
			$msg = 'disapproved';
		} else if ($status == 0) {
			$msg = 'ordered';
		} else if ($status == 4) {
			$msg = 'marked as done';
		}
		
        json_response(TRUE, "Order {$msg} successfully");
	}

	public function notify_seller ($order_id)
	{
		if (get_user_type() != -1 && get_user_type() != 0) 
		{
			json_response(FALSE, 'Only admin can notify the seller.');
		}
		
		$data = [
			'order_id' => $order_id
		];

		try 
		{
			$this->db->trans_start();
			
			$this->load->model('Order_model');
			$this->Order_model->notify_seller($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, "Seller was notified successfully");
	}

	public function upload_receipt()
	{
		$order_id = $this->input->post('id');
		
        if ( ! $order_id) 
        {
			json_response(FALSE, 'Cannot find order');
        }
        
        if ( ! isset($_POST['file'])) 
        {
			json_response(FALSE, 'Please select image to upload');
		}
		
		$file = $_POST['file'];
		$split = explode( '/', $file );
		$file_ext = explode( ';', $split[1] )[0];
		$filename = md5(uniqid().time()) . '.' . $file_ext; 
		$filepath = './uploads/';
		$img = file_put_contents($filepath.$filename, base64_decode(explode(',',$file)[1]));

		$data = ['receipt' => $filename];
			
		try 
		{
			$this->db->trans_start();
			
			$this->load->model('Order_model');
			
			$order = $this->Order_model->get(['id' => $order_id], 'receipt');
			if ($order->receipt && file_exists('./uploads/'. $order->receipt)) 
			{
				unlink('./uploads/'. $order->receipt);
			}

			$this->Order_model->update($data, $order_id);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Images uploaded successfully');
	}

	public function sign_in ($create = FALSE)
	{
		$data['page_js'] = [
			base_url('assets/js/product/sign_in.js')
		];
		$data['categories'] = $this->categories;

		$data['hide_register'] = TRUE;

		$page_data['create'] = $create != FALSE;

		$data['body'] = $this->load->view('booking/sign-in', $page_data, true);
		$this->load->view('booking', $data);

	}

	public function review()
	{
		
		if (has_empty_post()) 
		{	
			json_response(FALSE, 'Fill in the empty fields');
		}

		$fields = ['order_id', 'rate', 'comment'];

		$data = parse_data($_POST, $fields);
		
		try 
		{
			$this->db->trans_start();
			
			$this->load->model('Order_model');
			$this->Order_model->review($data);

			$this->db->trans_complete();
		}
		catch(Exeption $e)
		{
			$this->db->trans_rollback();
			json_response(FALSE, $e->getMessage());
		}
		
        json_response(TRUE, 'Reviewed successfully');

	}

	public function delete_order($id)
	{
		$this->load->model('Order_model');
		$image = $this->Order_model->get(['id' => $id], 'receipt')->receipt;
		
		if ($image && file_exists('./uploads/'. $image)) 
		{
			unlink('./uploads/'. $image);
		}

        $this->Order_model->delete($id);
		json_response(TRUE, 'Deleted successfully');
	}

	public function products($seller_id)
	{		
		if (empty($seller_id))
		{
			redirect(base_url());
		}

		$this->load->model('Account_model');
		$page_data['seller'] = $this->Account_model->get(['id' => $seller_id], 'CONCAT(first_name, " ", last_name) as name, address, contact_number, shop_name, avatar, id');
		$page_data['products'] = $this->Product_model->all([
				'user_id' => (int) $seller_id,
				'request_status' => [0, 2], 
				'deleted' => 0, 
				'status' => 1
			]);
		if ( ! empty($page_data['products'])) 
		{
			$images = $this->Product_model->one_image_per_product(['product_id' => array_column_obj($page_data['products'], 'id')]);
			$page_data['images'] = $images ? set_key_obj($images, 'product_id') : [];
		}
		
		$data['body'] = $this->load->view('booking/products', $page_data, true);
		
		$this->load->view('booking', $data);
	}
}
