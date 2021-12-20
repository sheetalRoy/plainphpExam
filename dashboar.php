<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
        
        public $status; 
        public $roles;
    
        function __construct(){
            parent::__construct();
            $this->load->model('Audit_model', 'audit_model', TRUE);
            $this->load->model('Reset_user_pwd_model', 'reset_user_pwd_model', TRUE);
            $this->load->model('User_model', 'user_model', TRUE);
			$this->load->model('Admin_model', 'admin_model', TRUE);
			$this->load->model('Subuser_model', 'subuser_model', TRUE);
			$this->load->model('Business_model', 'business_model', TRUE);
            $this->load->library('form_validation');
			$this->load->library('authentication');    
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            $this->status = $this->config->item('status'); 
            $this->roles = $this->config->item('roles');
            if(@$this->session->userdata['routes_login']=='rsd'){
                $this->session->sess_destroy();
                redirect(site_url().'dashboard/login/');
            }           
			
            $this->load->model('Carclass_model', 'carclass_model', TRUE);//added by sathik jan 29
		}      
    
	//Dashboard Main Page
		public function index(){
            if(empty($this->session->userdata['Email_id'])){
				$this->session->sess_destroy();
                redirect(site_url().'dashboard/login/');
            }  
			//$this->authentication->login_admin($result['Id'], $result['Customer_name'],$result['Role_type'],$result['Customer_ref_id']);
            /*front page*/
			if($this->session->userdata("Role_type")=='partner' || $this->session->userdata("Role_type")=='sub_user' )
			{
				//$data['reserve'] = $this->business_model->loadReservation();
				$location_address_id = json_decode($this->session->userdata("Location_address_id"),TRUE);
				$this->db->select('`Id`,`Location_name`, `Location_external_code`, `Location_internal_code`');
                $this->db->where('Status',"1");
                $this->db->where_in("Customer_ref_id", array($this->session->userdata['Id'],$this->session->userdata['Customer_ref_id']));
//                $this->db->where('Customer_ref_id',$this->session->userdata('Id'));
				$this->db->where_in('Id',$location_address_id);
                // $this->db->where_not_in('Location_external_code',array('MIA','RIC','SXM','OTP'));
				$location_temp = $this->db->get('Routes_customer_location')->result_array();
				$this->session->set_userdata("Locations", $location_temp);
				
				$data['main_menu'] ='menu';
                $data['top_menu'] = 'Dashboard';
				$data = $this->session->userdata();  
//                $data['reserve'] = $this->business_model->loadReservation();
                $data['reserve']=array();
                // $data['recent_reserve'] = $this->business_model->loadRecentReservation();
//                 print_r($this->db->last_query());
//                 exit;
				//$this->load->view('index', $data); 
				//get last updatetime
				$data['update_time'] = $this->user_model->loadUserUpdateTime();
				  
                $data['booked_graph'] = $this->loadBookingsGraphs();
                $data['cancelled_graph'] = $this->loadCancelledGraphs();
                $data['fleet_graph'] = $this->loadFleetLoadGraphs();  
	            //$this->load->view('dashboard', $data);
                	###999#### snapshot calculation hidded 21-1-2020 by Madhu ####999####
                /*$affiliate_sub = $affiliate = '';
                $res['Deposit'] = 0;
                $res['Avialable_reserve'] = 0;
                $res['Allowance'] = 0;
                $res['Total_Reserve']=0;
                $res['future_sum']=0;
                $res['Commission_amount'] =$res['sum_avail']= 0;
                $res['prepaid_vouchers']=$res['prepaid_future_vouchers']=$res['pay_on_arrival_vouchers']=$res['pay_on_arrival_future_vouchers']=0;
                $res['Commission_amount'] =$res['sum_avail'] = 0;
                if($this->session->userdata("Role_type")=='partner'){
                    $affiliate = $this->user_model->partner_summary($this->session->userdata("Id"));
                    foreach($affiliate as $affli_data){
                        $res['Deposit'] += $affli_data['Deposit'];
                        $res['prepaid_vouchers'] += $affli_data['Prepaid_vouchers'];
                        $res['prepaid_future_vouchers'] += $affli_data['Prepaid_future_vouchers'];
                        $res['Total_Reserve'] +=$affli_data['Prepaid_future_vouchers']+$affli_data['Prepaid_vouchers']+$affli_data['Deposit'];
                        $res['pay_on_arrival_vouchers'] += $affli_data['Pay_on_arrival_vouchers'];
                        $res['pay_on_arrival_future_vouchers'] += $affli_data['Pay_on_arrival_future_vouchers'];
                        // $res['Allowance'] += $affli_data['Allowance'];
                        // $res['Total_Reserve'] += $affli_data['Allowance']+$affli_data['Deposit'];
                        // $res['future_sum'] += $affli_data['Future_vouchers'];
                        $res['Avialable_reserve'] += $affli_data['Avialable_reserve'];
                        $res['Settlement_Date'] = $affli_data['Settlement_Date'];
                        $res['sum_avail'] += $affli_data['Available_vouchers'];
                        $res['Commission_amount'] += $affli_data['Commission_amount'];
                    }
                }elseif($this->session->userdata("Role_type")=='sub_user'){
                    $affiliate = $this->user_model->getUserInfo1($this->session->userdata['Customer_ref_id']);
                    $affiliate_sub = $this->user_model->subuser_summary($this->session->userdata['Id']);
                    foreach($affiliate_sub as $affli_data){
                        $res['prepaid_vouchers'] += $affli_data['Prepaid_vouchers'];
                        $res['prepaid_future_vouchers'] += $affli_data['Prepaid_future_vouchers'];
                        $res['pay_on_arrival_vouchers'] += $affli_data['Pay_on_arrival_vouchers'];
                        $res['pay_on_arrival_future_vouchers'] += $affli_data['Pay_on_arrival_future_vouchers'];
                        $res['sum_avail'] += $affli_data['Available_vouchers'];
                        $res['Commission_amount'] += $affli_data['Commission_amount'];
                    }
                    foreach($affiliate as $affli_data){
                        $res['Deposit'] += $affli_data['Deposit'];
                        $res['Avialable_reserve'] += $affli_data['Avialable_reserve'];
                        $res['Allowance'] += $affli_data['Allowance'];
                        // $res['Total_Reserve'] += $affli_data['Allowance']+$affli_data['Deposit'];
                        $res['Total_Reserve'] +=$affli_data['Prepaid_future_vouchers']+$affli_data['Prepaid_vouchers']+$affli_data['Deposit'];
                        $res['Settlement_Date'] = $affli_data['Settlement_Date'];
                    }
                }
                $data['affiliate'] = (object)$res;*/
                    ###999#### end snapshot calculation hidded 21-1-2020 by Madhu ####999####
//				$data['affiliate'] = $this->user_model->getUserInfo($this->session->userdata['Roleuser_ref_id']);
			}else if($this->session->userdata("Role_type")=='admin') // super admin(SDS)
			{

                $data = $this->session->userdata();
                
                $location_address_id = json_decode($this->session->userdata("Location_address_id"),TRUE);
                $this->db->select('`Id`,`Location_name`, `Location_external_code`, `Location_internal_code`');
                $this->db->where('Status',"1");
                $this->db->where_in('Id',$location_address_id);
                // $this->db->where_not_in('Location_external_code',array('MIA','RIC','SXM','OTP'));
                $location_temp = $this->db->get('Routes_customer_location')->result_array();
                $this->session->set_userdata("Locations", $location_temp);

//                $data['reserve'] = $this->business_model->loadReservation();
                $data['reserve']=array();
                // $data['recent_reserve'] = $this->business_model->loadRecentReservation();
				$data['main_menu'] ='menu';
                $data['top_menu'] = 'Dashboard';
				//get last updatetime
				$data['update_time'] = $this->user_model->loadUserUpdateTime(); 
                $data['booked_graph'] = $this->loadBookingsGraphs();
                $data['cancelled_graph'] = $this->loadCancelledGraphs();
               $data['fleet_graph'] = $this->loadFleetLoadGraphs();
                // $affiliate = $this->user_model->partner_summary();
                	###999#### snapshot calculation hidded 21-1-2020 by Madhu ####999####
                /*$res['Deposit'] = 0;
                $res['Avialable_reserve'] = 0;
                $res['Allowance'] = 0;
                $res['Total_Reserve']=0;
                $res['future_sum']=0;
                $res['Commission_amount'] =$res['sum_avail']= 0;

                $res['prepaid_vouchers']=$res['prepaid_future_vouchers']=$res['pay_on_arrival_vouchers']=$res['pay_on_arrival_future_vouchers']=0;
                $res['Commission_amount'] =$res['sum_avail'] = 0;
                foreach($affiliate as $affli_data){
                    $res['Deposit'] += $affli_data['Deposit'];
                    $res['Avialable_reserve'] += $affli_data['Avialable_reserve'];
                   $res['prepaid_future_vouchers'] += $affli_data['Prepaid_future_vouchers'];
                    $res['prepaid_vouchers'] += $affli_data['Prepaid_vouchers'];
                    $res['Total_Reserve'] += $affli_data['Prepaid_future_vouchers']+$affli_data['Prepaid_vouchers']+$affli_data['Deposit'];
                    $res['pay_on_arrival_vouchers'] += $affli_data['Pay_on_arrival_vouchers'];
                    $res['pay_on_arrival_future_vouchers'] += $affli_data['Pay_on_arrival_future_vouchers'];
                    
                    $res['Settlement_Date'] = $affli_data['Settlement_Date'];
                    // $res['future_sum'] += $affli_data['Future_vouchers'];
                    $res['sum_avail'] += $affli_data['Available_vouchers'];
                    $res['Commission_amount'] += $affli_data['Commission_amount'];
                }
                $data['affiliate'] = (object)$res;*/
                    ###999#### end snapshot calculation hidded 21-1-2020 by Madhu ####999####
			}
            if($this->session->userdata("Role_type")=='partner' || $this->session->userdata("Role_type")=='admin'){
                $data['locations_new'] = $this->getaffiliateReservation("loadlocationName");   //sathik added this code
                // print_r($data['locations_new']);
            }
            $data['networks'] = $this->admin_model->network_summary_dashboard();
            //added by sathik jan 29
            $this->db->select('Id,Car_class_name');
            $this->db->where('Status','1');
            $result1 =  $this->db->get('Routes_car_class')->result_array();
            $result2 = array();
            $result2 = $this->getaffiliateReservation("getAllCarClass"); //mia and ric server 
            $result1 = array_merge($result1,$result2);
            $tempArr = array_unique(array_column($result1, 'Car_class_name'));
            $result  = array_intersect_key($result1, $tempArr);
            $data['car_class'] = $result;
            $Module ='Dashboard';
            $Activity ='Dashboard page is viewed';
            $Record_link =base_url() . 'dashboard/';
            $this->AuditSave($Module, $Activity, $Record_link);
            // print_r($data['affiliate']);exit;
			$this->load->view('dashboard', $data);
			
		}
        
        public function loadBookingsGraphs(){  
            $this->db->select('count(Routes_reservation.Booked) as total,Routes_reservation.Booked as date, Routes_reservation.Network_ref_id as network');
			if($this->session->userdata('Role_type')=='sub_user'){
				$locationData = $this->session->userdata('Locations');
				foreach($locationData as $locCode){
					//$locationCode[] = $locCode['Location_external_code'];
					$this->db->where('Routes_reservation.RentalLocationID',$locCode['Location_external_code']);
				}
			}elseif($this->session->userdata('Role_type')=='partner'){
                $this->db->where_in('Routes_reservation.Customer_ref_id',array($this->session->userdata('Id'),$this->session->userdata('Customer_ref_id')));
            }
            $this->db->order_by('Routes_reservation.Booked','ASC');
            $this->db->where_in('Routes_reservation.Status',array('1','4'));
            $this->db->where('Routes_reservation.Booked >= ',date('Y-m-d',strtotime('-7 days')));
            $this->db->group_by('Routes_reservation.Network_ref_id,Routes_reservation.Booked');
            $result = $this->db->get('Routes_reservation')->result_array();

            $result3 = array();
            if($this->session->userdata('Role_type')=='admin' || $this->session->userdata('Role_type')=='partner'){
            
                $result3 = $this->getaffiliateReservation("loadBookingsGraphs"); //sathik added this code
                #$result = array_merge($result,$result3);
            }
            $resultrms = array();
            if(!empty($result)){
                foreach ($result as $result_ar2) {
                    $abcd[$result_ar2['network']][$result_ar2['date']][] = $result_ar2;
                }
                foreach ($abcd as $key => $abcd_arr) {
                    foreach ($abcd_arr as $key => $abcd_arr2) {
                        $total_re = 0;
                        foreach ($abcd_arr2 as $key => $abcd_arr3) {
                            $total_re += $abcd_arr3['total'];
                        }
                        $abcd_arr3['total'] = $total_re;
                        $resultrms[] = $abcd_arr3;
                    }
                }
            }
            $result_data1 = array_merge($result3,$resultrms);
            $result2 = array();
            $abcd = array();
            if(!empty($result_data1)){
                foreach ($result_data1 as $result_ar2) {
                    $abcd[$result_ar2['network']][$result_ar2['date']][] = $result_ar2;
                }
                foreach ($abcd as $key => $abcd_arr) {
                    foreach ($abcd_arr as $key => $abcd_arr2) {
                        $total_re = 0;
                        foreach ($abcd_arr2 as $key => $abcd_arr3) {
                            $total_re += $abcd_arr3['total'];
                        }
                        $abcd_arr3['total'] = $total_re;
                        $result2[] = $abcd_arr3;
                    }
                }
            }

            $keys = array_column($result2, 'date');
            array_multisort($keys, SORT_ASC, $result2);
            $data = array();
            $gc = 0;

            $data = array();
            if(!empty($result2)){
                foreach($result2 as $result_arr){
				    $date = $result_arr['date'];
    				$networkId = $result_arr['network'];
					$networkInfo = $this->admin_model->edit_network($networkId);
                   // $data[$result_arr['date']]=$result_arr['total'];
					$data[$date][$networkId] = $result_arr;
					$data[$date][$networkId]['network_name'] = $networkInfo['Network_name'];
                }
            }
            return $data;
        } 
        public function loadCancelledGraphs(){  
            $this->db->select('count(Routes_reservation.Booked) as total,Routes_reservation.Booked as date, Routes_reservation.Network_ref_id as network');
			if($this->session->userdata('Role_type')=='sub_user'){
				$locationData = $this->session->userdata('Locations');
				foreach($locationData as $locCode){
					//$locationCode[] = $locCode['Location_external_code'];
					$this->db->where('Routes_reservation.RentalLocationID',$locCode['Location_external_code']);
				}
			}elseif($this->session->userdata('Role_type')=='partner'){
                $this->db->where_in('Routes_reservation.Customer_ref_id',array($this->session->userdata('Id'),$this->session->userdata('Customer_ref_id')));
            }
            $this->db->order_by('Routes_reservation.Booked','ASC');
            $this->db->where('Routes_reservation.Status','3');
            $this->db->where('Routes_reservation.Booked >= ',date('Y-m-d',strtotime('-7 days')));
            $this->db->group_by('Routes_reservation.Network_ref_id,Routes_reservation.Booked');
            $result = $this->db->get('Routes_reservation')->result_array();

            $result3 = array();

            if($this->session->userdata('Role_type')=='admin' || $this->session->userdata('Role_type')=='partner'){
                //test by madhu
                $result3 = $this->getaffiliateReservation("loadCancelledGraphs"); //sathik added code here
            }
            $result = array_merge($result,$result3);

            $data = array();
            if(!empty($result)){
                foreach($result as $result_arr){
				    $date = $result_arr['date'];
    				$networkId = $result_arr['network'];
					$networkInfo = $this->admin_model->edit_network($networkId);
                   // $data[$result_arr['date']]=$result_arr['total'];
					$data[$date][$networkId] = $result_arr;
					$data[$date][$networkId]['network_name'] = $networkInfo['Network_name'];
                }
            }
            return $data;
        }

        public function loadFleetLoadGraphs(){  
            $this->db->select('count(Booked) as total,Booked as date,ClassCode as car');
			if($this->session->userdata('Role_type')=='sub_user'){
				$locationData = $this->session->userdata('Locations');
				foreach($locationData as $locCode){
					//$locationCode[] = $locCode['Location_external_code'];
					$this->db->where('Routes_reservation.RentalLocationID',$locCode['Location_external_code']);
				}
			}elseif($this->session->userdata('Role_type')=='partner'){
                $this->db->where_in('Routes_reservation.Customer_ref_id',array($this->session->userdata('Id'),$this->session->userdata('Customer_ref_id')));
            }
           // $this->db->order_by('Routes_reservation.Id','DESC');
            $this->db->group_by('ClassCode,Booked');
            $this->db->where_in('Routes_reservation.Status',array('1','4'));
            $this->db->where('Routes_reservation.Booked >= ',date('Y-m-d',strtotime('-7 days')));
            //$this->db->group_by('');
            $result = $this->db->get('Routes_reservation')->result_array();
            $result3 = array();
            $result3 = $this->getaffiliateReservation("loadFleetLoadGraphs");
            $result_data = []; $i=0;
               foreach ($result as $key => $value) {
                       $result_data[$i] = $value;
                    foreach ($result3 as $key1 => $value1) {
                   
                        if($value['car'] == $value1['car'] && $value['date'] == $value1['date'] ){
                            $result_data[$i]['total'] = $value['total']+$value1['total'];
                        }
                    }
                    $i++;
                }
            $result_data1 = array_merge($result3,$result_data);
            $keys = array_column($result_data1, 'date');
            array_multisort($keys, SORT_ASC, $result_data1);
            $data = array();
            if(!empty($result_data1)){
                foreach($result_data1 as $result_arr){
                    $data[$result_arr['date']][$result_arr['car']]=$result_arr;
                }
            }
            //print_r($data);
            return $data;
        }
        
        public function loadLocationGraph(){
            $locCode = $_GET['locCode'];
            $res_type = $_GET['res_type'];
//            $reserve = $this->business_model->loadReservation();
            if($res_type == '1'){
                $res_type = array('1','4');
            }
            $reserve = array();
            $networks = $this->admin_model->network_summary_dashboard();
            foreach($reserve as $resDat):
                $network[$resDat['Network_ref_id']][] = $resDat;
            endforeach;
            // $typeTotals = array_map("count", $network);
            $aff_res = $this->user_model->getLocationAffiliate();
            // print_r($aff_res);
            $locationGraph = $this->business_model->loadLocBookingsGraph($locCode,$res_type,$aff_res);
            // print_r($aff_res);exit();
            $ic = 0;
            $gc = 0;  
            $graphDataLoc = array();
            $g12c = 0;
            foreach ($locationGraph as $key => $locationGraph_arr) { 
                if(date('Y-m-d')==$key){
                    $totalData1 = 0;
                    foreach ($locationGraph_arr as $key12 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key12){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y');
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData1 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }							
                    $ic = 1;
                    $gc++;
                }
                if(date('Y-m-d',strtotime('-1 day'))==$key){
                    $totalData2 = 0;
                    foreach ($locationGraph_arr as $key13 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key13){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y',strtotime('-1 day'));
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData2 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }
                    $ic = 1;
                    $gc++;
                }
                if(date('Y-m-d',strtotime('-2 day'))==$key){
                    $totalData3 = 0;
                    foreach ($locationGraph_arr as $key14 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key14){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y',strtotime('-2 day'));
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData3 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }
                    $ic = 1;
                    $gc++;
                }
                if(date('Y-m-d',strtotime('-3 day'))==$key){
                    $totalData4 = 0;
                    foreach ($locationGraph_arr as $key15 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key15){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y',strtotime('-3 day'));
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData4 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }
                    $ic = 1;
                    $gc++;
                }
                if(date('Y-m-d',strtotime('-4 day'))==$key){
                    $totalData5 = 0;
                    foreach ($locationGraph_arr as $key16 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key16){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y',strtotime('-4 day'));
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData5 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }
                    $ic = 1;
                    $gc++;
                }
                if(date('Y-m-d',strtotime('-5 day'))==$key){
                    $totalData6 = 0;
                    foreach ($locationGraph_arr as $key17 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key17){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y',strtotime('-5 day'));
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData6 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }
                    $ic = 1;
                    $gc++;
                }
                if(date('Y-m-d',strtotime('-6 day'))==$key){
                    $totalData7 = 0;
                    foreach ($locationGraph_arr as $key18 => $locationGraph_arr_val) { 
                        if($locationGraph_arr_val['network'] == $key18){
                            $graphDataLoc[$gc]['date'] = date('m-d-Y',strtotime('-6 day'));
                            $graphDataLoc[$gc][$locationGraph_arr_val['network_name']] = $locationGraph_arr_val['total'];
                            $totalData7 += $locationGraph_arr_val['total'];
                            //$i1 = 1;
                        }
                    }
                    $ic = 1;
                    $gc++;
                }
            }
            $g1 = 0;
            foreach($networks as $netArr):                            
                $graphAllList[$g1]['bullet'] = "round";
                $graphAllList[$g1]['bulletSize'] = 8;
                $graphAllList[$g1]['fillAlphas'] = 0.2;
                $graphAllList[$g1]['fillColorsField'] = "lineColor";
                $graphAllList[$g1]['legendValueText'] = "[[value]]";
                $graphAllList[$g1]['lineColorField'] = "lineColor";
                $graphAllList[$g1]['title'] = $netArr['Network_name'];
                $graphAllList[$g1]['type'] = "smoothedLine";
                $graphAllList[$g1]['valueField'] = $netArr['Network_name'];
                $g1++;
            endforeach;
        
          
            $graphDataLocValue = json_encode($graphDataLoc);
            echo $graphDataLocValue;
        }
        

        public function register()
        {
             
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');    
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
                       
            if ($this->form_validation->run() == FALSE) {   
                $this->load->view('register');
            }else{                
                if($this->user_model->isDuplicate($this->input->post('email'))){
                    $this->session->set_flashdata('flash_message', 'User email already exists');
                    redirect(site_url().'dashboard/login');
                }else{
                    
                    //$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                   // $id = $this->user_model->insertUser($clean); 
                   // $token = $this->user_model->insertToken($id);                                        
                    
                    $qstring = $this->base64url_encode($token);                    
                    $url = site_url() . 'dashboard/complete/token/' . $qstring;
                    $link = '<a href="' . $url . '">' . $url . '</a>'; 
					$log_link = '<a href="' . site_url() .'dashboard/login">Login Through Routes Website</a>'; 
					
					$subject = '';
					$msg = '';
					$array = array();
					$name = array();
					
					//get subject / email msg / sms_msg
		            $result_sub_msg = $this->signup_subject_msg();
					
					//Getting Subject And Message
					$subject = $result_sub_msg['subject'];
            		$msg = $result_sub_msg['msg'];
					
					// To Email-Id
					$to = $this->input->post('email');
					$name[] = $this->input->post('firstname');
					
					$user_name['username'] = $name;
					
					$user_name['content'] = $msg;
					
					$template_content = $this->load->view('email_template/sign_up', $user_name);
					
					echo "<--------------------------------------- $to -----------------------------------------------------><br>";
					echo "Subject: " . $subject . "<br>";
					
					echo $template_content;
					exit;

                    /*$this->load->library('email');
					
					$message = '<!DOCTYPE html><html lang="en">';                     
					$message .= '<strong>You have signed up with our website</strong><br>';
					$message .= '<strong>Please click:</strong> ' . $link.'<br>';  
					$message .= '<strong>Please click for login:</strong> ' . $log_link;   
					$message .= '</body></html>';                       
					
					$email_status = $this->send_email_model->email($to, $subject, $template_content);
					$this->email->from('noreply@straightdrive.co.in','Complete Registration');
					//$this->email->reply_to('noreply@sds.co.in');
					$this->email->to($clean['email']);
					$this->email->subject('Your Password Link');
					$this->email->message($message);
					if($this->email->send())
					{
						$this->session->set_flashdata('flash_message_success', 'New Partner has been registered successfully..');
						redirect(site_url().'dashboard');
					}
					else
					{
						$this->session->set_flashdata('flash_message', 'Mail Not Sent');
						redirect(site_url().'dashboard');
					}*/
					
                };              
            }
        }
        
		function signup_subject_msg() {
			$data['subject'] = 'Welcome to Routes Car Rental';
			$data['msg'] = '<p style="font-family: \'ABeeZee\',serif;font-size: 15px;color:#393939;padding: 10px 0px 10px 0px;margin:0px;">Thank you for signing up with Routes Car Rental, We are very happy to have you on-board.</p>';
			$data['sms_msg'] = 'Thank you for signing up with Routes Car Rental, We are very happy to have you on-board. Cheers! Routes Car Rental Team.';
			return $data;
		}
        
        protected function _islocal(){
            return strpos($_SERVER['HTTP_HOST'], 'local');
        }
        
        public function complete()
        {                                   
            $token = base64_decode($this->uri->segment(4));       
            $cleanToken = $this->security->xss_clean($token);
			            
            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();           
            
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'dashboard/login');
            }            
            $data = array(
                'Customer_name'=> $user_info->Customer_name, 
                'Email_id'=>$user_info->Email_id, 
                'Id'=>$user_info->Id, 
                'Token'=>$this->base64url_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]|alpha_numeric|callback_password_check');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|alpha_numeric|callback_password_check');              
            
            if ($this->form_validation->run() == FALSE) {   
                $this->load->view('complete', $data);
            }else{
                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);
                
                $cleanPost = $this->security->xss_clean($post);
                
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
                unset($cleanPost['passconf']);
                $userInfo = $this->user_model->updateUserInfo($cleanPost);
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                    redirect(site_url().'dashboard/login');
                }
                
                unset($userInfo->password);
                
                foreach($userInfo as $key=>$val){
                    $this->session->set_userdata($key, $val);
                }
				$this->session->set_flashdata('flash_message_success', 'WELCOME TO ROUTES MANAGEMENT TEAM');
                redirect(site_url().'dashboard/');
                
            }
        }
        
        public function login()
        {


             

           /*  $user_data = $this->reset_user_pwd_model->checkCreatedDate($this->input->post('email'));
             $check_created_date = $user_data->Created_datetime;
             $stop_date = date('Y-m-d H:i:s', strtotime($check_created_date.' +1 day'));
              echo( $check_created_date );exit;
              $user_id=$this->reset_user_pwd_model->getUserIDFromUserdata($this->input->post('email'));*/
              //var_dump($user_id->Id);exit;
             

              $user_id=$this->reset_user_pwd_model->getUserIDFromUserdata($this->input->post('email'));

              $get_all_days=$this->reset_user_pwd_model->load_all_user_id();
              foreach ($get_all_days as $key) {
             
               $u_id = json_decode($key->users_id);
               if(in_array($user_id->Id,$u_id)){

               $user_data = $this->reset_user_pwd_model->checkCreatedDate($this->input->post('email'));
               $check_created_date = $user_data->Created_datetime;
               $incremented_date = date('Y-m-d H:i:s', strtotime($check_created_date.' +'.$key->no_of_days.' day'));
               $todays_date = date('Y-m-d H:i:s');

               if($todays_date>$incremented_date){
                
                 var_dump('test');exit;
                 }else{
                    var_dump('not ghdfjh');
                 }
              
              }else{
              echo('not found99999');
              }
              }
           
             //$getNoOfDays = $this->reset_user_pwd_model->getNoOfDays($this->input->post('email'));
                  /// echo($getNoOfDays);exit;
          
            if(!empty($this->session->userdata('Role_type'))){
                // $this->session->set_flashdata('flash_new_update','ab');


				redirect(site_url().'dashboard');
			}
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
            $this->form_validation->set_rules('password', 'Password', 'required'); 
            
            if($this->form_validation->run() == FALSE) {
                $this->load->view('login');
            }else{
               // $post = $this->input->post();  
             

                $post = $this->input->post();  
                $clean = $this->security->xss_clean($post);              
                $userInfo = $this->user_model->checkLogin($clean);

                if(!$userInfo){
                    $this->session->set_flashdata('flash_message_login', 'Invalid Credential');
                    redirect(site_url().'dashboard/login');
                }
                
                if($userInfo->Status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account has been deactivated, Please contact Admin for more details');
                    redirect(site_url().'dashboard/login');
                }
                //Authentication user for assigning permission
                $this->authentication->login_admin($userInfo->Id, $userInfo->Customer_name,$userInfo->Role_type,$userInfo->Customer_ref_id);
                
                if(($userInfo->Role_type == 'admin')||($userInfo->Role_type == 'partner')){
                    foreach($userInfo as $key=>$val){
                        $this->session->set_userdata($key, $val);
                    }
                    $this->session->set_userdata('routes_login', 'rms');
                    $Module ='Login';
                    $Activity ='User Logged in and viewed dashboard';
                    $Record_link =base_url().'dashboard/login/';
                    $this->AuditSave($Module, $Activity, $Record_link);
                    // $this->session->set_flashdata('flash_new_update','ab');
                    redirect(site_url().'dashboard/');
                }else{
                    if(($userInfo->Role_address_id == '[]')||($userInfo->Role_address_id == '')){
                        $this->session->set_flashdata('flash_message', 'No Role has been assigned to ths Account , Please contact your Admin for more details');
                    $this->session->set_userdata('routes_login', 'rms');
                        redirect(site_url().'dashboard/login');
                    }
                    else{                
                        foreach($userInfo as $key=>$val){
                            $this->session->set_userdata($key, $val);
                        }
                    //$this->load->view('index',$userdata);
                    $this->session->set_userdata('routes_login', 'rms');
                        $Module ='Login';
                        $Activity ='User Logged in and viewed dashboard';
                        $Record_link =base_url().'dashboard/login/';
                        $this->AuditSave($Module, $Activity, $Record_link);
                // $this->session->set_flashdata('flash_new_update','ab');
                    redirect(site_url().'dashboard/');
                    }
                }
        
           } 
        }
        
        public function logout()
        {
            $Module ='Logout';
            $Activity ='User Logged Out';
            $Record_link =base_url().'dashboard/';
            $this->AuditSave($Module, $Activity, $Record_link);
            $this->session->sess_destroy();
            redirect(site_url().'dashboard/login/');
        }
        
        public function forgot()
        {
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            
            if($this->form_validation->run() == FALSE) {
                $this->load->view('forgot');
            }else{
                $email = $this->input->post('email');  
                $clean = $this->security->xss_clean($email);
                $userInfo = $this->user_model->getUserInfoByEmail($clean);
				
                
                if(!$userInfo){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                    redirect(site_url().'dashboard/forgot');
                }   
                
                if($userInfo->Status != $this->status[1]){ //if status is not approved
                    $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                    redirect(site_url().'dashboard/forgot');
                }
                
                //build token 
				
                $token = $this->user_model->insertToken($userInfo->Id);                        
                $qstring = $this->base64url_encode($token);                  
                $url = site_url() . 'dashboard/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
				$log_link = '<a href="' . site_url() .'dashboard/login">Login Through Routes Website</a>'; 
				
				$this->load->library('email');
				
				$message = '<!DOCTYPE html><html lang="en">';                     
				$message .= '<strong>A password reset has been requested for this email account</strong><br>';
				$message .= '<strong>Please click:</strong> ' . $link.'<br>';
				$message .= '<strong>Please click for login:</strong> ' . $log_link;   
				$message .= '</body></html>';                       
				
				
				$this->email->from('noreply@straightdrive.co.in','Password Reset Link');
				//$this->email->reply_to('noreply@sds.co.in');
				$this->email->to($email);
				$this->email->subject('Reset Your Password');
				$this->email->message($message);
				if($this->email->send())
				{
					$this->session->set_flashdata('flash_message_success', 'Password Reset Link has sent to your registered mail-id successfully..');
					redirect(site_url().'dashboard/login');
				}
				else
				{
					$this->session->set_flashdata('flash_message', 'Mail Not Sent');
					redirect(site_url().'dashboard/login');
				}
				
            }
            
        }
        
        public function reset_password()
        {
            $token = $this->base64url_decode($this->uri->segment(4));  
            var_dump($token);exit;                
            $cleanToken = $this->security->xss_clean($token);
            
            $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();               
            
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'dashboard/login');
            }            
            $data = array(
                'Customer_name'=> $user_info->Customer_name, 
                'Email_id'=>$user_info->Email_id, 
//                'user_id'=>$user_info->id, 
                'Token'=>$this->base64url_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]|alpha_numeric|xss_clean|callback_password_check');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|alpha_numeric|xss_clean|callback_password_check');              
            
            if ($this->form_validation->run() == FALSE) {   
                $this->load->view('reset_password', $data);
            }else{
                                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);                
                $cleanPost = $this->security->xss_clean($post);                
                $hashed = $this->password->create_hash($cleanPost['password']);                
                $cleanPost['password'] = $hashed;
                $cleanPost['user_id'] = $user_info->Id;
                unset($cleanPost['passconf']);                
                if(!$this->user_model->updatePassword($cleanPost)){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                }else{
                    $this->session->set_flashdata('flash_message_success', 'Your password has been updated. You may now login');
                }
                redirect(site_url().'dashboard/login');                
            }
        }
        
    public function base64url_encode($data) { 
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
    } 

    public function base64url_decode($data) { 
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
    }       
	public function password_check($password){
		if(preg_match('#[0-9]#',$password) || preg_match('#[a-zA-Z]#',$password)){
			/*$this->form_validation->set_message('password_check','No special characters are allowed');*/
			return TRUE;
		}
		return FALSE;
	}
    function updateProfileInfo(){
        $this->load->library('password');   
        $password = $this->input->post('action');
        $id = $this->input->post('data2');
        $this->db->select('Password');
        $this->db->where('Id',$id);
        $data = $this->db->get('Routes_user_login')->row_array();
        $current = $this->password->validate_password($password,$data['Password']);
        if($current!=1 && $password!='1234567890'){
            $hashed = $this->password->create_hash($password); 
            $this->db->where('Id',$id);
            $update=$this->db->update('Routes_user_login',array('Password'=>$hashed));
            //if($update) {
                $Module ='My Profile';
                $Activity ='User Changed Password';
                $Record_link =base_url().'dashboard/';
                $this->AuditSave($Module, $Activity, $Record_link);
            //}
        }
    }
    function server_name(){
        print_r($_SERVER);
        
    }
    public function AuditSave($Module, $Activity, $Record_link)
    {
        if (!empty($this->session->userdata('Customer_name'))) {
            $audit_data = array(
                'User_id' => @$this->session->userdata('Id'),
                'User_name' => @$this->session->userdata('Customer_name'),
                'Module' => $Module,
                'Activity' => $Activity,
                'Record_link' => $Record_link,
                'Session_data' => json_encode(@$this->session->userdata()),
                'Login_datetime' => date("Y-m-d H:i", strtotime(@$this->session->userdata('last_login'))),
                'Login_ip' => @$this->session->userdata('login_ip'),
                'Created_datetime' => date("Y-m-d H:i"),
                'Created_ip' => @$this->input->ip_address()
            );
            $this->audit_model->insertAuditDetails($audit_data);
        }
    }
    public function getaffiliateReservation($name) {
       
       // $aff_res = $this->user_model->getLocationAffiliate();
       
        $method =  "";
        $res = array();
      //  if (!empty($aff_res)) {
          /*  if($name == "loadlocationName"){
                $method = $name;
            }
            if($name == "loadBookingsGraphs"){
                $method = $name;
            }
            if($name == "loadCancelledGraphs"){
                $method = $name;
            }
           */
          //  foreach ($aff_res as $aff_res_arr) {

                $ch = curl_init();
                   // $url = 'http://'.$aff_res_arr['affi_prefix'].'.routesrezworld.com/Affiliate_reservations/'.$name;
                $url = 'https://affiliate.caledonrezworld.com/Affiliate_reservations/'.$name;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // execute!
                $response = curl_exec($ch);
                $res[] = json_decode($response, true);
                curl_close($ch);
           // }//die;
        
        //}
        $array = array();
        $array = call_user_func_array("array_merge", $res);
        return $array; 
    }
    function updateAffiliateProfileInfo(){

        $this->load->library('password');
        $password = $this->input->post('action');
        $id = $this->input->post('data2');
        $this->db->select('Password');
        $this->db->where('Id',$id);
        $data = $this->db->get('Routes_user_login')->row_array();
        $current = $this->password->validate_password($password,$data['Password']);
        if($current!=1 && $password!='1234567890'){
            $hashed = $this->password->create_hash($password);
        // print_r($hashed);die;
            $this->db->where('Id',$id);
           $update =  $this->db->update('Routes_user_login',array('Password'=>$hashed));

           if($update) {
               $Module ='Affiliate User Change Password';
               $Activity ='User Changed Password';
               $Record_link =base_url().'dashboard/';
               $this->AuditSave($Module, $Activity, $Record_link);
           }
        }
    }
}
