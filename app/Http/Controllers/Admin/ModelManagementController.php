<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App, DB, Input, Excel, PDF, DateInterval, DateTime, Redirect, Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Logs;
use App\Models\Model;
use App\Models\ModelImages;
use App\Models\Variants;
use App\Models\Gallery;
use Illuminate\Support\Facades\Session;


class ModelManagementController extends BaseController
{
  use ResourceTrait;
  /**         
   * Date : 08/10/2024
   * @package        Laravel 10
   * @author         Rahul
   * @copyright   Copyright (c) 2024, Seeroo IT Solutions (p) Ltd
   * @link       http://www.seeroo.com/
   **/

  public function __construct()
  {
    parent::__construct();
    $this->model = new Model;
    $this->route .= '.model_management';
    $this->views .= '.model_management';

    $this->resourceConstruct();
  }

  protected function getEntityName()
  {
    return 'Model Management';
  }
  public function index()
  {
    if (Request()->ajax()) {
      $collection = $this->getCollection();
      $route = $this->route;
      return $this->setDTData($collection)->make(true);
    } else {
      return view($this->views . '.index');
    }
  }

    public function modelIdList(Request $request) {
        $inputs = $request->all();
        $filter = $request->filter;

        if(isset($inputs['page_number']) && $inputs['page_number'] != "" && $inputs['page_number'] != 0) {
            $currentPage = $inputs['page_number'];
        } else {
          $currentPage = 1;
        }

        $dataArr = $this->getCollection();
        $collections = $dataArr['collection'];
        $totalCount =  $dataArr['count'];
        $totalPages = $dataArr['total_pages'];
        $offset = $dataArr['offset'];

        $resultArr = array();
        $i = 0;
        foreach ($collections as $collection) {
        $resultArr[$i]['id'] = $collection->id;
        $resultArr[$i]['model_no'] = $collection->model_id;
        $resultArr[$i]['created_on'] = Carbon::parse($collection->created_at)->format('d F Y');


        $i++;
        }
        $data['status'] = true;
        $data['result'] = $resultArr;
        $data['count'] = $i;
        $data['total_count'] = $totalCount;
        $data['current_page'] = $currentPage;
        $data['total_pages'] = $totalPages;
        $data['offset'] = $offset;
        $data['user_type'] = Auth::guard('admin')->user()->type;
        return response()->json($data, 200);
    }
    protected function getCollection()
  {
    $data = Input::all();
    $filter = $data['filter'];
    DB::enableQueryLog();
    $user=Auth::guard('admin')->user();
    
    $collection = $this->model->select('*');

    if (isset($filter['name'])) {
      if ($filter['name'] != '') {
         $collection = $collection->where('name',$filter['name']);
       }
     }

     if (isset($filter['search_executive_user_id'])) {
      if ($filter['search_executive_user_id'] != '') {
         $collection = $collection->where('executive_user_id',$filter['search_executive_user_id']);
       }
     }

    if (isset($filter['search_val'])) {
      if ($filter['search_val'] != '') {
        $searchString_ = $filter['search_val'];
        $collection = $collection->where(function ($query) use ($searchString_) {
          $query->where('model.model_id', 'like', '%' . $searchString_ . '%')
          ->orWhere('model.id', 'like', '%' . $searchString_ . '%');
        });
      }
    }

     if (isset($filter['search'])) {
      if ($filter['search'] != '') {
        $searchString = $filter['search'];
        $collection = $collection->where(function ($query) use ($searchString) {
          $query->where('model.model_id', 'like', '%' . $searchString . '%')
          ->orWhere('model.id', 'like', '%' . $searchString . '%');
        });
      }
    }

    if (isset($filter['from_date']) && isset($filter['to_date'])) {
      $filter['from_date'] = \Carbon\Carbon::parse($filter['from_date'])->format('Y-m-d');
      $filter['to_date'] = \Carbon\Carbon::parse($filter['to_date'])->format('Y-m-d');
      if($filter['from_date']== $filter['to_date']){
        $collection = $collection->where('created_at',  'like', '%' . $filter['from_date'] . '%');
      }else{
        $collection = $collection->whereBetween('created_at', [$filter['from_date'], $filter['to_date']]);
      }
  } elseif (isset($filter['from_date'])) {
      $filter['from_date'] = \Carbon\Carbon::parse($filter['from_date'])->format('Y-m-d');
      $collection = $collection->where('created_at',  'like', '%' . $filter['from_date'] . '%');
  } elseif (isset($filter['to_date'])) {
      $filter['to_date'] = \Carbon\Carbon::parse($filter['to_date'])->format('Y-m-d');
      $collection = $collection->where('created_at', 'like', '%' . $filter['to_date'] . '%');
  }
  

    $count = $collection->count();


    if ($count > 0) {
        if (isset($data['page_number']) && $data['page_number'] != "" && $data['page_number'] != 0) {
            $currentPage = $data['page_number'];
        } else {
            $currentPage = 1;
        }

        if (isset($filter['per_page_count'])) {
            $perpage = $filter['per_page_count'];
        } else {
            $perpage = 50;
        }

        $pages = ceil($count / $perpage);
        $pages = (int) $pages;
        $offset = (($currentPage - 1) * $perpage);
        DB::enableQueryLog();

        $collection = $this->model->select('*');


    if (isset($filter['complaint_id'])) {
      if ($filter['complaint_id'] != '') {
         $collection = $collection->where('complaint',$filter['complaint_id']);
       }
     }

     if (isset($filter['search_executive_user_id'])) {
      if ($filter['search_executive_user_id'] != '') {
         $collection = $collection->where('executive_user_id',$filter['search_executive_user_id']);
       }
     }
 
    if (isset($filter['search_val'])) {
      if ($filter['search_val'] != '') {
        $searchString_ = $filter['search_val'];
        $collection = $collection->where(function ($query) use ($searchString_) {
          $query->where('model.model_id', 'like', '%' . $searchString_ . '%')
          ->orWhere('model.id', 'like', '%' . $searchString_ . '%');

        });
      }
    }
        if (isset($filter['search'])) {
      if ($filter['search'] != '') {
        $searchString = $filter['search'];
        $collection = $collection->where(function ($query) use ($searchString) {
          $query->where('model.model_id', 'like', '%' . $searchString . '%')
          ->orWhere('model.id', 'like', '%' . $searchString . '%');

        });
      }
    }


    if (isset($filter['from_date']) && isset($filter['to_date'])) {
      $filter['from_date'] = \Carbon\Carbon::parse($filter['from_date'])->format('Y-m-d');
      $filter['to_date'] = \Carbon\Carbon::parse($filter['to_date'])->format('Y-m-d');
      if($filter['from_date']== $filter['to_date']){
        $collection = $collection->where('created_at',  'like', '%' . $filter['from_date'] . '%');
      }else{
        $collection = $collection->whereBetween('created_at', [$filter['from_date'], $filter['to_date']]);
      }
    } elseif (isset($filter['from_date'])) {
      $filter['from_date'] = \Carbon\Carbon::parse($filter['from_date'])->format('Y-m-d');
      $collection = $collection->where('created_at',  'like', '%' . $filter['from_date'] . '%');
    } elseif (isset($filter['to_date'])) {
        $filter['to_date'] = \Carbon\Carbon::parse($filter['to_date'])->format('Y-m-d');
        $collection = $collection->where('created_at', 'like', '%' . $filter['to_date'] . '%');
    }
  
  

      $collection = $collection->orderby('id', 'DESC')
        ->skip($offset)
        ->take($perpage)
        ->get();
    } else {
      $pages = 0;
      $offset = 0;
    }
    $dataArr['collection'] = $collection;
    $dataArr['count'] = $count;
    $dataArr['offset'] = $offset;
    $dataArr['total_pages'] = $pages;
    return $dataArr;
  }



  

