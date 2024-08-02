<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the Article.
     */
    public function index()
    {
        try {
            $articles = Article::query()->get()->all();
            if($articles!=null){
                return response()->json([
                    'result'=>true,
                    'message'=>'articles received successfully',
                    'data'=>$articles
                ],200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'there is not any article',
                ],400);
            }
        }catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=> 'An error occurred while indexing articles:' . $e->getMessage()
            ],500);
        }
    }


    /**
     * Store a newly created Article in storage.
     */
    public function store(Request $request)
    {
        if($request!=null){
        //check author_id is a user
            $author=$request->input('author_id');
            $user = User::find($author);
            if($user){
            $validatedData = $request->validate([
                'author_id' => 'required',
                'content'=>'required|string',
                'title'=>'required|string',
                'slug'=>'required|string',
                'image'=>'nullable|string'
            ]);
            try{
                Article::query()->create($validatedData);
                return response()->json([
                    'result'=>true,
                    'message'=>'article created successfully'
                ],201);
            }catch (\Exception $e){
                return response()->json([
                    'result'=>false,
                    'message'=>'An error occurred while storing article: ' . $e->getMessage()
                ],500);
            }
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'there is not valid user as an author'
                ],400);
            }

        }else{
            return response()->json([
                'result'=>false,
                'message'=>'there is not any request'
            ],400);
        }
    }

    /**
     * Display the specified Article.
     */
    public function show(string $id)
    {
        try {
            $article = Article::query()->find($id);
            if($article){
                return response()->json([
                    'result'=>true,
                    'message'=>'article retrieved successfully',
                    'data'=>$article
                ],200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'article not found'
                ],404);
            }
        } catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=> 'An error occurred while retrieving article: ' . $e->getMessage()
            ],500);
        }
    }

    /**
     * Update the specified Article in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $article = Article::query()->find($id);
            if($article){
                $validatedData = $request->validate([
                    'content'=>'required|string',
                    'title'=>'required|string',
                    'slug'=>'required|string',
                    'image'=>'nullable|string'
                ]);
                $article->update($validatedData);
                return response()->json([
                    'result'=>true,
                    'message'=>'article updated successfully'
                ],201);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'article not found'
                ],404);
            }
        } catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=> 'An error occurred while updating article: ' . $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified Article from storage.
     */
    public function destroy(string $id)
    {
        try {
            $article = Article::query()->find($id);
            if($article){
                $article->delete();
                return response()->json([
                    'result'=>true,
                    'message'=>'article deleted successfully'
                ],200);
            }else{
                return response()->json([
                    'result'=>false,
                    'message'=>'article not found'
                ],404);
            }
        }catch (\Exception $e){
            return response()->json([
                'result'=>false,
                'message'=> 'An error occurred while deleting article: ' . $e->getMessage()
            ],500);
        }
    }
}
