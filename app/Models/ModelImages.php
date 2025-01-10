<?php namespace App\Models; 
use App\Models\BaseModel, App\Models\ValidationTrait;
use Auth;
use App\Models\UserDetails;

class ModelImages extends BaseModel {
    
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
    * new project demo
    * Model images Model
    
    *
    * @package        
    * @author         Rahul 
    * @copyright   Copyright (c) 2024, Seeroo IT Solutions (p) Ltd
    * @link       http://www.seeroo.com/

    */
  
  protected $table = 'model_images';
 
  protected $fillable = [
      'model_id','banner_image','created_at'
  ];

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
