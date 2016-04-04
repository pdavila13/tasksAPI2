<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class TagController extends Controller {
    /**
     * TagController constructor.
     */
//    public function __construct() {
//        $this->middleware('auth:api');
//    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //return Tag::all();

        $tag = Tag::all();

        return Response::json([
            'data' => $this->transformCollection($tag)
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $tag = new Tag();

        $this->saveTag($request, $tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //return $tag = Tag::findOrFail($id);
        //$tag = Tag::where('id',$id)->first();

        $tag = Tag::find($id);

        if (!$tag) {
            return Response::json([
                'error' => [
                    'message' => 'Tag does not exist',
                    'code' => 195
                ]
            ], 404);
        }

        return Response::json([
            'data' => $this->transform($tag->toArray())
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //$tag = Tag::findOrFail($id);

        $tag = Tag::find($id);

        if (!$tag) {
            return Response::json([
                'error' => [
                    'message' => 'Task does not exist',
                    'code' => 195
                ]
            ], 404);
        }

        return Response::json([
            'data' => $tag->toArray()
        ],200);

        $this->saveTag($request, $tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Tag::destroy($id);
    }

    public function transformCollection($tag) {
        return array_map([$this, 'transform'], $tag->toArray());
    }

    private function transform($tag){
        return [
            'name' => $tag['name']
        ];
    }

    /**
     * @param Request $request
     * @param $tag
     */
    public function saveTag(Request $request, $tag) {
        $tag->name = $request->name;
        $tag->save();
    }
}