  protected function setDTData($collection, $qs_array = [])
  {
    $route = $this->route;
    $filter = Input::get('filter');
    return $this->initDTData($collection)

      ->editColumn('created_at', function ($obj) {
        return $obj->created_at ? $obj->created_at->format('d/m/Y h:i a') : 'Unknown';
      })
      ->editColumn('status', '@if($status) Active @else Inactive @endif');
  }

  protected function prepareData($update = NULL)
  {
    $data = Input::all();
    return $data;
  }

  public function store(Request $request)
  {
    $data = Input::all();
    $validator = Validator::make(
      $data,
      [

    'model_id' => 'required|unique:model|string|max:255',
    'description' => 'required',
    'banner_text' => 'required',
    'price' => 'required',
    'banner_image' => 'required|image',
    'brochure' => 'required',
    'status' => 'required',
    // 'specification' => 'required'
      ],
      [
   
      ]
    );

    if ($validator->fails()) {
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    return $this->_store($request);
  }

  public function _store($request)
  {
    $data = Input::all();
    if ($request->hasFile('brochure')) {
      $brochure = $request->file('brochure');
      $extension = $brochure->getClientOriginalExtension();
      $brochure_name = $request->model_id.'-'.$brochure->getClientOriginalName();
      $brochure_path = 'uploads/brochure/' . $brochure_name; 
      $brochure->move(public_path('uploads/brochure/'), $brochure_name);
      $brochurePath =$brochure_path;
    }
    if ($request->hasFile('banner_image')) {
      $banner_image = $request->file('banner_image');
      $extension = $banner_image->getClientOriginalExtension();
      $banner_image_name = $request->model_id.'-'.$banner_image->getClientOriginalName();
      $banner_image_path = 'uploads/banner_image/' . $banner_image_name;
      $banner_image->move(public_path('uploads/banner_image/'), $banner_image_name);
      $bannerImagePath =$banner_image_path;
    }
    $specification = implode(' | ', $request->specification);
    if(isset($request->featured)) {
      $featured = 1;
    } else {
      $featured = 0;
    }
    
    $this->model->fill($this->prepareData());
    DB::beginTransaction();
    try {
        $save_data = new Model(); 
        $save_data['model_id'] = ucwords(strtoupper($request->model_id));
        $save_data['slug'] =  Str::slug($request->model_id);
        $save_data['description'] = $request->description;
        $save_data['status'] = $request->status;
        $save_data['banner_text'] = $request->banner_text;
        $save_data['price'] = $request->price;
        $save_data['featured'] = $featured;
        $save_data['specification'] = $specification;
        $save_data['brochure'] = $brochurePath;
        $save_data['banner_image'] = $bannerImagePath;
        if(isset($request->status)) {
            $save_data['status'] = $request->status;
        }
        $save_data->save();

      DB::commit();
      $log_arr = array('user_id'=>Auth::guard('admin')->user()->id,
                             'module'=>'Model Management',
                             'action'=> 'Model Added Successfully'
                            ); 
            Logs::insertLog($log_arr);
      return $this->redirect('created successfully.');
      
    } catch (Exception $e) {

      DB::rollBack();
      return $this->redirect('Not Created');
    }
  }
 

  public function edit($id)
  {

    $obj = $this->model->where('id', $id)->first();
    $specifications = explode(' | ', $obj->specification);

    if ($obj) {
      return view($this->views . '.form')->with(array('obj' => $obj, 'specifications' => $specifications));
    } else {
      return $this->redirect('notfound', 'error');
    }
  }

  public function storeCarImages(Request $request) {
    $rules = [
      'galleryImage' => 'required|max:4096',
      'gallery_type' => 'required'
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withinput();
    } else {
      $timestamp = now()->format('YmdHis');

      foreach($request->file('bannerImage') as $image) {
        $extension = $image->getClientOriginalExtension();
        $filename = $timestamp . '_' . Str::random(10) . '_bannerImage.' . $extension;
        $image->move(public_path('uploads/model_images'), $filename);
        $filenames['bannerImage'][] = $filename;
      }
    }
    $model_id = $request->model_id;
    $is_exist = ModelImages::where('model_id', $model_id)->first();
    
    $modelImages = new ModelImages();
    $modelImages->model_id = $model_id;
    $modelImages->banner_image = implode(', ', $filenames['bannerImage']);
    if($request->file('galleryImage')) {
      foreach($request->file('galleryImage') as $image) {
        $extension = $image->getClientOriginalExtension();
        $filename = $timestamp . '_' . Str::random(10) . '_galleryImage.' . $extension;
        $image->move(public_path('uploads/model_images'), $filename);
        $filenames['galleryImage'][] = $filename;
        $galleryImage = new Gallery;
        $galleryImage->model_id = $model_id;
        $galleryImage->image_url = $filename;
        $galleryImage->type = $request->gallery_type;
        $galleryImage->status = 1;
        $galleryImage->save();
      }
      // $modelImages->gallery_image = implode(', ', $filenames['galleryImage']);
    }
    if($request->file('featureImage')) {
      foreach($request->file('featureImage') as $image) {
        $extension = $image->getClientOriginalExtension();
        $filename = $timestamp . '_' . Str::random(10) . '_featureImage.' . $extension;
        $image->move(public_path('uploads/model_images'), $filename);
        $filenames['featureImage'][] = $filename;
      }
      $modelImages->feature_image = implode(', ', $filenames['featureImage']);
    }

    if($is_exist) {
      $modelImages->update();
    } else {
      $modelImages->save();
    }

    return redirect()->back()->with('success', 'Data uploaded successfully');
  }

public function delete(Request $request)
{
    $filename = public_path('uploads') . '/' . $request->name;

    if (file_exists($filename)) {
        unlink($filename);
    }

    return response()->json(['success' => true]);
}


  public function upload($id)
  {
    return view($this->views . '.upload')->with(array('id' => $id));
  }

  public function update($id, Request $request)
  {
    $data = Input::all();

    $validator = Validator::make(Input::all(), [
      'model_id' => 'required|string|max:50',
      'description' => 'required',
      'status' => 'required',
  ], [
      'model_id.required' => 'Model ID field is required.',
      'status.required' => 'Please select status',
  ]);
  
        
    if ($validator->fails()) {
      $current_url = url('model_management', ['model_management' => $id], 'edit');
      return Redirect::back()->withInput()->withErrors($validator);
    }
 
    return $this->_update($id, $request);
  }

  protected function _update($id, $request)
  {
    $obj = $this->model->find($id);

    if ($obj) {
      $data = Input::all();
      if ($request->hasFile('brochure')) {
        $brochure = $request->file('brochure');
        $extension = $brochure->getClientOriginalExtension();
        $brochure_name = $request->model_id.'-'.$brochure->getClientOriginalName();
        $brochure_path = 'uploads/brochure/' . $brochure_name; 
        $brochure->move(public_path('uploads/brochure/'), $brochure_name);
        $brochurePath =$brochure_path;
      }
      $specification = implode(' | ', $request->specification);

      $user = Auth::guard('admin')->user();

      if ($request->hasFile('brochure')) {
        $this->update_data('Model', array('id' => $id), array(
            'model_id' => $data['model_id'],
            'description' => $data['description'],
            'status' => $data['status'],
            'specification' => $specification,
            'brochure' => $brochurePath
        ));
      } else {
        $this->update_data('Model', array('id' => $id), array(
          'model_id' => $data['model_id'],
          'description' => $data['description'],
          'status' => $data['status'],
          'specification' => $specification,
      ));
      }
  
   $log_arr = array('user_id'=>Auth::guard('admin')->user()->id,
                             'module'=>'Model Management',
                             'action'=> Auth::guard('admin')->user()->name."Model Updated"
                            ); 
            Logs::insertLog($log_arr);
      
      return $this->redirect('Updated Successfully.');
    } else {
      return $this->redirect('notfound.', 'error');
    }
  }

  public function serviceRequestDelete(Request $request)
  {

    $flag = 0;
    $obj = $this->model->find($request->id);
    if ($obj) {

      ServiceRequest::where('id', $request->id)->delete();

      return $this->redirect('Deleted Successfully.');
    } else
      $flag = 1;

    if ($flag == 1)
      return $this->redirect('notfound', 'error');
  }

  public function variants($id)
  {
    return view($this->views . '.variants')->with(array('id' => $id));
  }
 
  public function variantsStore(Request $request) {
    $data = Input::all();
    $validator = Validator::make(
    $data,
    [
 
    'banner' => 'required|max:4096',
    'title' => 'required|unique:variants|string|max:255',
    'sub_title' => 'required',
    'price' => 'required',
    'status'=>'required',
    'specification.*' => 'required|max:150', 
    'specific_value.*' => 'required|max:150', 
    ],
    [
    ]
    );
 
 
    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator->errors());
    }
        // Process specifications if provided
    if ($request->has('specification') && $request->has('specific_value')) {
        $specification = $request->input('specification');
        $specific_value = $request->input('specific_value');
 
        $combined = [];
        foreach ($specification as $index => $spec) {
            $value = $specific_value[$index] ?? '';
            $combined[] = $spec . '|' . $value;
        }
 
        $formattedSpecifications = implode(',', $combined);
    } else {
        $formattedSpecifications = "";
    }
 
       if ($request->hasFile('banner')) {
      $brochure = $request->file('banner');
      $extension = $brochure->getClientOriginalExtension();
      $brochure_name = $request->model_id.'-'.$brochure->getClientOriginalName();
      $brochure_path = 'uploads/variants/' . $brochure_name; 
      $brochure->move(public_path('uploads/variants/'), $brochure_name);
      $brochurePath =$brochure_path;
    }
 
    // Create a new instance of the Variants model
    $variant = new Variants();
    $variant->model_id = $data['model_id'];
    $variant->image = $brochurePath;
    $variant->title = $data['title'];
    $variant->sub_title = $data['sub_title'];
    $variant->price = $data['price'];
    $variant->status = $data['status'];
    $variant->specifications = $formattedSpecifications;
 
    // Save the variant to the database
    $variant->save();
 
 
return redirect()->to('admin/model_management')->with('success', 'Data uploaded successfully');
  }
}
