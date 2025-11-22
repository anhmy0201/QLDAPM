public function upload(Request $request) {
    $request->validate([
        'upload' => 'required|image|max:2048'
    ]);

    $path = $request->file('upload')->store('public/images');
    $url = asset(str_replace('public/', 'storage/', $path));

    return response()->json([
        'url' => $url
    ]);
}
