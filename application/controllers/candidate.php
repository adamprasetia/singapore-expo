<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate extends Member_Controller {
	private $limit = 10;
	function __construct(){
		parent::__construct();
		$limit = $this->input->get('limit');
		if($limit<>''){
			$this->limit = $limit;
		}			
	}
	function filter(){
		$this->form_validation->set_rules('status_data','Status','trim');
		if($this->form_validation->run()===false){
			$offset = $this->input->get('offset');
			$limit = $this->input->get('limit');
			$search = $this->input->get('search');
			$date_from = $this->input->get('date_from');
			$date_to = $this->input->get('date_to');
			$status_phone = $this->input->get('status_phone');
			$status_data = $this->input->get('status_data');
			return "?limit=$limit&search=$search&date_from=$date_from&date_to=$date_to&status_phone=$status_phone&status_data=$status_data&offset=$offset";
		}else{
			$limit = $this->input->post('limit');
			$search = $this->input->post('search');
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$status_phone = $this->input->post('status_phone');
			$status_data = $this->input->post('status_data');
			redirect("candidate/show?limit=$limit&search=$search&date_from=$date_from&date_to=$date_to&status_phone=$status_phone&status_data=$status_data&offset=$offset");
		}
	}	
	function filter_2(){
			$offset = $this->input->get('offset');
			$limit = $this->input->get('limit');
			$search = $this->input->get('search');
			$date_from = $this->input->get('date_from');
			$date_to = $this->input->get('date_to');
			$status_phone = $this->input->get('status_phone');
			$status_data = $this->input->get('status_data');
			return "?limit=$limit&search=$search&date_from=$date_from&date_to=$date_to&status_phone=$status_phone&status_data=$status_data&offset=$offset";
	}
	function show($order_column="id",$order_type="asc"){
		/* - Table - */
		$tmp = array('table_open'=>'<table class="table table-bordered table-striped">');
		$this->table->set_template($tmp);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading(
			'No'
			,anchor('candidate/show/serial/'.($order_type=='asc' && $order_column=='serial'?'desc':'asc').$this->filter(),'Serial '.($order_column=='serial'?sort_icon($order_type):''))
			,anchor('candidate/show/fullname/'.($order_type=='asc' && $order_column=='fullname'?'desc':'asc').$this->filter(),'Fullname '.($order_column=='fullname'?sort_icon($order_type):''))
			,anchor('candidate/show/tlp/'.($order_type=='asc' && $order_column=='tlp'?'desc':'asc').$this->filter(),'Telephone '.($order_column=='tlp'?sort_icon($order_type):''))
			,anchor('candidate/show/status_phone/'.($order_type=='asc' && $order_column=='status_phone'?'desc':'asc').$this->filter(),'Status Phone'.($order_column=='status_phone'?sort_icon($order_type):''))
			,anchor('candidate/show/status_data/'.($order_type=='asc' && $order_column=='status_data'?'desc':'asc').$this->filter(),'Status Data'.($order_column=='status_data'?sort_icon($order_type):''))
			,anchor('candidate/show/note/'.($order_type=='asc' && $order_column=='note'?'desc':'asc').$this->filter(),'Note'.($order_column=='note'?sort_icon($order_type):''))
		);
		$offset = $this->input->get('offset');
		$result = $this->candidate_model->get($order_column,$order_type,$this->limit,($offset<>''?$offset:0))->result();
		$i=$offset+1;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,anchor('candidate/phone/'.$r->id.$this->filter(),$r->serial)
				,$r->fullname.' '.send_email($r->send_email)
				,$r->tlp
				,status_phone($r->status_phone).' <span class="badge">'.$this->callhis_model->count_from_candidate_id($r->id).'</span>'
				,status_data($r->status_data)
				,$r->note
			);
		}
		$data['table'] = $this->table->generate();

		/* - Total Count - */
		$total = $this->candidate_model->count_all();
		
		/* - Pagination - */
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url("candidate/show/$order_column/$order_type".$this->filter());
		$config['query_string_segment'] = 'offset';
		$config['per_page'] = $this->limit;
		$config['total_rows'] = $total;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';	
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';	
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';		
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';	
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';				
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = 'Total : '.number_format($total);
		
		$this->template->load('candidate',$data);
	}
	function phone($id){
		$this->form_validation->set_rules('status','Status','trim');
		if($this->form_validation->run()===false){
			$data['action'] = 'candidate/phone/'.$id.$this->filter();
			$data['candidate'] = $this->candidate_model->get_from_id($id)->row();
			$data['breadcrumb'] = 'candidate/show/'.$this->filter();
			$this->template->load('phone',$data);
		}else{
			$this->candidate_model->phone($id);
			$this->callhis($id);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Update Success!!!</div>');			
			redirect('candidate/show'.$this->filter_2());
		}
	}
	function callhis($id){
		$remark = $this->input->post('callhis_remark');
		if($remark<>''){
			$data = array(
				'candidate_id'=>$id
				,'remark'=>$this->input->post('callhis_remark')
				,'created'=>date('Y-m-d H:i:s')
			);
			$this->callhis_model->create($data);
		}
	}
	function import(){
		$this->template->load('import');
	}
	function import_(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls';
		$config['overwrite'] = true;
		$config['file_name'] = 'import.xls';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()){
			$this->session->set_flashdata('alert','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
			redirect('candidate/import');
		}
		else{
			require_once "../adirect/assets/lib/PHPExcel/PHPExcel.php";
			$excel = new PHPExcel();
			
			$excel=PHPExcel_IOFactory::load(FCPATH."/uploads/import.xls");
			$excel->setActiveSheetIndex(0);
			$i=2;
			while(trim($excel->getActiveSheet()->getCell('A'.$i)->getValue())<>''){				
				$data[] = array(
					'serial'=>trim($excel->getActiveSheet()->getCell('A'.$i)->getValue())
					,'fullname'=>trim($excel->getActiveSheet()->getCell('B'.$i)->getValue())
					,'title'=>trim($excel->getActiveSheet()->getCell('C'.$i)->getValue())
					,'dept'=>trim($excel->getActiveSheet()->getCell('D'.$i)->getValue())
					,'co'=>trim($excel->getActiveSheet()->getCell('E'.$i)->getValue())
					,'add1'=>trim($excel->getActiveSheet()->getCell('F'.$i)->getValue())
					,'add2'=>trim($excel->getActiveSheet()->getCell('G'.$i)->getValue())
					,'state'=>trim($excel->getActiveSheet()->getCell('H'.$i)->getValue())
					,'country'=>trim($excel->getActiveSheet()->getCell('I'.$i)->getValue())
					,'mobile'=>str_replace(' ','',trim($excel->getActiveSheet()->getCell('J'.$i)->getValue()))
					,'tlp'=>str_replace(' ','',trim($excel->getActiveSheet()->getCell('K'.$i)->getValue()))
					,'fax'=>trim($excel->getActiveSheet()->getCell('L'.$i)->getValue())
					,'email'=>trim($excel->getActiveSheet()->getCell('M'.$i)->getValue())
					,'status_data'=>'1'
				);
				$i++;
			}
			$this->candidate_model->import($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Import Success!!!</div>');
			redirect('candidate/import');
		}
	}
	function dist(){
		/* - Table - */
		$tmp = array('table_open'=>'<table class="table table-bordered table-striped">');
		$this->table->set_template($tmp);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading(
			'No'
			,'Telemarketer'
			,'On Proses'
			,'Valid'
			,'Audit'
			,'Distribution'
			,'Action'
		);
		$result = $this->user_model->get_telemarketer()->result();
		$i=1;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,$r->fullname
				,number_format($this->candidate_model->count_onproses($r->id))
				,number_format($this->candidate_model->count_valid($r->id))
				,number_format($this->candidate_model->count_audit($r->id))
				,form_input(array('type'=>'number','name'=>'total_'.$r->id,'class'=>'form-control'))
				,anchor('candidate/clear/'.$r->id,'Clear',array('class'=>'btn btn-primary','onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$data['total'] = 'Total '.number_format($this->candidate_model->count_dist());
		$this->template->load('dist',$data);
	}
	function dist_(){
		$result = $this->user_model->get_telemarketer()->result();
		foreach($result as $r){
			if($this->input->post('total_'.$r->id)<>''){
				$this->candidate_model->dist($r->id,$this->input->post('total_'.$r->id));
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">Distribution Complete!!!</div>');
		redirect('candidate/dist');
	}
	function callagain(){
		$result = $this->candidate_model->get_callagain()->result();
		foreach($result as $r){
			if($this->callhis_model->count_from_candidate_id($r->id)<6){
				$data = array(
					'status_data'=>'1'
				);
				$this->candidate_model->update($r->id,$data);
			}
		}
		redirect('candidate/dist');
	}	
	function clear($id){
		$this->candidate_model->clear($id);
		redirect('candidate/dist');
	}
	function send_email($id){
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		if($this->form_validation->run()===false){
			echo '<div class="alert alert-danger">'.validation_errors().'</div>';
		}else{
			$email = $this->input->post('email');
			$fullname = $this->input->post('fullname');
			if($fullname<>''){
				$data['fullname'] = $fullname;
			}else{
				$data['fullname'] = $this->candidate_model->get_fullname_from_id($id);
			}
			$data['telemarketer'] = $this->template->get_fullname_user_login();
			$content = $this->load->view('email',$data,true);
			
			$this->load->library('email');

			$this->email->from('no-reply@adirect.web.id','MTA2015');
			$this->email->to($email);
			$this->email->subject('Invitation to visit MTA2015');
			$this->email->message($content);
			if (!$this->email->send()){
				echo '<div class="alert alert-danger">'.$this->email->print_debugger().'</div>';
			}else{
				$this->candidate_model->send_email($id,$email);
				echo '<div class="alert alert-success">Sending email success!!!</div>';
				
			}
		}
	}
	function report(){
		$date_phone = $this->candidate_model->get_date_phone()->result();
		/* - Repor 1 - */
		$tmp = array('table_open'=>'<table class="table table-bordered table-striped">');
		$this->table->set_template($tmp);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading(
			'No'
			,'Status Phone'
			,'Total'
		);
		$result = $this->candidate_model->report()->result();
		$i=1;
		$total = 0;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,status_phone($r->status_phone)
				,number_format($r->total)
			);
			$total += $r->total;
		}
		$this->table->add_row(
			array('data'=>'Total','colspan'=>'2','align'=>'right')
			,array('data'=>number_format($total))
		);
		
		$data['table'] = $this->table->generate();
		
		/* - Report 2- */
		$tmp = array('table_open'=>'<table class="table table-bordered table-striped">');
		$this->table->set_template($tmp);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading(
			'No'
			,'Status Phone'
			,'Total'
		);
		$row = $this->candidate_model->report_2()->row();
		$this->table->add_row(1,'Unsuccess',$row->unsuccess);
		$this->table->add_row(2,'Success',$row->success);
		$this->table->add_row(array('data'=>'Total','colspan'=>2,'align'=>'right'),number_format($row->total));
		
		$data['table_2'] = $this->table->generate();
		
		$this->template->load('report',$data);
	}
	function export($order_column='id',$order_type='asc'){
		ini_set('memory_limit','-1'); 		
		//set_time_limit(0);
		require_once "../adirect/assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$excel->getActiveSheet()->setTitle('LIST DATA');
				
		//header
		$excel->getActiveSheet()->setCellValue('A1', 'SERIAL');
		$excel->getActiveSheet()->setCellValue('B1', 'NAME');
		$excel->getActiveSheet()->setCellValue('C1', 'TITLE');
		$excel->getActiveSheet()->setCellValue('D1', 'DEPT');
		$excel->getActiveSheet()->setCellValue('E1', 'CO');
		$excel->getActiveSheet()->setCellValue('F1', 'ADD 1');
		$excel->getActiveSheet()->setCellValue('G1', 'ADD 2');
		$excel->getActiveSheet()->setCellValue('H1', 'STATE');
		$excel->getActiveSheet()->setCellValue('I1', 'COUNTRY');
		$excel->getActiveSheet()->setCellValue('J1', 'MOBILE');
		$excel->getActiveSheet()->setCellValue('K1', 'TEL');
		$excel->getActiveSheet()->setCellValue('L1', 'FAX');
		$excel->getActiveSheet()->setCellValue('M1', 'EMAIL');
		$excel->getActiveSheet()->setCellValue('N1', 'REMARK');
		$excel->getActiveSheet()->setCellValue('O1', 'NEW NAME');
		$excel->getActiveSheet()->setCellValue('P1', 'NEW TITLE');
		$excel->getActiveSheet()->setCellValue('Q1', 'NEW ADDRESS');
		$excel->getActiveSheet()->setCellValue('R1', 'NEW MOBILE');
		$excel->getActiveSheet()->setCellValue('S1', 'NEW TEL');
		$excel->getActiveSheet()->setCellValue('T1', 'NEW EMAIL');
		$excel->getActiveSheet()->setCellValue('U1', 'STATUS');
		
		
		$result = $this->candidate_model->export($order_column,$order_type)->result();
		$i=2;		
		foreach($result as $r){		
			$excel->getActiveSheet()->setCellValue('A'.$i, $r->serial);
			$excel->getActiveSheet()->setCellValue('B'.$i, $r->fullname);
			$excel->getActiveSheet()->setCellValue('C'.$i, $r->title);
			$excel->getActiveSheet()->setCellValue('D'.$i, $r->dept);
			$excel->getActiveSheet()->setCellValue('E'.$i, $r->co);
			$excel->getActiveSheet()->setCellValue('F'.$i, $r->add1);
			$excel->getActiveSheet()->setCellValue('G'.$i, $r->add2);
			$excel->getActiveSheet()->setCellValue('H'.$i, $r->state);
			$excel->getActiveSheet()->setCellValue('I'.$i, $r->country);
			$excel->getActiveSheet()->setCellValueExplicit('J'.$i, $r->mobile);
			$excel->getActiveSheet()->setCellValueExplicit('K'.$i, $r->tlp);
			$excel->getActiveSheet()->setCellValueExplicit('L'.$i, $r->fax);
			$excel->getActiveSheet()->setCellValue('M'.$i, $r->email);
			$excel->getActiveSheet()->setCellValue('N'.$i, $r->remark);
			$excel->getActiveSheet()->setCellValue('O'.$i, $r->new_name);
			$excel->getActiveSheet()->setCellValue('P'.$i, $r->new_title);
			$excel->getActiveSheet()->setCellValue('Q'.$i, $r->new_add);
			$excel->getActiveSheet()->setCellValueExplicit('R'.$i, $r->new_mobile);
			$excel->getActiveSheet()->setCellValueExplicit('S'.$i, $r->new_tlp);
			$excel->getActiveSheet()->setCellValue('T'.$i, $r->new_email);
			$excel->getActiveSheet()->setCellValue('U'.$i, status_phone($r->status_phone));
			$i++;
		}

		$filename='LIST_DATA_'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');					
	}		
}
