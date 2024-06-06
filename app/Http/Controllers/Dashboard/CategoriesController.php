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

        // $query = Category::query(); // "select * from `categories`"  // بترجع الكويرى-بيلدر تبع هذا المودل
        // if ($name = $request->query('name')) { // النايم هنا اساين وليست كومباريشن
        //     $query->where('name', 'LIKE', "%{$name}%");
        // }
        // if ($status = $request->query('status')) {
        //     $query->where('status', '=', $status); // === $query->wherestatus($status);
        // }


        // SELECT a.*, parents.name AS parent_name FROM `categories` As `a` LEFT JOIN `categories` AS `parents` ON parents.id = a.parent_id
        // استخدمت هنا "الليفت-جوين" بدل "الانر-جوين" لان الانر بترجع بيانات فقط فى حالة ان الجدولين بهم ريكورد, وتستثنى نتائج "النل" وهنا فى هذه الحالة يوجد كاتيجوريز البارينت خاصتها قيمته "نل" هنا ومع "الانر" سوف يتم استثنائه
        // اما "الليفت" سوف تقوم بإرجاع كل الجدل الاول "جدولنا الاساسى" سواء يقابله قيمة فى الجدول الثانى او لا ولا تستثنى النل
        // اما لو كان جدولنا الاساسى هو الثانى نستخدم ال "الرايت"ك
        $categories = Category::leftJoin('categories As parents', 'parents.id', '=', 'categories.parent_id')
            ->select(['categories.*', 'parents.name AS parent_name'])
            ->filter(request()->query())
            ->orderBy('categories.name')
            ->Paginate(2); // return Collection Object
        // $categories = Category::simplePaginate(1); // « Previous || Next »

        // $parents = Category::all()->pluck('name', 'id')->toArray();

        return view('dashboard.categories.index', compact('categories'/* , 'parents' */));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // عندما يحدث خطأ في رول او قاعدة ما داخل ميثود "فاليدات" في لارافيل، يحدث السيناريو التالي
        /**
         * # التأكد من صحة البيانات:ك
         *    - عند استدعاء ميثود فاليدات يقوم لارافيل بمراجعة البيانات المدخلة وفقًا للقواعد المحددة
         *   - إذا كانت البيانات المدخلة لا تتوافق مع إحدى القواعد، يعتبر ذلك خطأ في التحقق
         * # التعامل مع الأخطاء:ك
         *    - عند حدوث خطأ في التحقق، يتم توليد استثناء من نوع
         *            - ValidationException
         *    - يتم القبض على هذا الاستثناء تلقائيًا بواسطة نظام لارافيل
         * # إعادة التوجيه:ك
         *    - يتم إعادة توجيه المستخدم تلقائيًا إلى الصفحة السابقة
         *    - اللارافيل هترجعنى للصفحة السابقة مع حاجه اسمها "ويز انبتس", ودا يعنى ان اللارافيل راح تخزن الإنبت الحالى فى السيشن كافلاش, اى بشكل مؤقت فقط للنكست ريكوست بحيث نحصل على هذه القيم لو احتاجنها او للحفاظ على القيم التى ادخلها المستخدم فى الفورم
         *    - يتم تضمين بيانات الإدخال الأصلية في الجلسة بحيث يمكن إعادة تعبئة النموذج بنفس البيانات التي أدخلها المستخدم (باستثناء الحقول من نوع الملف)
         * # عرض الأخطاء:ك
         *    - يتم تخزين رسائل الأخطاء في الجلسة أيضًا، بحيث يمكن عرضها للمستخدم
         *    - يمكن الوصول إلى هذه الأخطاء في عرض "البليد" باستخدام متغير $الإيرورس.
         */
        // $clean_data = $request->validate(Category::rules()); // ميثود الفاليدات هنا برتجع البيانات التى تم فحصها واللى انا محددها, وبالتالى ليس من المفترض كامل البيانات فى الريكوست
        $request->validate(Category::rules(), [
            'required' => 'This Field(:attribute) is required',
            'unique' => 'This Field(:attribute) is Already Exists',
            'image.max' => 'الصورة التى قمت برفعهاأكبر من 2 ميجابايت' //هذا خاص بانبت تايب فايم, نايم إيميج فقط, وليس كل "ماكس" رول
        ]);
        /**
         * # Ways to Access to the data in the Request
         *     - Single Data
         *      $request->query('name');
         *      // action="{{route('categories.store')}}?name=x" -> "x" {"only URL" -> 'query string'}
         *      $request->input('name');
         *      // action="{{route('categories.store')}}?name=x" -> "x" {take from 'url' and 'post' in the same time, "but" it looks and take from 'url' first}
         *      $request->get('name');
         *      // Bring me its value, whether it is in the 'get' or 'post'
         *      $request->post('name');
         *      // take value from post request body
         *      $request->name;
         *      // The shortcut method
         *      $request['name'];
         *      // request is an object which implements "ArrayAccess" So it can be treated as an array
         *
         *     - Collection of Data
         *      $request->all();
         *      // return array of all input data
         *      $request->only(['name', 'parent_id']);
         *      // return array of keys or names which I prompted
         *      $request->except(['image']);
         *      // return array of all data except ....
         *      // we can send "get" and "post" Request in the same time with <form method='post'>
         */


        // Request Merge
        //لو اردنا اضافة داتا على الداتا ريكوست
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
        // عشان مثلا لو بعت فورم ولو بيرجعنى مثلا على نفس الصفحة ولو جت وعملت تحديث للصفحة بتظهر لى رسالة ان الفورم هذا هيتم إرساله مرة اخرى
        // لكن عند تغير الريكوست الى جت فهنا لغينا السيشن هذا واصبحت يعتبر صفحة جديده او بداية جديده
        // return redirect(route('categories.index'));
        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
        // الداتا اللى تم ارسالها من خلال الويز بتتخزن فى السيشن بصورة مؤقته وبتبقى موجوده او بتروح على النكست ريكوست وبنمسكها هناك من خلال الاسم اللى اعطيناها لها داخل ويز ميثود
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
    public function show($id)
    {
        //
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
        // OR =>
        // if (!$category) {
        //     abort(404);
        // }

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
        $category->delete(); // make sure category already deleted first (category obj It still keeps the data inside it )
        // sometimes unexpected errors is returned when handling with sql query
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
