<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{
    public function prepareArray ($request,$notification) {

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

        if ($request->input('userid')) {
            $params["created_by"] = $request->input('userid');
        }

        return [
            "item" => false,
            "professions" => Profession::query()
                ->orderBy($sortcolumn,$sortorder)
                ->when($params ,function($query,$params) {

                    if (isset($params['search']) && !empty($params['search'])) {
                        $query->where('title','like','%'.$params['search'].'%');
                    }

                    if (isset($params['created_by']) && !empty($params['created_by'])) {
                        $query->where('created_by','=',$params['created_by']);
                    }
                })                
                ->paginate(Config::get('constants.table.no_of_results'))
                ->through(fn($item) =>Profession::setUserTime($item))
                ->withQueryString(),
            "filters" => $request->only(["search"]),
            "notification" => $notification
        ];
    }



    public function list(Request $request,$notification = false) {

        return Inertia::render('Profession/List',$this->prepareArray($request,$notification));
    }


    public function form(Request $request)
    {
        if (is_numeric($request->id) && is_numeric($request->id) > 0 ) {
            $item = Profession::find($request->id);
        } else {
            $item = false;
        }

        return Inertia::render('Profession/Form',[
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
        Profession::create([
            'title' => ucfirst($attributes['title']),
            'remarks' => $request['remarks']['html'],
            'remarks_text' => $request['remarks']['text']
        ]);

        $item = Profession::getLatestItem();

        return Inertia::render('Profession/Show',[
            "item" => $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'New profession has been created successfully.'
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
        Profession::find($attributes['id'])
        ->update([
            'title' => ucfirst($attributes['title']),
            'remarks' => $request['remarks']['html'],
            'remarks_text' => $request['remarks']['text']
        ]);

        $item = Profession::getItemById($attributes['id']);

        return Inertia::render('Profession/Show',[
            "item" =>  $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'Profession has been updated successfully.'
            ]
        ]); 
    }


    public function show($id)
    {
        $item = Profession::getItemById($id);

        return Inertia::render('Profession/Show',[
            "item" => $item,
            "notification" => false
        ]);
    }



    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Profession::find($request->id)->delete();
        }

        $notification = [
            "type" =>'success',
            "message" => 'Skill has been deleted successfully.'
        ];

        return Inertia::render('Profession/List',$this->prepareArray($request,$notification));
    }



}