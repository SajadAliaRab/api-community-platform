<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tags = Tag::query()->get()->all();
            if($tags!=null){
                return response()->json([
                    'result'=>true,
                    'message'=>'tags received successfully ',
                    'data'=>$tags
                ],200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=> 'there is not any tag'
                ],404);
            }
        }catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=> 'An error occurred while indexing tag:' . $e->getMessage()
            ],500);
        }
    }


    /**
     * Store a newly created Tag in storage.
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'title'=>'required|string'
            ]);

                    Tag::query()->create($validatedData);
                    return response()->json([
                        'result' => true,
                        'message' => 'Tag created successfully'
                    ],201);

            }catch (\Exception $e){
                return response()->json([
                    'result'=>false,
                    'message'=> 'An error occurred while storing tag: ' . $e->getMessage()
                ],500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $tag = Tag::query()->find($id);
            if($tag!=null) {
                return response()->json([
                    'result' => true,
                    'message' => 'The tag find successfully',
                    'data' => $tag
                ], 200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'The tag not found'
                ],404);
            }
        }catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=>'An error occurred while retrieving tag: ' . $e->getMessage()
            ],500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag=Tag::query()->find($id);
        try {
            if($tag!=null){
                    $validatedData = $request->validate([
                        'title'=>'required|string'
                    ]);
                    $tag->update($validatedData);
                    return response()->json([
                        'result'=>true,
                        'message'=>'the tag updated successfully'
                    ],201);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'the tag not found!'
                ],404);
            }
        }catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=>'An error occurred while retrieving tag: ' . $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tag = Tag::query()->find($id);
            if($tag){
                $tag->delete();
                return response()->json([
                    'result'=>true,
                    'message'=>'the tag remove successfully'
                ],200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'the tag not found'
                ],404);
            }
        }catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=>'An error occurred while retrieving tag: ' . $e->getMessage()
            ],500);
        }
    }
}
