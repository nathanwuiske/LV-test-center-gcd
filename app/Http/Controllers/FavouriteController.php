<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth'); 
  }

  public function index()
  {
    return view('favourites');
  }
}
