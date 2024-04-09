<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Roles;

use App\Http\Requests\Roles\StoreRolesRequest;
use App\Http\Requests\Roles\UpdateRolesRequest;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $roles = Roles::orderBy('created_at', 'DESC')->get();
        return view('roles.index', compact('roles'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        // Retrieve the highest roleID from the database
        $highest = DB::table('roles')->select('roleID')->orderBy('roleID', 'desc')->first();
        // Determine the next roleID value
        $nextID = $highest ? intval(substr($highest->roleID, 4)) + 1 : 1;
        // Pad the nextID with zeros to ensure consistent formatting
        $roleID = "role" . str_pad($nextID, 3, '0', STR_PAD_LEFT);
        // Pass the roleID to the create view
        return view('roles.create', compact('roleID'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest  $request)
    {
        $roles = Roles::create($request->validated());
    
        return redirect()->route('roles')->with('success', 'Roles added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $roleID)
    {
        $roles = Roles::findOrFail($roleID);
  
        return view('roles.show', compact('roles'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $roleID)
    {
        $roles = Roles::findOrFail($roleID);
  
        return view('roles.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolesRequest $request, string $roleID)
    {
        $roles = Roles::findOrFail($roleID);

        $roles->update($request->validated());
  
        return redirect()->route('roles')->with('success', 'Roles updated successfully');
    }

     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $roleID)
    {
        $roles = Roles::findOrFail($roleID);
    
        $roles->delete();
    
        return redirect()->route('roles')->with('success', 'Roles archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archived = Roles::onlyTrashed()->get();
    
        return view('roles.restore', ['archived' => $archived]);
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $roleID)
    {
        $roles = Roles::withTrashed()->findOrFail($roleID);
        $roles->restore();
    
        return redirect()->back()->with('success', 'Roles restored successfully');
    }    
    
    /**
     * Multiple archiving.
     */
    public function destroyMultiple(Request $request)
    {
        $selected = $request->input('selected', []);
    
        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one roles to archive.');
        }    
        Roles::destroy($selected);
    
        return redirect()->back()->with('success', 'Multiple Roles Archived successfully');
    }

    /**
     * Multiple un-archiving.
     */
    public function unarchiveMultiple(Request $request)
    {
        $selected = $request->input('selected', []);

        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one roles to restore.');
        }

        Roles::whereIn('roleID', $selected)->restore();

        return redirect()->back()->with('success', 'Roles restored successfully');
    }

    
}
