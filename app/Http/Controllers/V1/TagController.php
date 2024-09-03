<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\TagService;
use App\Requests\TagRequest;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(): JsonResponse
    {
        return $this->tagService->getAllTags();
    }

    public function store(TagRequest $request): JsonResponse
    {
        return $this->tagService->createTag($request->validated());
    }

    public function show(string $id): JsonResponse
    {
        return $this->tagService->getTagById($id);
    }

    public function update(TagRequest $request, string $id): JsonResponse
    {
        return $this->tagService->updateTag($id, $request->validated());
    }

    public function destroy(string $id): JsonResponse
    {
        return $this->tagService->deleteTag($id);
    }
}
