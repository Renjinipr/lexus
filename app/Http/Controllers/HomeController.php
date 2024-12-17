<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Category; 
use Input,Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ExtendedWarranty;
use App\Models\Enquiry;
use App\Models\ServiceRequest;
use App\Models\Settings;
use App\Models\Model;
use App\Models\Gallery;
use App\Models\Features;
use App\Models\Variants;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelImages;
class HomeController extends Controller {

    
  public function index() {
    // $category = Category::where('status',1)->get()->toArray();
    // $homepage_content = Settings::all();
    // return View('index')->with(array('category' => $category, 'homecontent' => $homepage_content));
    $home_content = Settings::first();
    $models = Model::where('featured', 1)->get();   
    return view('index', compact('home_content', 'models'));
  } 

  public function detailPage($slug) {
    $models_id = Model::where('slug', $slug)->first();   
    $models = ModelImages::select('banner_image')->where('model_id',$models_id['id'])->first();   
    if ($models && $models->banner_image) {
    $bannerImagesArray = explode(',', $models->banner_image);
    } else {
    $bannerImagesArray = [];
    }
    $gallery = Gallery::where('model_id',$models_id['id'])->get();   
    $gallery_all = Gallery::where('model_id',$models_id['id'])->where('type',1)->get();   
    $gallery_in = Gallery::where('model_id',$models_id['id'])->where('type',3)->get();   
    $gallery_ex = Gallery::where('model_id',$models_id['id'])->where('type',2)->get();   
 
 
    $features = Features::where('model_id',$models_id['id'])->get();   
    $variants = Variants::where('model_id',$models_id['id'])->get();   

    $model = Model::where('slug', $slug)->first();
 
    return view('detail', compact('bannerImagesArray','gallery','features','variants','gallery_all','gallery_in','gallery_ex','model'));
 
 
  }

    public function enquiry(Request $request){
      $data=$request->all();
      $validator = Validator::make(
        $data,[
      'courtesy_title' => 'required',
      'name' => 'required|string|max:50',
      'phone' => 'required|max:13',
      'city' => 'required',
      'vehicle_model' => 'required',
      // 'job_title' => 'required',
      // 'company' => 'required',
  ], [
      'courtesy_title' => 'Please select courtesy title.',
      'name.required' => 'Please enter name.',
      'phone.required' => 'Please enter contact number.',
      'city.required' => 'Please enter city name',
      'vehicle_model.required' => 'Please enter vehicle model',
      // 'job_title.required' => 'Please enter job title',
      // 'company.required' => 'Please enter company name',
  ]);

  if ($validator->fails()) {
    return response()->json(['errors' => $validator->errors()]);
  }
  return $this->_enquiry($request);
}

public function _enquiry($request) {
    if($request->courtesy_title == "option1") {
      $courtesy_title = 1;
    } else if($request->courtesy_title == "option2") {
      $courtesy_title = 2;
    } else {
      $courtesy_title = 3;
    }
  
      $data = new Enquiry(); 
      $data['model_id'] = $request->model_id;
      $data['courtesy_title'] = $courtesy_title;
      $data['name'] = ucwords(strtolower($request->name));
      $data['contact_no'] = $request->phone;
      $data['city'] = $request->city;
      $data['model_name'] = $request->vehicle_model;
      // $data['job_title'] = $request->job_title;
      // $data['company'] = $request->company;
      $data['status'] = 1;
      $data['message'] = $request->message;

      $data->save();
      
      return response()->json(['success' => 'You have submitted your enquiry successfully!']);
  }
}


