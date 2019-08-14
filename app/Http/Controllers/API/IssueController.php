<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Issue;

class IssueController extends Controller
{
    public function __construct()
    {
       
    }

    public function index()
    {
        return Issue::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required|numeric', 
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:800',
            'resolved' => 'required|numeric'
        ]);

        return Issue::create([
            'user_id' => $request['user_id'],
            'subject' => $request['subject'],
            'description' => $request['description'],
            'resolved' => $request['resolved'],
        ]);
    }

    public function show($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        $this->validate($request,[
            'resolved' => 'required|numeric'
        ]);
        $issue->update($request->all());
    }


    public function destroy($id, Request $request)
    {
        $issue = Issue::findOrFail($id);
        $issue->forceDelete(); 
    }

}
