<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Group;
use Auth;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    private $limit= 3;

    public function autocomplete(Request $request)
    {
        if( $request->ajax())
        {
            return Contact::select(['id','name as value'])->where(function($query) use ($request){
           
                if($term = ($request->get('term')))
                {
                    $keywords = '%' . $term . '%';
                    $query->orWhere("name",'LIKE', $keywords);
                    $query->orWhere("company",'LIKE', $keywords);
                    $query->orWhere("email",'LIKE', $keywords);
                }
            })
           ->orderBy('name', 'asc')
           ->take(5)
           ->get();
        }
         
    }

    public function index(Request $request)
    {
        $contacts = Contact::where(function($query) use ($request){
            $query->where("user_id",Auth::id());
            if ($group_id = ($request->get('group_id'))){
                $query->where('group_id', $group_id);
            }
            if($term = ($request->get('term')))
            {
                $keywords = '%' . $term . '%';
                $query->orWhere("name",'LIKE', $keywords);
                $query->orWhere("company",'LIKE', $keywords);
                $query->orWhere("email",'LIKE', $keywords);
            }
        })
       ->orderBy('id', 'desc')
       ->paginate($this->limit);
        
        // if ($group_id = ($request->get('group_id'))) {
        //     $contacts = Contact::where('group_id', $group_id)->orderBy('id', 'desc')->paginate($this->limit);
        // }
        // else{
        //     $contacts = Contact::orderBy('id', 'desc')->paginate($this->limit);
        // }
        // if($term = ($request->get('term')))
        // {
        //     $contacts= Contact::query()
        //     ->where('name', 'LIKE', "%{$term}%") 
        //     ->orWhere('email', 'LIKE', "%{$term}%") 
        //     ->get();
        // }
        // $contacts = Contact::paginate(3);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups =Group::pluck('name', 'id');
        return view('contacts.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:5",
            "company" => "required",
            "email" => "required|email",
        ]);

        $newcontact = new Contact;
        $newcontact->name = $request['name'];
        $newcontact->company = $request['company'];
        $newcontact->email = $request['email'];
        $newcontact->phone = $request['phone'];    
        $newcontact->address = $request['address'];
        $newcontact->group()->associate($request['group']);
        $newcontact->user_id = Auth::id(); 
         
        $newcontact->save();

        $insert_id = $newcontact->id;
        if($files =$request->file('image')){
            $destinationPath ='uploads/';
            $profileImage =$insert_id . "_img" . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            Contact::where('id', $insert_id)->update(['image' => $profileImage]);
        }
        return redirect('contacts')->with('message', 'Contact Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $this->authorize('modify', $contact);
        $groups =Group::pluck('name', 'id');
       
        // dd($groups);
        // dd($contact->group_id);
        return view('contacts.edit', compact('contact', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|min:5",
            "company" => "required",
            "email" => "required|email",
        ]);
    
        $contact = Contact::findOrFail($id);
        $this->authorize('modify', $contact);
        $contact->name = $request['name'];
        $contact->company = $request['company'];
        $contact->email = $request['email'];
        $contact->phone = $request['phone'];    
        $contact->address = $request['address'];
        $contact->group()->associate($request['group']);

        if($files = $request->file('image')){
            $destinationPath = 'uploads/';
            $profileImage = $id . "_img." . $files->getClientOriginalExtension();
            $files->move($destinationPath,$profileImage);
            $contact->image = $profileImage;
        }
         
        $contact->save();

        return redirect('contacts')->with('message', 'Contact Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $this->authorize('modify', $contact); 
        if(file_exists('uploads/'. $contact->image)){
            unlink('uploads/'. $contact->image);
        }
        $contact->delete();
        return redirect("/contacts")->with('message', 'Contact deleted!');
    }
}
