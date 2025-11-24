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
    $newsall = News::orderBy('created_at', 'desc')->get();
    $news = News::where('status', 1)->get();
    return view('news.index', compact('news'));
}
    /**
    * Show the form for creating a new resource.
    */
  public function create()
{
    $category = Category::all();
    return view('news.create', compact('category'));
}
public function store(Request $request)
{
    $filename = null;

    // upload ảnh
    if ($request->hasFile('image')) {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('upload', $filename, 'public');
    }

    // lưu tin
    $obj = new News();
    $obj->category_id = $request->category_id;
    $obj->user_id = Auth::check() ? Auth::user()->id : 1;
    $obj->title = $request->title;
    $obj->description = $request->description;
    $obj->content = $request->content;
    $obj->image = $filename; // luôn có biến, null nếu không có ảnh
    $obj->caption = $request->caption;
    $obj->save();

    // QUAN TRỌNG – phải return
    return redirect()->route('news')->with('success', 'Tạo tin thành công!');
}

    /**
    * Display the specified resource.
    */
    public function show($id)
    {
        $news = News::find($id);
        $name = User::find($news->user_id)->name;
        return view('news.detail', compact('news', 'name'));
    }
    /**
    * Show the form for editing the specified resource.
    */
    public function edit($id)
    {
        $category = Category::all();
        $news = News::find($id);
        return view('news.edit', compact('category', 'news'));
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

    $filename = $obj->image;

    if ($request->hasFile('image')) {

        // Xóa ảnh cũ
        if (!empty($obj->image)) {
            Storage::disk('public')->delete('upload/' . $obj->image);
        }

        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('upload', $filename, 'public');
    }

    // 3. Cập nhật dữ liệu
    $obj->category_id = $request->category_id;
    $obj->user_id = Auth::check() ? Auth::user()->id : 1;
    $obj->title = $request->title;
    $obj->description = $request->description;
    $obj->content = $request->content;
    $obj->image = $filename;   // luôn update vào DB
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
        if (!empty($obj->image)) {
            Storage::disk('public')->delete($obj->image);
        }
        return redirect()->route('news');
    }
    public function destroyduyet($id)
    {
        $obj = News::find($id);
        $obj-> delete();
        // xóa hình ảnh của bản tin
        if (!empty($obj->image)) {
            Storage::disk('public')->delete($obj->image);
        }
        return redirect()->route('tinchuaduyet');
    }
    public function main()
    {
        // Lấy 20 tin mới nhất
    $newsall = News::orderBy('created_at', 'desc')->get();
    $news = News::where('status', 1)->get();
    return view('main', compact('news'));
    }
    public function tintucchude($idchude){
    $query = News::orderBy('created_at', 'desc');
    if ($idchude) {
        $query->where('category_id', $idchude);
    }
    $news = $query->take(20)->get();
    $categories = Category::all();
    return view('tintucchude', compact('news', 'categories', 'idchude'));
    }
    public function duyettin($idnews)
{
    $updated = News::where('id', $idnews)
                ->update(['status' => 1]);

    if ($updated) {
        return redirect()->back()->with('success', 'Duyệt tin thành công!');
    }
    return redirect()->back()->with('error', 'Tin không tồn tại hoặc đã duyệt!');
}

    public function chitiet($id)
{
    $news = News::with(['comments'])->findOrFail($id);
    return view('trangtinchitiet', compact('news'));
}
    public function search(Request $request)
{
    $keyword = $request->input('keyword');

    if (auth()->check() && $keyword) {
        \App\Models\Search::create([
            'user_id' => auth()->id(),
            'keyword' => $keyword,
        ]);
    }

    $news = News::where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%")
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
    return view('search_news', compact('news', 'keyword'));
}

}
