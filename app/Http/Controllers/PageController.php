<?php

namespace App\Http\Controllers;

use App\Models\FeaturedImageType;
use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\YesNoOptions;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pages = Page::select(['id', 'name', 'published', 'meta_keywords'])
            ->orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page, $url): View|RedirectResponse
    {
        if ($page->url != $url) {
            return redirect()->route('page', ['id' => $page->id, 'url' => $page->url]);
        }

        $pages = Page::all();
        return view('pages/show', ['page' => $page, 'pages' => $pages]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page) : View
    {
        $yesNoOptions = YesNoOptions::getOptions();
        $imageOptions = FeaturedImageType::getOptions();

        return view('admin.pages.edit', [
            'page' => $page,
            'yesNoOptions' => $yesNoOptions,
            'imageOptions' => $imageOptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $errors = [];
        $deleted = true;
        $savedNewFile = true;

        if ($image = $request->file('featured_image_path')) {
            $extension = $image->extension();
            $fileNameWithoutExtension = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $page->id . '-' . Str::slug($fileNameWithoutExtension) . '.' . $extension;

            $savedNewFile = $image->storeAs(Page::PAGES_IMAGES_PATH, $imageName, 'public');

            if ($page->featured_image_path && $savedNewFile) {
                $deleted = Storage::disk('public')->delete(Page::PAGES_IMAGES_PATH . $page->featured_image_path);
            }

            if ($savedNewFile) {
                $page->featured_image_path = $imageName;
            }

        }

        if (!$deleted) {
            $errors[] = 'Unable to delete old page image from disk. Probably a permission problem.';
        }

        if (!$image && $request->post('featured_image_external_url')) {
            $page->featured_image_external_url = $request->post('featured_image_external_url');
        }

        $page->name = $request->post('name');
        $page->published = $request->post('published');
        $page->meta_description = $request->post('meta_description');
        $keyWords = $request->post('meta_keywords');
        $page->meta_keywords = is_array( $keyWords) ? implode(',', $keyWords) : $keyWords;
        $page->featured_image_type = $request->post('featured_image_type');
        $page->featured_image_alt = $request->post('featured_image_alt');
        $page->content = $request->post('content');
        $saved = $page->save();

        if (!$saved) {
            $errors[] = 'Unable to update post data in the database';
        }

        if (!$savedNewFile) {
            $errors[] = 'Could not save new image to the disk. Probably a permission problem.';
        }

        if (count($errors)) {
            return redirect()->back()->withErrors($errors)->withInput($request->all());
        }

        session()->flash('success_message', 'Page ' . $page->id . ' successfully updated!');

        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $image = $page->featured_image_path;
        $deleted = $page->delete();
        $errors = [];
        $deletedFile = true;

        if ($image && $deleted) {
            $deletedFile = Storage::disk('public')->delete(Page::PAGES_IMAGES_PATH . $image);
        }

        if ($deletedFile && $deleted) {
            session()->flash('success_message', 'Page successfully deleted!');
        }

        if (!$deleted) {
            $errors[] = 'Unable to delete page';
        }

        if (!$deletedFile) {
            $errors[] = 'Unable to delete old page image from disk. Probably a permission problem.';
        }

        return redirect()->route('admin.pages.index')->withErrors($errors);
    }

    public function deleteFeaturedImage(Page $page, $token, Request $request) : RedirectResponse
    {
        if ($request->session()->token() != $token) {
            abort(401);
        }

        $deleted = false;

        if ($page->featured_image_type == FeaturedImageType::File->value) {
            $deleted = Storage::disk('public')->delete(Page::PAGES_IMAGES_PATH . $page->featured_image_path);
            $page->featured_image_path = null;
        } elseif ($page->featured_image_type == FeaturedImageType::URL->value) {
            $deleted = true;
            $page->featured_image_external_url = null;
        }

        $page->featured_image_alt = null;
        $saved = $page->save();
        $errors = [];

        if (!$deleted) {
            $errors[] = 'Unable to delete image file from storage';
        }

        if (!$saved) {
            $errors[] = 'Unable to update database';
        }

        if ($deleted && $saved) {
            session()->flash('success_message', 'Featured Image successfully deleted!');
        }

        return redirect()->route('admin.pages.edit', ['page' => $page->id])->withErrors($errors);
    }
}
