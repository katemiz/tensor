<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Education;
use Inertia\Inertia;
use App\Models\User;


class EducationController extends Controller
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

        return Education::query()
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
        ->through(fn($item) =>Education::processItem($item))
        ->withQueryString();
    }






    public function index(Request $request,$notification = false) {

/*         return Inertia::render('Education/List',[
            "item" => false,
            "educations" => Education::query()
                ->when($request->input('search'),function($query,$search) {
                    $query->where('title','like','%'.$search.'%');
                })
                ->paginate(6)
                ->withQueryString()
                ->through(fn($item) =>[
                    'id'=>$item->id,
                    'title'=>$item->title,
                    'remarks'=>$item->remarks,
                    'created_at'=>$item->created_at->format('d M Y')
                ]),
            "filters" => $request->only(["search"]),
            "notification" => $notification
        ]); */

        return Inertia::render('Education/List',[
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
            $item = Education::find($request->id);
        } else {
            $item = false;
        }

        return Inertia::render('Education/Form',[
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
        Education::create([
            'title' => ucfirst($attributes['title']),
            'remarks' => $request['remarks']['html'],
            'remarks_text' => $request['remarks']['text']
        ]);

        $item = Education::getLatestItem();

        return Inertia::render('Education/Show',[
            "item" => $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'New education level has been created successfully.'
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
        Education::find($attributes['id'])
        ->update([
            'title' => ucfirst($attributes['title']),
            'remarks' => ucfirst($request['remarks']['html']),
            'remarks_text' => ucfirst($request['remarks']['text'])
        ]);


        // $item = $this->getUserTime(Education::find($attributes['id']));
        $item = Education::getItemById($attributes['id']);;



        //$item = Education::find($attributes['id']);
        // $item["created_by"] = User::select('name','lastname','email')->where('id', $item["created_by"])->first();
        // $item["created_diff"] = Carbon::parse($item["created_at"])->diffForHumans();

        return Inertia::render('Education/Show',[
            "item" =>  $item,
            "notification" =>  [
                "type" =>'success',
                "message" => 'Education Level has been updated successfully.'
            ]
        ]); 
    }


    public function show($id)
    {
        $item = Education::getItemById($id);;

        return Inertia::render('Education/Show',[
            "item" => $item,
            "notification" => false
        ]);
    }


    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Education::find($request->id)->delete();
        }

        return Inertia::render('Education/List',[
            "item" => false,
            "educations" => $this->prepareArray($request),
            "filters" => $request->only(["search"]),
            "notification" => [
                "type" =>'success',
                "message" => 'Education level has been deleted successfully.'
            ]
        ]);
    }


/*     function getUserTime($item) {

        $item["created_by"] = User::select('name','lastname','email')->where('id', $item["created_by"])->first();
        $item["created_diff"] = Carbon::parse($item["created_at"])->diffForHumans();

        $item["updated_by"] = User::select('name','lastname','email')->where('id', $item["updated_by"])->first();
        $item["updated_diff"] = Carbon::parse($item["updated_at"])->diffForHumans();

        return $item;
    } */

}

