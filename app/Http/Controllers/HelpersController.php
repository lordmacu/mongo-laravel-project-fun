<?php
namespace App\Http\Controllers;
use App\Sites;

class HelpersController extends Controller {
    
    
    public function mongo(){
    
        
        $users = Sites::all();

        dd($users);
    }
}