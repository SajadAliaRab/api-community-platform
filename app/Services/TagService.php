<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagService
{
    public function getAllTags(): JsonResponse
    {
        $tags = Tag::all();
        return $this->successResponse($tags, 'Tags received successfully');
    }

    public function createTag(array $data): JsonResponse
    {
        $tag = Tag::create($data);
        return $this->successResponse($tag, 'Tag created successfully', 201);
    }

    public function getTagById(string $id): JsonResponse
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return $this->errorResponse('Tag not found', 404);
        }
        return $this->successResponse($tag, 'Tag found successfully');
    }

    public function updateTag(string $id, array $data): JsonResponse
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return $this->errorResponse('Tag not found', 404);
        }
        $tag->update($data);
        return $this->successResponse($tag, 'Tag updated successfully');
    }

    public function deleteTag(string $id): JsonResponse
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return $this->errorResponse('Tag not found', 404);
        }
        $tag->delete();
        return $this->successResponse(null, 'Tag removed successfully');
    }

    private function successResponse($data, string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'result' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    private function errorResponse(string $message, int $status): JsonResponse
    {
        return response()->json([
            'result' => false,
            'message' => $message
        ], $status);
    }
}
