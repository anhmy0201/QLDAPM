<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\Search;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $search = Search::with(['User'])->get();
        return view('search.index', compact('search'));
    }
    public function main()
    {

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $search=Search::find($id);
    $keyword=$search->keyword;
    $news = News::where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%")
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
    return view('search_news', compact('news', 'keyword'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit($id)
{
    $user = User::findOrFail($id); // luôn trả về 1 model
    return view('user.edit', compact('user'));
}
   public function update(Request $request, $id)
{
    $request->validate([
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $user=User::find($id);
    $filename=$user->avatar;
    if ($request->hasFile('avatar')) {

        // Xóa ảnh cũ
        if (!empty($obj->avatar)) {
            Storage::disk('public')->delete('upload/' . $obj->image);
        }

        $filename = $request->file('avatar')->getClientOriginalName();
        $request->file('avatar')->storeAs('upload', $filename, 'public');
    }
    $user->avatar= $filename;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->bio = $request->bio;
    $user->save();
    return redirect()->route('user.detail', $user->id)
                     ->with('success', 'Cập nhật hồ sơ thành công!');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $search = Search::findOrFail($id);
    $search->delete();
    return redirect()->back()->with('success', 'Xóa từ khóa thành công!');
}

}
