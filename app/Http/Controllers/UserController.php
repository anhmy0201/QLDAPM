<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $user = User::with(['Comments', 'News'])->get();
        return view('user.index', compact('user'));
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
    $user = User::findOrFail($id);
    Comment::where('user_id', $id)->delete();
    News::where('user_id', $id)->delete();
    $user->delete();
    return redirect()->back()->with('success', 'Xóa người dùng và toàn bộ dữ liệu liên quan thành công!');
}

}
