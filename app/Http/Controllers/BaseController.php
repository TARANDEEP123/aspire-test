<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
    /**
     * Model class object
     * @var
     */
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index (Request $request)
    // {
    //     return response()->json(['success'=> true, 'response' => $this->model::with($request->relations)->get()]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $record = $this->model::create($request->all());

        return $record;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, Request $request)
    {
        $relation = $request->relations ? : [];
        $record = $this->model::with($relation)->find($id);

        if ( !$record ) {
            return redirect($request->url)->with('No such record');
        }

        return $record;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        $record = $this->model::find($id);

        if ( !$record ) {
            return failure('No such records');
        }

        foreach ( $request->all() as $key => $value ) {
            $record->setAttribute($key, $value);
        }

        $record->save();

        return $record;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        return $this->model::where('id', $id)->delete();
    }
}
