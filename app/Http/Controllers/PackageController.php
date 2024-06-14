<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('packages.index', [
            'packages' => Package::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }

        $request->validate([
            'name' => ['required','string', 'min:2', 'unique:packages,name'],
            'validity' => ['required','integer', 'min:1'],
            'price' => ['required','numeric', 'min:0'],
            'status' => ['required','in:Active,Inactive']
        ]);

        Package::create([
            'name' => $request->name,
            'validity' => $request->validity,
            'price' => $request->price,
            'is_active' => $request->status == 'Active' ? 1 : 0
        ]);

        return to_route('packages.index')->with('success_message', 'Package saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('packages.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('packages.edit', [
            'package' => Package::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }

        $request->validate([
            'name' => ['required','string', 'min:2', 'unique:packages,name,'.$id],
            'validity' => ['required','integer', 'min:1'],
            'price' => ['required','numeric', 'min:0'],
            'status' => ['required','in:Active,Inactive']
        ]);

        $package = Package::findOrFail($id);

        $package->name =  $request->name;
        $package->validity = $request->validity;
        $package->price = $request->price;
        $package->is_active = $request->status == 'Active' ? 1 : 0;

        $package->save();

        return to_route('packages.index')->with('success_message', 'Update saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }

        $package = Package::findOrFail($id);

        if($package->orders->count() > 0)
        {
            return  back()->with('error_message', 'This package cannot be deleted because it has linked resources.');
        }

        $package->delete();
        return to_route('packages.index')->with('success_message', 'Deleted successfully');
    }
}
