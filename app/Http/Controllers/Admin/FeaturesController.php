<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App, DB, Input, Excel, PDF, DateInterval, DateTime, Redirect, Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Features;
use App\Models\Logs;
use App\Models\Model;
use Illuminate\Support\Facades\Session;


class FeaturesController extends BaseController
{
  use ResourceTrait;
  /**         
   * Date : 24/09/2024
   * @package        Laravel 10
   * @author         Rahul
   * @copyright   Copyright (c) 2024, Seeroo IT Solutions (p) Ltd
   * @link       http://www.seeroo.com/
   **/

  public function __construct()
  {
    parent::__construct();
    $this->model = new Features;
    $this->route .= '.features';
    $this->views .= '.features';

    $this->resourceConstruct();
  }

  protected function getEntityName()
  {
    return 'Features';
  }
  public function index($id)
  {
    $model_name = Model::where('id', $id)->value('model_id');
    Session(['model_id' => $id]);
    Session(['model_name' => $model_name]);
    if (Request()->ajax()) {
      $collection = $this->getCollection();
      $route = $this->route;
      return $this->setDTData($collection)->make(true);
    } else {
      return view($this->views . '.index', ['id' => $id]);
    }
  }

  public function featureList($id, Request $request)
  {
    $inputs = $request->all();
    $filter = $request->filter;

    if (isset($inputs['page_number']) && $inputs['page_number'] != "" && $inputs['page_number'] != 0) {
      $currentPage = $inputs['page_number'];
    } else {
      $currentPage = 1;
    }

    $dataArr = $this->getCollection($id);
    $collections = $dataArr['collection'];
    $totalCount =  $dataArr['count'];
    $totalPages = $dataArr['total_pages'];
    $offset = $dataArr['offset'];

    $resultArr = array();
    $i = 0;
    foreach ($collections as $collection) {
      $resultArr[$i]['id'] = $collection->id;
      $model_name = Model::where('id', $collection->model_id)->value('model_id');
      $resultArr[$i]['model_name'] = $model_name;
      $resultArr[$i]['title'] = $collection->title;
      $resultArr[$i]['description'] = Str::limit($collection->description, 15, '...');
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

  protected function getCollection($id = null)
  {
    $data = Input::all();
    $filter = $data['filter'];
    DB::enableQueryLog();
    $user=Auth::guard('admin')->user();
    
    $collection = $this->model->select('*')->where('model_id', $id);


     if (isset($filter['search_executive_user_id'])) {
      if ($filter['search_executive_user_id'] != '') {
         $collection = $collection->where('executive_user_id',$filter['search_executive_user_id']);
       }
     }

    if (isset($filter['search_val'])) {
      if ($filter['search_val'] != '') {
        $searchString_ = $filter['search_val'];
        $collection = $collection->where(function ($query) use ($searchString_) {
          $query->where('features.title', 'like', '%' . $searchString_ . '%');
        });
      }
    }

     if (isset($filter['search'])) {
      if ($filter['search'] != '') {
        $searchString = $filter['search'];
        $collection = $collection->where(function ($query) use ($searchString) {
          $query->where('features.title', 'like', '%' . $searchString . '%');
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
            $perpage = 10;
        }

        $pages = ceil($count / $perpage);
        $pages = (int) $pages;
        $offset = (($currentPage - 1) * $perpage);
        DB::enableQueryLog();

        $collection = $this->model->select('*')->where('model_id', $id);

        if (isset($filter['name'])) {
            if ($filter['name'] != '') {
                $collection = $collection->where('name',$filter['name']);
            }
        }


    if (isset($filter['contact_number'])) {
      if ($filter['contact_number'] != '') {
         $collection = $collection->where('contact_no',$filter['contact_number']);
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
          $query->where('features.title', 'like', '%' . $searchString_ . '%');
        });
      }
    }
        if (isset($filter['search'])) {
      if ($filter['search'] != '') {
        $searchString = $filter['search'];
        $collection = $collection->where(function ($query) use ($searchString) {
          $query->where('features.title', 'like', '%' . $searchString . '%');
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

    'feature_image' => 'required|max:4096',
    'title' => 'required|string|max:255',
    'description' => 'required',
    'status'=>'required',
  ],
      [
        'feature_image.required' => 'Image field is required.',
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
    
    if ($request->hasFile('feature_image')) {
      $featureImage = $request->file('feature_image');
      $extension = $featureImage->getClientOriginalExtension();
      $feature_image_name = $request->model_id.'-'.$featureImage->getClientOriginalName();
      $feature_image_path = 'uploads/features/' . $feature_image_name; 
      $featureImage->move(public_path('uploads/features/'), $feature_image_name);
      $featureImagePath =$feature_image_path;
    }

    $this->model->fill($this->prepareData());
    DB::beginTransaction();
    try {
        $variant = new Features();
        $variant->model_id = session('model_id');
        $variant->image_url = $featureImagePath;
        $variant->title = $data['title'];
        $variant->description = $data['description'];
        $variant->status = $data['status'];  

        $variant->save();

      DB::commit();
      $log_arr = array('user_id'=>Auth::guard('admin')->user()->id,
                             'module'=>'Features',
                             'action'=> 'Feature Added for model ID='.$request->model_id.' by '.Auth::guard('admin')->user()->name
                            ); 
            Logs::insertLog($log_arr);
      // return $this->redirect('created successfully.');
      return redirect('admin/features/'. session('model_id') . '/index')->with('success', 'Created Successfully.');
      
    } catch (Exception $e) {

      DB::rollBack();
      return $this->redirect('Not Created');
      return redirect('admin/features/'. session('model_id') . '/index')->with('success', 'Not Created.');
    }
  }
 

  public function edit($id) {
    $obj = $this->model->where('id', $id)->first();

    if ($obj) {
      return view($this->views . '.form')->with(array('obj' => $obj));
    } else {
      return $this->redirect('notfound', 'error');
    }
  }

  public function update($id, Request $request)
  {
    $data = Input::all();

    $validator = Validator::make($data, [

      'title' => 'required|string|max:255',
      'description' => 'required',
      'status'=>'required',
    ],
        [
         
        ]);
  
        
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }
 
    return $this->_update($id, $request);
  }

  protected function _update($id, $request)
  {
    $obj = $this->model->find($id);

    $image_path = $obj->image_url;
    $image_name = basename($image_path);

    if ($obj) {
      $data = Input::all();

     

      // $user = Auth::guard('admin')->user();
      // if($user->type == 1) {
      //   $executive_user_id = $user->name;
      // }
      // else {
      //   $executive_user_id = $data['executive_user_id'];
      // }

      if ($request->hasFile('feature_image') && $image_name != $request->file('feature_image')->getClientOriginalName()) {
        $feature_image = $request->file('feature_image');
        $feature_image_name = $request->model_id.'-'.$feature_image->getClientOriginalName();
        $feature_image_path = 'uploads/features/' . $feature_image_name; 
        $feature_image->move(public_path('uploads/features/'), $feature_image_name);
        $featureImage =$feature_image_path;
      }
      else {
        $featureImage = $image_path;
      }
        $this->update_data('Features', array('id' => $id), array(
          'title' => $data['title'],
          'image_url' => $featureImage,
          'description' => $data['description'],
          'status' => $data['status'],
        ));
  
   $log_arr = array('user_id'=>Auth::guard('admin')->user()->id,
                             'module'=>'Features',
                             'action'=> Auth::guard('admin')->user()->name."Features Updated"
                            ); 
            Logs::insertLog($log_arr);
      
      // return $this->redirect('Updated Successfully.');
      return redirect('admin/features/'. session('model_id') . '/index')->with('success', 'Updated Successfully.');
    } else {
      return $this->redirect('notfound.', 'error');
    }
  }

  public function featureDelete(Request $request)
  {
    $flag = 0;
    $obj = $this->model->find($request->id);
    if ($obj) {
      $featureImagePath = '';
      $featureImagePath = public_path($obj->image_url);
      if(file_exists($featureImagePath)) {
        unlink($featureImagePath);
      }
      Features::where('id', $request->id)->delete();

      // return $this->redirect('Deleted Successfully.');
      return redirect('admin/features/'. session('model_id') . '/index')->with('success', 'Deleted Successfully.');
    } else
      $flag = 1;

    if ($flag == 1)
      return $this->redirect('notfound', 'error');
  }

  public function removeFile(Request $request)
{
    $fileType = $request->input('file_type');
    $fileId = $request->input('file_id');

    $obj = Features::find($fileId);
    
    if($obj) {
        $filePath = '';

        if($fileType == 'feature') {
            $filePath = public_path($obj->image_url);
            $obj->image_url = null;
        }
        if(file_exists($filePath)) {
            unlink($filePath);
        }

        $obj->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}


}
