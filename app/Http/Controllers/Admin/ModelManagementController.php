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
use App\Models\Features;

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
    'short_name'=>'required',
    'description' => 'required',
    'banner_text' => 'required',
    'price' => 'required',
    'banner_image' => 'required|image',
    'brochure' => 'required',
    'status' => 'required',
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
        $save_data['short_name'] =  Str::slug($request->short_name);
        $save_data['description'] = $request->description;
        $save_data['status'] = $request->status;
        $save_data['banner_text'] = $request->banner_text;
        $save_data['price'] = $request->price;
        $save_data['featured'] = $featured;
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

    if ($obj) {
      return view($this->views . '.form')->with(array('obj' => $obj));
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
    } 
    else 
    {
      $timestamp = now()->format('YmdHis');
      $model_id = $request->model_id;
      if($request->file('bannerImage')) {
        foreach($request->file('bannerImage') as $image) {
          $image_name_ = $image->getClientOriginalName();
          $filename = $timestamp . '_' . Str::random(5) . '_banner_' . $image_name_;
          $filepath = 'uploads/model_images/' . $filename;
          $image->move(public_path('uploads/model_images'), $filename);
          $modelImages = new ModelImages;
          $modelImages->model_id = $model_id;
          $modelImages->banner_image = $filepath;
          $modelImages->save();
        } 
      }
    
      if($request->file('galleryImage')) {
        foreach($request->file('galleryImage') as $image) {
          $image_name = $image->getClientOriginalName();
          $filename = $timestamp . '_' . Str::random(5) . '_gallery_' . $image_name;
          $filepath = 'uploads/gallery/' . $filename;
          $image->move(public_path('uploads/gallery'), $filename);
          $filenames['galleryImage'][] = $filename;
          $galleryImage = new Gallery;
          $galleryImage->model_id = $model_id;
          $galleryImage->image_url = $filepath;
          $galleryImage->type = $request->gallery_type;
          $galleryImage->status = 1;
          $galleryImage->save();
        }
      }
      return redirect()->back()->with('success', 'Data uploaded successfully');
    }
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
    $galleryImages = Gallery::where('model_id', $id)->get(['id','image_url']);
    $bannerImages = ModelImages::where('model_id', $id)->get(['id','banner_image']);
    return view($this->views . '.upload')->with(array('id' => $id, 'gallery' => $galleryImages, 'banner_images' => $bannerImages));
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
      if ($request->hasFile('banner')) {
        $banner = $request->file('banner');
        $banner_name = $request->model_id.'-'.$banner->getClientOriginalName();
        $banner_path = 'uploads/banner_image/' . $banner_name; 
        $banner->move(public_path('uploads/banner_image/'), $banner_name);
        $bannerPath =$banner_path;
      }

      if ($request->hasFile('brochure')) {
        $brochure = $request->file('brochure');
        $brochure_name = $request->model_id.'-'.$brochure->getClientOriginalName();
        $brochure_path = 'uploads/brochure/' . $brochure_name; 
        $brochure->move(public_path('uploads/brochure/'), $brochure_name);
        $brochurePath =$brochure_path;
      }

      if(!$obj->banner_image) {
        if($request->hasFile('banner')) {
          $banner_image = $bannerPath;
        } else {
          $banner_image = NULL;
        }
      } else {
          $banner_image = $obj->banner_image;
      }

      if(!$obj->brochure) {
        if($request->hasFile('brochure')) {
          $brochureName = $brochurePath;
        } else {
          $brochureName = NULL;
        }
      } else {
          $brochureName = $obj->brochure;
      }

      if($request->featured == 'on') {
        $featured = 1;
      } else {
        $featured = 0;
      }

      $user = Auth::guard('admin')->user();

        $this->update_data('Model', array('id' => $id), array(
            'model_id' => $data['model_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            'featured' => $featured,
            'status' => $data['status'],
            'brochure' => $brochureName,
            'banner_image' => $banner_image
        ));
      
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

  public function variants($id)
  {
    return view($this->views . '.variants')->with(array('id' => $id));
  }
 
  public function features($id)
  {
    return view($this->views . '.features')->with(array('id' => $id));
  }
    
  public function removeFile(Request $request)
  {
    $fileType = $request->input('file_type');
    $fileId = $request->input('file_id');
    $obj = Model::find($fileId);
    
    if($obj) {
        $filePath = '';

        if($fileType == 'banner') {
            $filePath = public_path($obj->banner_image);
            $obj->banner_image = null;
        } elseif($fileType == 'brochure') {
            $filePath = public_path($obj->brochure);
            $obj->brochure = null;
        }

        if(file_exists($filePath)) {
            unlink($filePath);
        }

        $obj->save();

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
  }
  public function removeGalleryImage(Request $request)
  {
    $fileType = $request->input('file_type');
    $fileId = $request->input('file_id');
    if($fileType == 'gallery') {
      $obj = Gallery::find($fileId);
    }
    else if($fileType == 'banner') {
      $obj = ModelImages::find($fileId);
    }
    
    if($obj) {
        $filePath = '';

        if($fileType == 'gallery') {
            $filePath = public_path($obj->image_url);
            if(file_exists($filePath)) {
              unlink($filePath);
            }
            $obj->delete();
        }
        else if($fileType == 'banner') {
          $filePath = public_path($obj->banner_image);
            if(file_exists($filePath)) {
              unlink($filePath);
            }
            $obj->delete();
        }

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
  }
}
