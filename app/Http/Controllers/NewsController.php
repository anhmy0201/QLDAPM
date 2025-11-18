<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class NewsController extends Controller
{
/**
* Display a listing of the resource.
*/
public function index()
{
$news = News::orderBy('created_at', 'desc')->get();
return View('news.index', compact('news'));
}
/**
* Show the form for creating a new resource.
*/
public function create()
{
$category = Category::all();
return view('news.create', compact('category'));
}
/**
* Store a newly created resource in storage.
*/
public function store(Request $request)
{
$request->validate([
'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
]);
// upload ảnh
        $path = '';
        if($request->hasFile('image')){
            $name = $request->file('image')->getClientOriginalName(); // lấy tên file gốc
            $timestamp = now()->format('dmY_His'); // lấy chuỗi thời gian
            $filename = $timestamp . '_' . $name; // tên file mới ghép chuỗi thời gian_tên gốc
            // lưu file vào thư mục upload trên disk public (storage/app/public/upload)
            $path = $request->file('image')->storeAs('upload', $filename, 'public');
        }
// lưu tin
$obj = new News();
$obj->category_id = $request->category_id;
if (Auth::check()) {
$obj->user_id = Auth::user()->id;
} else {
$obj->user_id = 1;
}
$obj->title = $request->title;
$obj->description = $request->description;
$obj->content = $request->content;
if($path != '') $obj->image = $path;
$obj->caption = $request->caption;
$obj->save();
return redirect()->route('news');
}
/**
* Display the specified resource.
*/
public function show($id)
{
$news = News::find($id);
$name = User::find($news->user_id)->name;
return view('news.detail', compact('news','name'));
}
/**
* Show the form for editing the specified resource.
*/
public function edit($id)
{
$category = Category::all();
$news = News::find($id);
return view('news.edit', compact('category','news'));
}
/**
* Update the specified resource in storage.
*/
public function update(Request $request, $id)
{
$request->validate([
'image' => 'file|mimes:jpg,jpeg,png,gif|max:2048',
]);
$obj = News::find($id);
// upload ảnh
        $path = '';
        if($request->hasFile('image')){
            // xóa ảnh cũ
            if(!empty($obj->image)) Storage::disk('public')->delete($obj->image);
            // up ảnh mới
            $name = $request->file('image')->getClientOriginalName(); // lấy tên file gốc
            $timestamp = now()->format('dmY_His'); // lấy chuỗi thời gian
            $filename = $timestamp . '_' . $name; // tên file mới ghép chuỗi thời gian_tên gốc
            $path = $request->file('image')->storeAs('upload', $filename, 'public');
        }
// lưu tin
$obj->category_id = $request->category_id;
if (Auth::check()) {
$obj->user_id = Auth::user()->id;
} else {
$obj->user_id = 1;
}
$obj->title = $request->title;
$obj->description = $request->description;
$obj->content = $request->content;
if($path != '') $obj->image = $path;
$obj->caption = $request->caption;
$obj->save();
return redirect()->route('news');
}
/**
* Remove the specified resource from storage.
*/
public function destroy($id)
{
        $obj = News::find($id);
        $obj-> delete();
        // xóa hình ảnh của bản tin
        if(!empty($obj->image)) Storage::disk('public')->delete($obj->image);
return redirect()->route('news');
}
public function main()
{
// Lấy 20 tin mới nhất
$news = News::orderBy('created_at', 'desc')->take(20)->get();
// Trả về view riêng cho trang chủ
return view('main', compact('news'));
}
}
