<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $categories = CategoryResource::collection(Category::where('store_id', auth()->id())->get());

        return Inertia::render('Crm/Category/List', [
            'categories' => $categories,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Crm/Category/Create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $request->validated();

        $category = new Category();
        $category->name = $request->name;
        $category->category_code = $request->category_code;
        $category->store_id = auth()->id();
        $category->is_visible = true;

        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category): Response
    {
        return Inertia::render('Crm/Category/Edit', ['category' => $category->toArray()]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $request->validated();

        $category->name = $request->name;
        $category->category_code = $request->category_code;

        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Category Deleted Successfully');
    }

    /**
     * Show/hide category in navigation panel
     *
     * @param CategoryService $service
     * @param Category $category
     * @return RedirectResponse
     */
    public function toggleActiveStatus(CategoryService $service, Category $category): \Illuminate\Http\RedirectResponse
    {
        $service->toggleStoreIsActive($category);

        return redirect()->route('categories.index')->with('message', 'Category visibility changed');
    }
}
