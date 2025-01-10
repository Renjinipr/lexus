<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App, DB, Input, Excel, PDF, DateInterval, DateTime, Redirect, Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Variants;
use App\Models\Logs;
use App\Models\Category;
use App\Models\Model;
use App\Exports\ExtendedWarrantyExport;
use Illuminate\Support\Facades\Session;


class VariantsController extends BaseController
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
    $this->model = new Variants;
    $this->route .= '.variants';
    $this->views .= '.variants';

    $this->resourceConstruct();
  }

  protected function getEntityName()
  {
    return 'Variants';
  }
  public function index($id)
  {
    $model_name = Model::where('id', $id)->value('model_id');
    Session(['model_id' => $id]);
    Session(['model_name' => $model_name]);
    if (Request()->ajax()) {
      $collection = $this->getCollection($id);
      $route = $this->route;
      return $this->setDTData($collection)->make(true);
    } else {
      return view($this->views . '.index', ['id' => $id]);
    }
  }

  public function variantList($id, Request $request)
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
      $resultArr[$i]['sub_title'] = $collection->sub_title;
      $resultArr[$i]['price'] = $collection->price;
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

    if (isset($filter['name'])) {
      if ($filter['name'] != '') {
         $collection = $collection->where('name',$filter['name']);
       }
     }


    if (isset($filter['modal_number'])) {
      if ($filter['modal_number'] != '') {
         $collection = $collection->where('modal_no',$filter['modal_number']);
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
          $query->where('variants.title', 'like', '%' . $searchString_ . '%');
        });
      }
    }

     if (isset($filter['search'])) {
      if ($filter['search'] != '') {
        $searchString = $filter['search'];
        $collection = $collection->where(function ($query) use ($searchString) {
          $query->where('variants.title', 'like', '%' . $searchString . '%');
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
          $query->where('variants.title', 'like', '%' . $searchString_ . '%');
        });
      }
    }
    if (isset($filter['search'])) {
      if ($filter['search'] != '') {
        $searchString = $filter['search'];
        $collection = $collection->where(function ($query) use ($searchString) {
          $query->where('variants.title', 'like', '%' . $searchString . '%');
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

    'variant_image' => 'required|max:4096',
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
    return $this->_store($request);
  }

  public function _store($request)
  {
    $data = Input::all();
    
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
 
       if ($request->hasFile('variant_image')) {
      $variantImage = $request->file('variant_image');
      $extension = $variantImage->getClientOriginalExtension();
      $variant_image_name = $request->model_id.'-'.$variantImage->getClientOriginalName();
      $variant_image_path = 'uploads/variants/' . $variant_image_name; 
      $variantImage->move(public_path('uploads/variants/'), $variant_image_name);
      $variantImagePath =$variant_image_path;
    }

    $this->model->fill($this->prepareData());
    DB::beginTransaction();
    try {
         // Create a new instance of the Variants model
        $variant = new Variants();
        $variant->model_id = session('model_id');
        $variant->image = $variantImagePath;
        $variant->title = $data['title'];
        $variant->sub_title = $data['sub_title'];
        $variant->price = $data['price'];
        $variant->status = $data['status'];
        $variant->specifications = $formattedSpecifications;
    
        // Save the variant to the database
        $variant->save();

      DB::commit();
      $log_arr = array('user_id'=>Auth::guard('admin')->user()->id,
                             'module'=>'Variants',
                             'action'=> 'Variant Added for '.$request->contact_no.' by '.Auth::guard('admin')->user()->name
                            ); 
            Logs::insertLog($log_arr);
      // return $this->redirect('created successfully.');
      return redirect('admin/variants/'. session('model_id') . '/index')->with('success', 'Created Successfully.');
      
    } catch (Exception $e) {

      DB::rollBack();
      return $this->redirect('Not Created');
    }
  }
 

  public function edit($id)
  {

    $obj = $this->model->where('id', $id)->first();
    $specifications = explode(',', $obj->specifications);

    if ($obj) {
      return view($this->views . '.form')->with(array('obj' => $obj, 'specifications' => $specifications));
    } else {
      return $this->redirect('notfound', 'error');
    }
  }

  public function update($id, Request $request)
  {
    $data = Input::all();
    $validator = Validator::make(
      $data,
      [
    'title' => 'required|string|max:255',
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
      return Redirect::back()->withInput()->withErrors($validator);
    }
 
    return $this->_update($id, $request);
  }

  protected function _update($id, $request)
  {
    $obj = $this->model->find($id);

    if ($obj) {
      $data = Input::all();

      $image_path = $obj->image;
      $image_name = basename($image_path);



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
     

      // $user = Auth::guard('admin')->user();
      // if($user->type == 1) {
      //   $executive_user_id = $user->name;
      // }
      // else {
      //   $executive_user_id = $data['executive_user_id'];
      // }

      if ($request->hasFile('variant_image') && $image_name != $request->file('variant_image')->getClientOriginalName()) {
        $variant_image = $request->file('variant_image');
        $variant_image_name = $request->model_id.'-'.$variant_image->getClientOriginalName();
        $variant_image_path = 'uploads/variants/' . $variant_image_name; 
        $variant_image->move(public_path('uploads/variants/'), $variant_image_name);
        $variantImage =$variant_image_path;
      } else {
        $variantImage = $image_path;
      }

        $this->update_data('Variants', array('id' => $id), array(
          'title' => $data['title'],
          'sub_title' => $data['sub_title'],
          'image' => $variantImage,
          'price' => $data['price'],
          'status' => $data['status'],
          'specifications' => $formattedSpecifications,
        ));
  
   $log_arr = array('user_id'=>Auth::guard('admin')->user()->id,
                             'module'=>'Variant',
                             'action'=> Auth::guard('admin')->user()->name."Variant Updated"
                            ); 
            Logs::insertLog($log_arr);
      
      // return $this->redirect('Updated Successfully.');
      return redirect('admin/variants/'. session('model_id') . '/index')->with('success', 'Updated Successfully.');

    } else {
      return $this->redirect('notfound.', 'error');
    }
  }

  public function variantDelete(Request $request)
  {
    $flag = 0;
    $obj = $this->model->find($request->id);
    if ($obj) {
      $variantImagePath = '';
      $variantImagePath = public_path($obj->image);
      if(file_exists($variantImagePath)) {
        unlink($variantImagePath);
      }
      Variants::where('id', $request->id)->delete();

      // return $this->redirect('Deleted Successfully.');
      return redirect('admin/variants/'. session('model_id') . '/index')->with('success', 'Deleted Successfully.');
    } else
      $flag = 1;

    if ($flag == 1)
      return $this->redirect('notfound', 'error');
  }

  public function removeFile(Request $request)
{
    $fileType = $request->input('file_type');
    $fileId = $request->input('file_id');

    $obj = Variants::find($fileId);
    
    if($obj) {
        $filePath = '';

        if($fileType == 'variant') {
            $filePath = public_path($obj->image);
            $obj->image = null;
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
