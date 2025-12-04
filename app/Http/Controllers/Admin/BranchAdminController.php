<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;        // <-- important: import the model
use Illuminate\Http\Request;

class BranchAdminController extends Controller
{
    /**
     * List and manage branches (FR‑16).[file:1]
     */
    public function index()
    {
        $branches = Branch::orderBy('name')->get();

        return view('admin.branches', compact('branches'));
    }

    /**
     * Store a new branch (FR‑16).[file:1]
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255', 'unique:branches,name'],
            'code'    => ['required', 'string', 'max:50',  'unique:branches,code'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
        ]);

        Branch::create($data);

        return redirect()
            ->route('admin.branches')
            ->with('status', 'Branch created.');
    }

    /**
     * Update an existing branch.[file:1]
     */
    public function update(Branch $branch, Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255', 'unique:branches,name,'.$branch->id],
            'code'      => ['required', 'string', 'max:50',  'unique:branches,code,'.$branch->id],
            'address'   => ['nullable', 'string', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:50'],
            'is_active' => ['required', 'boolean'],
        ]);

        $branch->update($data);

        return redirect()
            ->route('admin.branches')
            ->with('status', 'Branch updated.');
    }
}
