<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'areas' => Area::orderBy('created_at', 'desc')->with('user', function($user) { return $user->get(); })
                ->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
        ]);

        //Area registration
       /* if (auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied to create Area.'
            ]);
        }
        else
        {
            $area = Area::create([
                'name' =>$attrs['name'],
                'user_id' => auth()->user()->id,
                'etat' => 1
            ]);
        }*/

        $area = Area::create([
            'name' =>$attrs['name'],
            //'user_id' => auth()->user()->id,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'etat' => 1
        ]);

        return response([
            'area' => $area,
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::where('id', $id)
            ->with('user', function ($user) { return $user->get(); })
            ->get();
        return response([
           'area' => $area
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $area = Area::find($id);

        if(!$area)
        {
            return response([
                'message' => 'Area not found.'
            ], 403);
        }

        if ($area->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validation des données
        $attrs = $request->validate([
            'name' => 'required|string',
        ]);

        $area->update([
            'name' => $attrs['name'],
            'user_id' => $request->user_id,
            'description' => $request->description
            //'user_id' => auth()->user()->id,
        ]);

        return response([
            'message' => 'Area updated.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        if(!$area)
        {
            return response([
                'message' => 'Area not found.'
            ], 403);
        }

        if ($area->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ]);
        }

        $area->delete();

        return response([
            'message' => 'Area deleted.'
        ], 200);
    }
}
