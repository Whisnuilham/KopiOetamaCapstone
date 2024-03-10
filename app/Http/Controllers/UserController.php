<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::paginate(10);
        return view('pages.users')->with([
            'users'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'name'=>'required',
            'email'=>'required',
        ]);

        User::find($id)->update ([
            'name'=>$request->name,
            'email'=>$request->email,
            'jabatan'=>$request->jabatan,

        ]);
            if($request-> password !=''){
                User::find($id)->update ([
                    'password'=>Hash::make($request->password)
                ]);
            }
        return redirect()->back()->with('success','User berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //
         User::find($id)->delete();
         return redirect()->back()->with('success','User berhasil di hapus');
    }
}
