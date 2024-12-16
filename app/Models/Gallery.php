<?php namespace App\Models; 
use App\Models\BaseModel, App\Models\ValidationTrait;
use Auth;
use App\Models\UserDetails;

class Gallery extends BaseModel {
    
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
    * ibell warranty
    * ModelNumber Model
    
    *
    * @package        
    * @author         Annie 
    * @copyright   Copyright (c) 2024, Seeroo IT Solutions (p) Ltd
    * @link       http://www.seeroo.com/

    */
  
  protected $table = 'gallery';
 
  protected $fillable = array('id','model_id','image_url','type','status','created_at','updated_at');

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
