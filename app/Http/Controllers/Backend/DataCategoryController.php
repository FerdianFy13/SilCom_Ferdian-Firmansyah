<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DataCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::orderBy('name', 'asc')->get();

        return view('pages.data-category.index', [
            'title' => 'Data Category',
            'menu' => 'Data Category',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data-category.create', [
            'title' => 'Add Data Category',
            'menu' => 'Data Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[a-zA-Z][a-zA-Z\s]*$/',
                    'max:50',
                    'unique:categories'
                ],
                'description' => 'required',
            ], $this->messageValidation(), $this->attributeValidation());


            $data = Category::create($validation);

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'The category has been successfully registered.',
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to register the category.'
                ], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Course::with('category')->where('category_id', decrypt($id))->get();

        return view('pages.data-category.show', [
            'title' => 'Show Data Course',
            'menu' => 'Data Course',
            'data' => $data
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
        $data = Category::findOrFail(decrypt($id));

        return view('pages.data-category.edit', [
            'title' => 'Edit Data Category',
            'menu' => 'Data Category',
            'data' => $data
        ]);
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
        try {
            $validation = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[a-zA-Z][a-zA-Z\s]*$/',
                    'max:50',
                    'unique:categories,name,' . $id
                ],
                'description' => 'required',
            ], $this->messageValidation(), $this->attributeValidation());

            $category = Category::findOrFail($id);
            $category->update($validation);

            return response()->json([
                'status' => 'success',
                'message' => 'The category has been successfully updated.',
                'data' => $category
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the category.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function messageValidation()
    {
        $message = [
            'required' => ':attribute is required.',
            'string' => ':attribute must be a string.',
            'regex' => 'The format of :attribute is invalid.',
            'unique' => ':attribute has already been taken.',
            'digits_between' => ':attribute must be between :min and :max digits.',
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute may not be greater than :max characters.',
            'validation_truck' => ':attribute entered is invalid or not found.',
            'less_than_current_year' => ':attribute must be less than the current year.',
        ];

        return $message;
    }

    private function attributeValidation()
    {
        $customAttributes = [
            'name' => 'Name',
            'description' => 'Description',
        ];

        return $customAttributes;
    }
}
