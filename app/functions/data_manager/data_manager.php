<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

require_once dirname(__FILE__).'/constants.php';

class simplelender_raw_data{
	public function init(){
        $this->load_hooks();
    }

    public function load_hooks(){
        add_shortcode('simplelender_raw_data_display',array($this,"display_form_data"));	
       
    }
	
//-----------------------------------gravity to mylender parser -------------------------------------------------------------------------------

    public function gf_to_simplelender_parser($param){
        //address key table
        $this->create_raw_data_key_if_absent($param['entry']['fields']);

        //address value table
        $this->create_raw_data_value($param);
        
        return true;
    }

    public function create_raw_data_key_if_absent($param){ // form from table
        
        foreach ($param as $key => $value) {
            
            //key table id key_name table_id
            //values table id key_id value
            $key_count = mvc_model("simplelenderDatKey")->count(["conditions"=>[
                'form_id'=>$value->formId,
                'key_id'=> $value->id
            ]]);
            
            if($key_count == 0){//key does not exist
                //create key and return key id
                $key_id = mvc_model("simplelenderDatKey")->create([
                    "name"=>$value->label,
                    "key_id"=>$value->id,
                    "form_id"=>$value->formId
                ]);
            }
        }
    }
	
    public function create_raw_data_value($param){

        //get table keys
        $key_list = mvc_model("simplelenderDatKey")->find(["conditions"=>[
                'form_id'=> $param["form"]["form_id"]
            ]]);
        //insert values each under a key
        if(count($key_list)>0){
            foreach ($key_list as $key_value) {
                //create value and associate it with parent key
                if (isset($param['form'][$key_value->key_id])) {
                    
               $val_key= mvc_model("simplelenderDatValue")->create([
                        "form_id"=>$param["form"]["form_id"],
                        "key_id" => $key_value->key_id,
                        "object_type"=> $param["object_type"],
                        "object_id"=> $param['object_id'],
                        "data_value" => $param['form'][$key_value->key_id]
                    ]);
                }
            }
        }
		
    }
	
	//save primary form more data as raw data
	public static function create_primary_form_raw_data_value($param=[]){
		$param_e = $param['entry'];

		//create raw key if absent
		foreach ($param_e as $key => $value){
            //key table id key_name table_id
            //values table id key_id value
            $key_count = mvc_model("simplelenderDatKey")->count(["conditions"=>[
                'form_id'=>"p1",
                'key_id'=> $key
            ]]);
            
            if($key_count == 0){//key does not exist
                //create key and return key id
                $key_id = mvc_model("simplelenderDatKey")->create([
                    "name"=>$key,
                    "key_id"=>$key,
                    "form_id"=>"p1"
                ]);
            }
        }

        //get table keys
        $key_list = mvc_model("simplelenderDatKey")->find(["conditions"=>[
                'form_id'=> "p1"
            ]]);
			
        //insert values each under a key
        if(count($key_list)>0){
            foreach ($key_list as $key_value) {
                //create value and associate it with parent key
                if (isset($param_e[$key_value->key_id])) {
                    $val_key= mvc_model("simplelenderDatValue")->create([
                        "form_id"=>"p1",
                        "key_id" => $key_value->key_id,
                        "object_type"=> $param["object_type"],
                        "object_id"=> $param['object_id'],
                        "data_value" => $param_e[$key_value->key_id]
                    ]);
                }
            }
        }
    }
	
	//Display data on admin side
	public function display_form_data($param){
		$html_data='<table>';

		$simplelenderDatValue = mvc_model('simplelenderDatValue')->find(array('conditions'=>array(
			'object_type'=>$param['object_type'],
			'object_id'=>$param['object_id']
		)));

		foreach($simplelenderDatValue as $keyvalue){
			$html_data.='<tr class="simplelender_title_feild" ><td><b>'.mvc_model('simplelenderDatKey')->find_one(array('conditions'=>array('form_id'=>$keyvalue->form_id,'key_id'=>$keyvalue->key_id)))->name.'</b></td><td>'.$keyvalue->data_value.'</td></tr>';
		}

		$html_data.='</table>';

		return $html_data;
	}


}