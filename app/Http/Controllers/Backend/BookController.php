<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()->get();

        return view('backend.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('backend.book.create');
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, Book::rules());

        if ($validator->fails()) {
            return redirect('backend/book/create')
                ->withErrors($validator)
                ->withInput();
        }

        $model = new Book();
        $model->title = $input['title'];
        $model->path = $input['path'];

        try {
            if ($model->save()) {
                return redirect('backend/book/create')->with('success', Lang::get('messages.success'));
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/book/create')->with('error', Lang::get('messages.wrong'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $model = Book::query()->where(['id' => $id]);

            if ($model->exists()) {
                $book = $model->first();
                return view('backend.book.edit', compact('book'));
            }
        } catch (\Exception $exception) {
            logger()->error($exception);
        }

        return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::query()->where(['id' => $id]);

        if ($book->exists()) {
            $model = $book->first();
        } else {
            throw new NotFoundHttpException();
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|string|min:2|max:190|unique:books,title,' . $id,
            'path' => 'sometimes|nullable|string|min:2|max:190|unique:books,path,' . $id,
        ], [
            'title.unique' => __('messages.title_unique'),
            'path.unique' => __('messages.path_unique')
        ]);

        if ($validator->fails()) {
            return redirect(sprintf('backend/book/%s/edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        $old_path = $model->path;

        $is_path_changed = false;

        if ($input['path'] && $input['path'] != $old_path) {
            $model->path = $input['path'];
            $is_path_changed = true;
        }

        $model->title = $input['title'];

        try {
            if ($model->save()) {
                if ($is_path_changed && Storage::disk('s3')->exists($old_path)) {
                    Storage::disk('s3')->delete($old_path);
                }

                return redirect('backend/book')->with('success', Lang::get('messages.updated'));
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/book')->with('error', Lang::get('messages.wrong'));
    }

    /**
     * @param Request $request
     */
    public function removeBook(Request $request)
    {
        $name = $request->post('name');

        if ($name && Storage::disk('s3')->exists($name)) {
            Storage::disk('s3')->delete($name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            $name = $book->path;

            if ($name && Storage::disk('s3')->exists($name)) {
                Storage::disk('s3')->delete($name);
            }

            if ($book->delete()) {
                return redirect('backend/book')->with('success', Lang::get('messages.deleted'));
            };
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/book')->with('error', Lang::get('messages.wrong'));
    }
}
