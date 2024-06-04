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
        return view('staff.views.roles.index', compact('roles'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        return view('staff.views.roles.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest  $request)
    {

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $roles = Roles::create($request->validated());
    
        return redirect()->route('roles')->with('success', 'Roles added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roles = Roles::findOrFail($id);
  
        return view('staff.views.roles.show', compact('roles'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Roles::findOrFail($id);
  
        return view('staff.views.roles.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolesRequest $request, string $id)
    {
        $roles = Roles::findOrFail($id);

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $roles->update($request->validated());
  
        return redirect()->route('roles')->with('success', 'Roles updated successfully');
    }

     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $id)
    {
        $roles = Roles::findOrFail($id);
    
        $roles->delete();
    
        return redirect()->route('roles')->with('success', 'Roles archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archived = Roles::onlyTrashed()->get();
    
        return view('staff.views.roles.restore', ['archived' => $archived]);
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $id)
    {
        $roles = Roles::withTrashed()->findOrFail($id);
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

        Roles::whereIn('id', $selected)->restore();

        return redirect()->back()->with('success', 'Roles restored successfully');
    }

    public function destroyForever(Request $request, string $id)
    {
        try {
            $roles = Roles::withTrashed()->findOrFail($id);
            
            // Perform force delete
            $roles->forceDelete();
            
            return redirect()->route('roles')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('roles')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('roles')->with('error', 'Failed to delete');
        }
    }
}
