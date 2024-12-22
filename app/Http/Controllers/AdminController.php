<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth, Redirect, DB, Session, Excel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use View, App, Input, DateTime;
use Carbon\Carbon;

/**
 * Admin Controller
 * Responsible for all admin functionalities
 */
class AdminController extends Controller
{

    private $reportRepository;

  /**
   * Render login page and authorize admin user
   *
   * @return \Illuminate\Http\Response
   */
  public function admin()
  {
    return redirect('/admin/login');
  }
  public function login(Request $request)
  {

    $data = [];
    if ($request->isMethod('post')) {
      $inputData = $request->all();
      $data['email'] = $inputData['email'];
      $validator = Validator::make($inputData, [
        'email' => 'required|email|',
        'password' => 'required',
      ]);
      if (!$validator->fails()) {
        $authData = [
          'email' => $inputData['email'],
          'password' => $inputData['password']
        ];
        if (Auth::guard('admin')->attempt($authData)) {

          if (Auth::guard('admin')->user()->deleted_at != NULL) {
            Auth::guard('admin')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            $data['error'] = 'Please activate your account';
          } else {

                return redirect()->intended('/admin/enquiries');
        
          }
        } else {
          $data['error'] = 'Please enter a valid email address and password';
        }
      } else {
        $data['error'] = 'Please enter a valid email address and password';
      }
    }

    return View::make('Admin.login.login', $data);
  }

  public function logout(Request $request)
  {
    Auth::guard('admin')->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect()->route('admin-login');
  }

  /**
   * Render admin dashboard
   *
   * @return \Illuminate\Http\Response
   */
  public function dashboard()
  {
    $data = [
        'menu' => 'dashboard',
        'submenu' => '',
    ];

    return View::make('Admin.dashboard', ['data' => $data]);
  }
}
