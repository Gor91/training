<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\MakeImagesFromPDFJob;
use App\Jobs\RemoveImagePDFJob;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
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

        $file = $request->file('book');
        $new_name = $file->getClientOriginalName();

        $model = new Book();
        $model->title = $input['title'];
        $model->path = $new_name;

        try {
            if ($model->save()) {
                $path = public_path(Config::get('constants.UPLOADS') . '/books/' . $model->id);

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }

                $file->move($path, $new_name);

                $this->dispatch((new MakeImagesFromPDFJob($model))->delay(5));

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
            'book' => 'sometimes|nullable|file|mimes:pdf',
        ], [
            'title.unique' => __('messages.title_unique'),
        ]);

        if ($validator->fails()) {
            return redirect(sprintf('backend/book/%s/edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('book');

        $is_file_changed = false;

        $model->title = $input['title'];

        if (!empty($file)) {
            $is_file_changed = true;
            $new_name = $file->getClientOriginalName();
            $model->path = $new_name;

            $this->dispatch((new RemoveImagePDFJob($model))->delay(5));
        }

        try {
            if ($model->save()) {
                if ($is_file_changed) {
                    $path = public_path(Config::get('constants.UPLOADS') . '/books/' . $model->id);

                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0775, true, true);
                    }

                    $file->move($path, $new_name);

                    $this->dispatch((new MakeImagesFromPDFJob($model))->delay(5));
                }
                return redirect('backend/book')->with('success', Lang::get('messages.updated'));
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/book')->with('error', Lang::get('messages.wrong'));
    }

    /**
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Book $book)
    {
        try {
            if ($book->delete()) {
                $this->dispatch((new RemoveImagePDFJob($book))->delay(5));
                return redirect('backend/book')->with('success', Lang::get('messages.deleted'));
            };
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/book')->with('error', Lang::get('messages.wrong'));
    }
}
