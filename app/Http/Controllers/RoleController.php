<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use App\Models\Role;
use App\Models\Category;
use App\Models\Skill;


class RoleController extends Controller
{

    public function index () {
        return Inertia::render('Roles/Roles');
    }


    public function list(Request $request)
    {             
        $sortcolumn = 'title_en';
        $sortorder = 'asc';

        if ($request->input('sortcolumn')) {
            $sortcolumn = $request->input('sortcolumn');
        }

        if ($request->input('sortorder')) {
            $sortorder = $request->input('sortorder');
        }

        $params = false;

        if ( $request->input('search') ) {
            $params["search"] = $request->input('search');
        }

        if ($request->input('category')) {
            $params["category"] = $request->input('category');
        }

        if ($request->input('userid')) {
            $params["userid"] = $request->input('userid');
        }


        return Inertia::render('Roles/List',[
            // "paction" => 'index',
            // "categorytree" =>Category::getTreeData(),
            "roles" => Role::query()
                ->orderBy($sortcolumn,$sortorder)
                ->when($params,function($query,$params) {

                    if (isset($params['search']) && !empty($params['search'])) {
                        $query->where('title_en','like','%'.$params['search'].'%');
                    }

                    if (isset($params['category']) && !empty($params['category'])) {
                        $query->where('category','=',$params['category']);
                    }

                    if (isset($params['userid']) && !empty($params['userid'])) {
                        $query->where('created_by','=',$params['userid']);
                    }

                })
                ->paginate(Config::get('constants.table.no_of_results'))
                ->through(fn($item) =>Role::processItem($item))
                ->withQueryString(),
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


    public function select(Request $request)
    {
        return Inertia::render('Roles/SelectSkills',[
            "id" => $request->id,
            "skilltree" =>  Skill::getTreeData(),
            "roleSkills" => [ ["id"=>1,"level"=>2],["id" => 3, "level" => 3]]
        ]); 
    }


    public function roleskill(Request $request)
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





}


