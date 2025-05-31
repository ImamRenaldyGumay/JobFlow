<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('jobs')->orderBy('name')->get();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies',
            'website' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        Company::create($validated);
        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    public function show(Company $company)
    {
        $company->load('jobs');
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'website' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($validated);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}