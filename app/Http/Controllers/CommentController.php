<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {

    }
    public function main()
    {
        $comments = Comment::with(['User', 'News'])->where('status', 1)->get();
        return view('comments.index', compact('comments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, $news_id)
{
    $request->validate(['content' => 'required|string|max:1000']);

    $news = News::findOrFail($news_id);
    $user = Auth::user();

    $comment = Comment::create([
        'new_id' => $news->id,
        'user_id' => $user ? $user->id : 1,
        'email' => $user ? $user->email : null,
        'content' => $request->content,
        'status' => 0
    ]);

return response()->json([
    'success' => true,
    'content' => $comment->content,
    'user_name' => $user->name,
    'created_at' => $comment->created_at->format('d/m/Y H:i')
]);
}
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $obj = Comment::find($id);
        $obj-> delete();
        return redirect()->back()->with('success', 'Xóa bình luận thành công!');
    }
        public function duyet($id)
{
    $updated = Comment::where('id', $id)
                ->update(['status' => 1]);

    if ($updated) {
        return redirect()->back()->with('success', 'Duyệt bình luận thành công!');
    }
    return redirect()->back()->with('error', 'bình luận không tồn tại hoặc đã duyệt!');
}
}
