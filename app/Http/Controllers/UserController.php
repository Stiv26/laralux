<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'pembeli')->get();
        return view('member.index', ['data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $data = new User();
        $data->name = $request->nama;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->memberpoint = 0;
        $data->role = "Pembeli";
    
        $data->save();
    
        return redirect()->route('member.index')->with('status', 'Member Successfully Created');
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
        $user = User::findOrFail($id);
        return view('member.edit', ['member' => $user]);
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $data = User::findOrFail($id);
        $data->name = $request->nama;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->memberpoint = 0;
        $data->role = "Pembeli";
    
        $data->save();
    
        return redirect()->route('member.index')->with('status', 'Member Successfully Created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('member.index')->with('status', 'Delete member Successful');
        }
    
        return redirect()->route('member.index')->with('status', 'Member Not Found');
    }

}
