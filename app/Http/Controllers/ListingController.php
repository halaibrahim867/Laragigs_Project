<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Session;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index',[
            'listings'=>Listing::latest()->filter
            (request(['tag','search']))->paginate(5)
        ]);
    }
    public  function show(Listing $listing){

        return view('listings.show',[
           'listing'=>$listing
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        $formFields=$request->validate([
           'title'=>'required',
           'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);


        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos',
                'public');
        }
        Listing::create($formFields);

       // \Illuminate\Support\Facades\Session::flash('message','Listing Created');

        return redirect('/')->with('message','Listing Created Successfully');
    }

    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }


    public function update(Request $request,Listing $listing){
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);


        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos',
                'public');
        }
        $listing->update($formFields);

        // \Illuminate\Support\Facades\Session::flash('message','Listing Created');

        return redirect()->back()->with('message','Listing Created Successfully');
    }

    //delete listing
    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message','Listing deleted successfully');

    }
}
