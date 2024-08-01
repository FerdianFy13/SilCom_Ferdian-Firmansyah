<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DataCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::with('category')->orderBy('title', 'ASC')->get();

        return view('pages.data-course.index', [
            'title' => 'Data Course',
            'menu' => 'Data Course',
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
        $category = Category::orderBy('name', 'ASC')->get();

        return view('pages.data-course.create', [
            'title' => 'Add Data Course',
            'menu' => 'Data Course',
            'data' => $category
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
                'category_id' => 'required|exists:categories,id',
                'title' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[a-zA-Z][a-zA-Z\s]*$/',
                    'max:50',
                    'unique:courses'
                ],
                'price' => 'required|digits_between:1,7|regex:/^[1-9][0-9]*$/',
                'duration' => 'required|digits_between:1,4|regex:/^[1-9][0-9]*$/',
                'quota' => 'required|digits_between:1,5|regex:/^[1-9][0-9]*$/',
                'image_poster' => 'image|mimes:jpeg,png,jpg|max:2048',
                'image_banner' => 'image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required',
            ], $this->messageValidation(), $this->attributeValidation());

            $validation['status'] = 'Active';

            if ($request->file('image_poster')) {
                $name = strtolower($validation['title']);
                $currentDate = now()->format('Ymd');

                $extension = $request->file('image_poster')->getClientOriginalExtension();
                $imageName = "{$name}_poster_{$currentDate}.{$extension}";

                $validation['image_poster'] = $request
                    ->file('image_poster')
                    ->storeAs('data-course/image_poster', $imageName);
            }

            if ($request->file('image_banner')) {
                $name = strtolower($validation['title']);
                $currentDate = now()->format('Ymd');

                $extension = $request->file('image_banner')->getClientOriginalExtension();
                $imageName = "{$name}_banner_{$currentDate}.{$extension}";

                $validation['image_banner'] = $request
                    ->file('image_banner')
                    ->storeAs('data-course/image_banner', $imageName);
            }

            $data = Course::create($validation);

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'The course has been successfully registered.',
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to register the course.'
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
    public function show($encrytedId)
    {
        try {
            $id = decrypt($encrytedId);
            $data = Course::with('category')->findOrFail($id);

            return view('pages.data-course.show', [
                'title' => 'Show Data Course',
                'menu' => 'Data Course',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('data-course.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($encrytedId)
    {
        try {
            $id = decrypt($encrytedId);
            $data = Course::with('category')->findOrFail($id);
            $category = Category::orderBy('name', 'ASC')->get();

            return view('pages.data-course.edit', [
                'title' => 'Edit Data Course',
                'menu' => 'Data Course',
                'data' => $data,
                'category' => $category
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('data-course.index');
        }
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
                'category_id' => 'required|exists:categories,id',
                'title' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[a-zA-Z][a-zA-Z\s]*$/',
                    'max:50',
                    'unique:courses,title,' . $id
                ],
                'price' => 'required|digits_between:1,7|regex:/^[1-9][0-9]*$/',
                'duration' => 'required|digits_between:1,4|regex:/^[1-9][0-9]*$/',
                'quota' => 'required|digits_between:1,5|regex:/^[1-9][0-9]*$/',
                'image_poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'image_banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required',
            ], $this->messageValidation(), $this->attributeValidation());

            $course = Course::findOrFail($id);
            $validation['status'] = 'Active';

            if ($request->file('image_poster')) {
                if ($course->image_poster) {
                    Storage::delete($course->image_poster);
                }

                $name = strtolower($validation['title']);
                $currentDate = now()->format('Ymd');

                $extension = $request->file('image_poster')->getClientOriginalExtension();
                $imageName = "{$name}_poster_{$currentDate}.{$extension}";

                $validation['image_poster'] = $request
                    ->file('image_poster')
                    ->storeAs('data-course/image_poster', $imageName);
            } else {
                $validation['image_poster'] = $course->image_poster;
            }

            if ($request->file('image_banner')) {
                if ($course->image_banner) {
                    Storage::delete($course->image_banner);
                }

                $name = strtolower($validation['title']);
                $currentDate = now()->format('Ymd');

                $extension = $request->file('image_banner')->getClientOriginalExtension();
                $imageName = "{$name}_banner_{$currentDate}.{$extension}";

                $validation['image_banner'] = $request
                    ->file('image_banner')
                    ->storeAs('data-course/image_banner', $imageName);
            } else {
                $validation['image_banner'] = $course->image_banner;
            }

            $course->update($validation);

            return response()->json([
                'status' => 'success',
                'message' => 'The course has been successfully updated.',
                'data' => $course
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the course.'
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

    public function updateStatus(Course $category)
    {
        try {
            $category->status = ($category->status === 'Active') ? 'Inactive' : 'Active';
            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully.',
                'status' => $category->status
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update status.'
            ], 500);
        }
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
            'title' => 'Title',
            'category_id' => 'Category',
            'price' => 'Price',
            'duration' => 'Duration',
            'quota' => 'Quota',
            'description' => 'Description',
            'status' => 'Status',
            'image_position' => 'Image Poster',
            'image_banner' => 'Image Course',
        ];

        return $customAttributes;
    }
}
