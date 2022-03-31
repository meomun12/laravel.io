<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Categoryrequest;

class CategoryController extends Controller
{
    public function index()
    {
        // Eloquent
        // all: lay ra toan bo cac ban ghi
        $categories = Category::all();
        // get: lay ra toan bo cac ban ghi, ket hop dc cac dieu kien #
        // get se nam cuoi cung cua doan truy van
        $categoriesGet = Category::select('*')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('category.index', ['categories' => $categoriesGet]);
        // dd('Danh sach category', $categories, $categoriesGet);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        //validate 
        
        //neu co loi trong dieu kien truyen vao thif tu dong ket thuc 
        //ham va quay tro lai form kem bien $errors
        $categoryRequest = $request->all();
        $category = new Category();
        $category->name = $categoryRequest['name'];
        $category->description = $categoryRequest['description'];
        $category->status = $categoryRequest['status'];
        $category->slug = Str::slug($categoryRequest['name']);
        // use Illuminate\Support\Str;

        $category->save();

        return redirect()->route('categories.index');
    }

    public function edit(Category $id)
    {
        // Neu khong sd model binding
        // $cate = Category::find($id);
        // $id bây giờ không phải 1 số mà là đối tương Category có id = id trên param
        return view('category.create', ['category' => $id]);
    }

    public function delete(Category $cate) {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($cate->delete()) {
            return redirect()->route('categories.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        //$categoryDelete = Category::destroy($id);
        //if ($categoryDelete !== 0) {
            //return redirect()->route('categories.index');
        //}
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
    public function update( CategoryRequest $request, Category $id){
        //$cateUpdate chinh la doi tuong Category co id = $id 
        $cateUpdate = $id;
        //gan gia tri moi cho doi tuong $cateUpdate
        $cateUpdate->name = $request->name;
        $cateUpdate->description = $request->description;
        $cateUpdate->slug =  Str::slug($request->name).'-'.uniqid();
        $cateUpdate->status = $request->status;
        //thuc thi viec luu du lieu vao db 

        $cateUpdate->update();
        //quay ve danh sach 

        return redirect()->route('categoris.index');

    }
    
       

      
}
