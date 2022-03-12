<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Diploma;
use Inertia\Inertia;
use App\Models\User;


class DiplomaController extends Controller
{


    public function prepareArray($request)
    {
        $sortcolumn = 'title';
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

        return Diploma::query()
        ->orderBy($sortcolumn,$sortorder)
        ->when($params,function($query,$params) {

            if (isset($params['search']) && !empty($params['search'])) {
                $query->where('title','like','%'.$params['search'].'%');
            }

            if (isset($params['userid']) && !empty($params['userid'])) {
                $query->where('created_by','=',$params['userid']);
            }

        })
        ->paginate(Config::get('constants.table.no_of_results'))
        ->through(fn($item) =>Diploma::processItem($item))
        ->withQueryString();
    }






    public function index(Request $request,$notification = false) {

        return Inertia::render('Diploma/List',[
            "item" => false,
            "educations" => $this->prepareArray($request),
            "filters" => $request->only(["search"]),
            "notification" => $notification
        ]);
    }


    public function form(Request $request)
    {
        //dd($request->id);
        if (is_numeric($request->id) && is_numeric($request->id) > 0 ) {
            $item = Diploma::find($request->id);
        } else {
            $item = false;
        }

        return Inertia::render('Diploma/Form',[
            "item" => $item
        ]);
    }


    public function create(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'title'=>'required'
        ]);

        // Add new record
        Diploma::create([
            'title' => ucfirst($attributes['title']),
            'remarks' => $request['remarks']['html'],
            'remarks_text' => $request['remarks']['text']
        ]);

        $item = Diploma::getLatestItem();

        return Inertia::render('Diploma/Show',[
            "item" => $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'New Diploma level has been created successfully.'
            ]
        ]); 
    }


    public function update(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'id'=>'required',
            'title'=>'required'
        ]);

        // Update record
        Diploma::find($attributes['id'])
        ->update([
            'title' => ucfirst($attributes['title']),
            'remarks' => ucfirst($request['remarks']['html']),
            'remarks_text' => ucfirst($request['remarks']['text'])
        ]);


        $item = Diploma::getItemById($attributes['id']);;




        return Inertia::render('Diploma/Show',[
            "item" =>  $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'Diploma Level has been updated successfully.'
            ]
        ]); 
    }


    public function show($id)
    {
        $item = Diploma::getItemById($id);;

        return Inertia::render('Diploma/Show',[
            "item" => $item,
            "notification" => false
        ]);
    }


    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Diploma::find($request->id)->delete();
        }

        return Inertia::render('Diploma/List',[
            "item" => false,
            "educations" => $this->prepareArray($request),
            "filters" => $request->only(["search"]),
            "notification" => [
                "type" =>'success',
                "message" => 'Diploma level has been deleted successfully.'
            ]
        ]);
    }
}

