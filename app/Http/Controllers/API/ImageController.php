<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Http\Request;
use Laravel\Telescope\AuthorizesRequests;

class ImageController extends Controller
{
    use AuthorizesRequests;

    private ImageServiceInterface $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        return $this->imageService->getAllImages();
    }

    public function show(int $id)
    {
        return $this->imageService->getImageById($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->imageService->createImage($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        return $this->imageService->updateImage($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->imageService->deleteImage($id);
    }

    public function showByCriteria(Request $request)
    {
        $criteria = $request->all();
        return $this->imageService->getImageByCriteria($criteria);
    }
}
