<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Category;


class RoleController extends Controller
{

    public function index () {
        return Inertia::render('Roles/Roles');
    }


    public function list(Request $request)
    {       

    
        return Inertia::render('Roles/List',[
            "paction" => 'index',
            "categorytree" =>Category::getTreeData(),
            "roles" => Role::query()
                ->when($request->input('search') && $request->input('category'),function($query,$search,$category) {
                    $query->where([
                        'title-en','like','%'.$search.'%',
                        'category','=',$category
                    ]);
                })
                ->when($request->input('search') && !$request->input('category'),function($query,$search) {
                    $query->where('title_en','like','%'.$search.'%');
                })

                ->when($request->input('category'),function($query,$category) {
                    $query->where('category','=',$category);
                })

                ->paginate(6)
                ->withQueryString()
                ->through(fn($item) =>[
                    'id'=>$item->id,
                    'category'=>Category::getItemById($item->category),
                    'title_en'=>$item->title_en,
                    'desc_en'=>$item->desc_en,
                    'created_at'=>$item->created_at->format('d M Y')
                ]),
            "filters" => $request->only(["search","category"]),
            "notification" => false
        ]);
    }


    public function form (Request $request) {

        $categorytree = Category::getTreeData();


        if (is_numeric($request->id) && is_numeric($request->id) > 0 ) {
            $item = Role::find($request->id);
        } else {
            $item = false;
        }

        return Inertia::render('Roles/Form',[
            "categorytree" => $categorytree,
            "item" => $item
        ]);
    }



    public function show($id)
    {
        $item = Role::getItemById($id);

        return Inertia::render('Roles/Show',[
            "item" => $item,
            "notification" => false
        ]);
    }





    public function create(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'category' => 'required',
            'title_en'=>'required'
        ]);

        // Add new record
        Role::create([
            'category' => ucfirst($attributes['category']),
            'title_en' => ucfirst($attributes['title_en']),
            'title_tr' => ucfirst($request['title_tr']),
            'desc_en' => ucfirst($request['desc_en']['html']),
            'desc_en_text' => ucfirst($request['desc_en']['text']),
            'desc_tr' => ucfirst($request['desc_tr']['html']),
            'desc_tr_text' => ucfirst($request['desc_tr']['text'])
        ]);

        $item = Role::getLatestItem();

        return Inertia::render('Roles/Show',[
            "item" => $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'New role has been created successfully.'
            ]
        ]); 
    }


    public function update(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'category' => 'required',
            'id'=>'required',
            'title_en'=>'required'
        ]);

        // Update record
        Role::find($attributes['id'])
        ->update([
            'category' => ucfirst($attributes['category']),
            'title_en' => ucfirst($attributes['title_en']),
            'title_tr' => ucfirst($request['title_tr']),
            'desc_en' => ucfirst($request['desc_en']['html']),
            'desc_en_text' => ucfirst($request['desc_en']['text']),
            'desc_tr' => ucfirst($request['desc_tr']['html']),
            'desc_tr_text' => ucfirst($request['desc_tr']['text'])
        ]);

        $item = Role::getItemById($attributes['id']);

        return Inertia::render('Roles/Show',[
            "item" =>  $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'Role has been updated successfully.'
            ]
        ]); 
    }

}
