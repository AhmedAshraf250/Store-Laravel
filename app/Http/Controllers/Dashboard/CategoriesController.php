<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpParser\Builder\Function_;

//use Exception;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request(); // return request object from service container

        $categories = Category::with('parent')

            // SELECT a.*, parents.name AS parent_name FROM `categories` As `a` LEFT JOIN `categories` AS `parents` ON parents.id = a.parent_id
            /* leftJoin('categories As parents', 'parents.id', '=', 'categories.parent_id')
                ->select(['categories.*', 'parents.name AS parent_name']) */

            // "select `categories`.*, (select count(*) from `products` where `categories`.`id` = `products`.`category_id` and `status` = ?) as `products_count` from `categories` where `categories`.`deleted_at` is null order by `categories`.`name` asc"
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', '=', 'active')->withoutGlobalScope('store');
                }
            ])  // == [->select('categories.*')->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id and status = ?) as products_count')]
            ->filter(request()->query())
            ->orderBy('categories.name')
            ->paginate(); // return Collection Object
        // $categories = Category::simplePaginate(1); // « Previous || Next »

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $clean_data = $request->validate(Category::rules()); // ميثود الفاليدات هنا برتجع البيانات التى تم فحصها واللى انا محددها, وبالتالى ليس من المفترض كامل البيانات فى الريكوست
        $request->validate(Category::rules(), [
            'required' => 'This Field(:attribute) is required',
            'unique' => 'This Field(:attribute) is Already Exists',
            'image.max' => 'الصورة التى قمت برفعهاأكبر من 2 ميجابايت'
        ]);
        /**
         * # Ways to Access to the data in the Request
         *     - [Single Data]
         *          $request->query('name');
         *          // action="{{route('categories.store')}}?name=x" -> "x" {"only URL" -> 'query string'}
         *          $request->input('name');
         *          // action="{{route('categories.store')}}?name=x" -> "x" {take from 'url' and 'post' in the same time, "but" it looks and take from 'url' first}
         *          $request->get('name');
         *          // Bring me its value, whether it is in the 'get' or 'post'
         *          $request->post('name');
         *          // take value from post request body
         *          $request->name;
         *          // The shortcut method
         *          $request['name'];
         *          // request is an object which implements "ArrayAccess" So it can be treated as an array
         *
         *     - [Collection of Data]
         *          $request->all();
         *          // return array of all input data
         *          $request->only(['name', 'parent_id']);
         *          // return array of keys or names which I prompted
         *          $request->except(['image']);
         *          // return array of all data except ....
         *          // we can send "get" and "post" Request in the same time with <form method='post'>
         */

        // Request Merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image'); //return array

        // Upload Files
        $new_image = $this->uploadImage2($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image'); // Return Uploaded file object
        //     // $file->getClientOriginalName();
        //     // $file->getSize();
        //     // $file->getClientOriginalExtension();
        //     // $file->getMimeType();
        //     $path = $file->store('uploads', ['disk' => 'public']); // Take uploaded file from temp folder to continuously store // retrn the path of the storage
        //     $data['image'] = $path;
        // }
        // dd($data);
        Category::create($data);
        // at the final we must implements "PRG"->'Post Redirect Get', which mean every 'post' request redirect 'get
        // return redirect(route('categories.index'));
        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = new Category;
        $cate_parents = Category::all();
        return view('dashboard.categories.create', compact('cate_parents'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Route::get('/cate/{$cate}/show', [Category::class,'show]) ---->  public function show(Category $cate){} // Must Same Parameter
        return view('dashboard.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $category = Category::find($id);
            if (!$category) {
                throw new \Exception('Category not found');
            }
        } catch (\Exception $e) {
            // abort(404);
            return redirect()->route('dashboard.categories.index')->with('info', $e->getMessage());
        }

        // "select * from `categories` where `id` <> ? and (`parent_id` is null or `parent_id` <> ?)"
        $cate_parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')->orWhere('parent_id', '<>', $id);
            })->get();

        return view('dashboard.categories.edit', compact('category', 'cate_parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // $request->validate(Category::rules($id));

        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        $old_image = $request->image;
        $data = $request->except('image');

        // Upload Files
        $new_image = $this->uploadImage2($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update($data);
        // $category->fill($request->all())->save();
        if ($old_image && isset($data['image'])):
            Storage::disk('public')->delete($old_image);
        endif;
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->delete();  //    make sure category already deleted first (category obj It still keeps the data inside it )
        //                          sometimes unexpected errors is returned when handling with sql query
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }

        // Category::where('id', '<>', $id)->delete();
        // Category::destroy($id); // $id refer to primary key of that model

        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }

    protected function uploadImage2(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;

    }

    public function trash()
    {

        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()
            ->route('dashboard.categories.trash')
            ->with('success', 'Categories restored successfully');
    }
    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        // $categories->forceDelete();
        if ($categories->forceDelete()) {
            Storage::disk('public')->delete($categories);
        }
        return redirect()
            ->route('dashboard.categories.trash')
            ->with('success', 'Categories deleted forever');
    }
}
