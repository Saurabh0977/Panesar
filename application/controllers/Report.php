<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class Report extends Base_Controller {

	public function report_view() {
		$this->load->model('model_items');
		$this->load->model('model_samples');
		$this->load->model('model_lots');
		$this->load->model('model_sales');
		$this->load->model('model_purchase');
		$result = $this->model_samples->get_sample_list();
		$data['samples'] = $result;

		$itemslist = $this->model_items->get_item_list();
		$data['items'] = $itemslist;

		$lotlist = $this->model_lots->fetch_lot_list();
		$data['lots'] = $lotlist;

		$saleslist = $this->model_sales->get_sales_list();
		$data['sales'] = $saleslist;

		$this->load_view('report_view',$data);
	}

	public function create_report($type) {
		$fdate = $this->input->post('fdate');
		$tdate = $this->input->post('tdate');
		$preview = $this->input->post('preview');
		$download = $this->input->post('download');
		$id = $this->input->post('id');
		switch($type) {
			case 1:
			$this->load->model('model_items');
			$result = $this->model_items->get_item_list_from_stock_item($id,$fdate,$tdate);
			foreach($result as $results) {
				$results->item_name=$this->get_item_name($results->ITEM_ID);
				$results->sname=$this->get_seller_name($results->STOCK_ID);
			}
			$data['itemname'] = $this->get_item_name($id);
			$data['items'] = $result ;
			if(isset($preview)) {
				$html=$this->load->view('available_items_stock', $data, true);
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "I"); 
			}
			if(isset($download)) {
				$html=$this->load->view('available_items_stock', $data, true);
				$pdfFilePath = "Items_list.pdf";
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "D"); 
			}
			break;

			case 2:
			$this->load->model('model_lots');
			$result= $this->model_lots->get_lot_details_by_lot_id($id);
			foreach($result as $results) {
				$results->sample_name=$this->sample_details_m($results->SAMPLE_ID);
				$results->seller=$this->seller_details($results->ID);
			}
			$data['lots'] =$result ;
			if(isset($preview)) {
				$html=$this->load->view('available_lot_details', $data, true);
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "I"); 
			}
			if(isset($download)) {
				$html=$this->load->view('available_lot_details', $data, true);
				$pdfFilePath = "Lots_list.pdf";
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "D"); 
			} 
			break;

			case 3:
			$this->load->model('model_sales');	
			$result = $this->model_sales->get_sales_list_by_id($id);
			foreach ($result as $results) {
				$results->lname = $this->get_lot_name_from_lot_list($results->LOT_ID);
			}
			$data['sales'] = $result;
			if(isset($preview)) {
				$html=$this->load->view('available_sales_details', $data, true);
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "I"); 
			}
			if(isset($download)) {
				$html=$this->load->view('available_sales_details', $data, true);
				$pdfFilePath = "Sales_list.pdf";
				$this->load->library('m_pdf');
				$this->m_pdf->pdf->WriteHTML($html);
				$this->m_pdf->pdf->Output($pdfFilePath, "D"); 
			}
		}
	}

	public function get_item_name($id) {
		$result = $this->model_items->items_details_show($id); 
		return $result;
	}

	public function get_seller_name($id) {	
		$this->load->model('model_purchase');
		$name = $this->model_purchase->get_seller_name($id);
		return $name;
	}	

	public function sample_details_m($id) {
		$this->load->model('model_samples');
		$name = $this->model_samples->get_sample_name_by_sampleid($id);	
		return $name;
	}
	
	public function seller_details($id) {
		$this->load->model('model_sales');
		$results = $this->model_sales->get_lotname_by_lot_id($id);
		return $results;
	}

	public function get_lot_name_from_lot_list($id) {
		$this->load->model('model_lots');
		$name = $this->model_lots->get_lot_name_by_lot_id($id);
		return $name;
	}
}
?>
