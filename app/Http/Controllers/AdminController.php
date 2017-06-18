<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateQuestion;
use App\CorrectContestAnswer;
use App\User;
use App\Bottle;
use Session;
use Redirect;

class AdminController extends Controller
{
    public function index(){
      return view('admin');
    }
    public function showBottlestable(){
      $bottles = Bottle::paginate(15);
      return view('bottlestable')->with('bottles', $bottles);
    }
    public function showUserstable(){
      $users = User::all();
      return view('userstable')->with('users', $users);
    }
    public function destroyBottle($id)
    {
        // delete
        $bottle = Bottle::find($id);
        // $bottle = Bottle::whereId($id)->first();
        // $bottle = Bottle::where('id', $id);
        $bottle->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Note!');
        return Redirect::to('notestable');
    }
    public function destroyUser($id)
    {
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted user!');
        return Redirect::to('userstable');
    }
}
