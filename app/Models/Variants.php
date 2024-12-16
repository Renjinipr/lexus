<?php namespace App\Models; 
use App\Models\BaseModel, App\Models\ValidationTrait;
use Auth;

class Variants extends BaseModel {
    
    use ValidationTrait; 

    public function __construct() {
        parent::__construct();
        
        $this->__validationConstruct();
    }
  /**
   * The database table used by the model.
   *
   * @var string
   */
      /**
    
    *
    * @package        
    * @author         Annie 
    * @copyright   Copyright (c) 2024, Seeroo IT Solutions (p) Ltd
    * @link       http://www.seeroo.com/

    */
  
  protected $table = 'variants';
 
  protected $fillable = array('id','model_id','title','sub_title','price','image','specifications','status','created_at','updated_at');

  public $uploadPath = array('thumbnails' => ''); 

  protected function setRules() {
        $this->val_rules = array( 
         
        );
  }

  protected function setAttributes() {
        $this->val_attributes = array(
           
        );
  }


  public function setMessages() {
        $this->val_errors = [

        ];
  }

 


    
}
