<?php

namespace App\Http\Controllers\Todo;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_tampil = 4;
        
        if(request("search")){
            $data = Todo::where('task','like','%'.request("search").'%')->paginate($max_tampil)->withQueryString();
        }
        else{
            $data = Todo::orderBy('task','asc')->paginate($max_tampil)->withQueryString();
        }
        return view('todo.app',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //untuk menampilkan form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //untuk melakukan penyimpanan data
        // dd($request);
        $request->validate([
            'task' => 'required|min:3|max:50'
        ],[
            'task.required' => 'Task harus diisi',
            'task.min' => 'Task minimal 3 karakter',
            'task.max' => 'Task maximal 3 karakter'
        ]);


        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);
        return redirect()->route('todo')->with('success',"Berhasil memasukkan data");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'task' => 'required|min:3|max:50'
        ],[
            'task.required' => 'Task harus diisi',
            'task.min' => 'Task minimal 3 karakter',
            'task.max' => 'Task maximal 3 karakter'
        ]);


        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done'),
        ];

        Todo::where('task', $id)->update($data);
        return redirect()->route('todo')->with('success',"Berhasil mengedit data");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success',"Berhasil menghapus data");
    }
}
