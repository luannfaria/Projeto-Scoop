<?php
class LazymenuController extends CController
{
	public $layout='_store';	
	public $code=2;
	public $msg;
	public $details;
	public $data;
		
	public function __construct()
	{	
		Yii::app()->setImport(array(			
		  'application.components.*',
		));		
		require_once 'Functions.php';
		
		$this->data=$_POST;			
	}
	
	public function init()
	{		
		$website_timezone=Yii::app()->functions->getOptionAdmin("website_timezone");		 
		if (!empty($website_timezone)){		 	
		 	Yii::app()->timeZone=$website_timezone;
		}		 				 		
	}
	
	public function beforeAction($action)
	{		
		FunctionsV3::handleLanguage();
		Price_Formatter::init( Yii::app()->session['currency']  );		
		Item_menu::$language = Yii::app()->language; 
        Item_menu::$currency_code = Yii::app()->session['currency'];
		
		return true;
	}
	
	private function jsonResponse()
	{
		$resp=array('code'=>$this->code,'msg'=>$this->msg,'details'=>$this->details);
		echo CJSON::encode($resp);
		Yii::app()->end();
	}
	
	public function actionIndex()
	{
		$this->data=$_GET; $page_limit = Item_utility::paginate(); $data= array();	
		if (isset($this->data['page'])){
        	$page = ($this->data['page']-1) * $page_limit;
        } else  $page = 0;  
        
        $merchant_id = isset($this->data['merchant_id'])?(integer)$this->data['merchant_id']:0;
        
        $today = strtolower(date("l")); $time_now = date("H:i");       
		if(isset($this->data['delivery_date'])){
			if(!empty($this->data['delivery_date'])){
			   $today = date("l",strtotime($this->data['delivery_date']));				
			}
		}
		if(isset($this->data['delivery_time'])){
			if(!empty($this->data['delivery_time'])){
			  $time_now = date("H:i",strtotime($this->data['delivery_time']));				
			}
		}
				
		
        Item_menu::init( $merchant_id );     
        Item_menu::$todays_day = strtolower($today);
        Item_menu::$time_now = $time_now;
        
        		        
		if($res = Item_menu::getItemLazyLoadAll($merchant_id, $page , $page_limit) ){
			$this->code = 1; $this->msg = "OK";
			$this->details = array(			  
			  'data'=>$res
			);	
		} else $this->msg = "end of data";
		
		
		$this->jsonResponse();
	}
	
	public function actionItem()
	{
		$this->data=$_GET; $page_limit = Item_utility::paginate();
		$merchant_id = isset($this->data['merchant_id'])?(integer)$this->data['merchant_id']:'';
		$cat_id = isset($this->data['cat_id'])?(integer)$this->data['cat_id']:'';
		
		if (isset($this->data['page'])){
        	$page = ($this->data['page']-1) * $page_limit;
        } else  $page = 0;  
		        
                
        Item_menu::init( $merchant_id );          
        
		if($res = Item_menu::getItemLazyLoad($cat_id , $merchant_id, $page , $page_limit) ){			
			$this->code = 1; $this->msg = "OK";
			$this->details = array(			  
			  'data'=>$res
			);	
		} else {						
			if ($res = Item_menu::getCategoryByID($merchant_id, $cat_id)){
				$this->details = array(
				  'data'=> $res
				);
				$this->msg = t("no item found on this category");
			} else $this->msg = t("This restaurant has not published their menu yet.");
		}		
			
		$this->jsonResponse();
	}	

	public function actionsearchItem()
	{						
		$this->data=$_GET; $page_limit = Item_utility::paginate();
		$merchant_id = isset($this->data['merchant_id'])?(integer)$this->data['merchant_id']:'';
		$search_string = isset($this->data['search_string'])?trim($this->data['search_string']):'';		
		
		Item_menu::init( $merchant_id ); 
		Item_menu::$time_now = date("H:i");
        Item_menu::$todays_day = strtolower(date("l"));
					
		if($res = Item_menu::searchByItem($search_string,$merchant_id,0,100)){			
			$this->code = 1; $this->msg = "OK";
			$this->details = array(				  
			  'data'=>$res
			);	
		} else {
			$this->msg = Yii::t("default","Sorry, we couldn't find any results matching [string]",array(
			 '[string]'=>"<b>$search_string</b>"
			));
		}		
		$this->jsonResponse();
	}
		
}
/*END CLASS*/