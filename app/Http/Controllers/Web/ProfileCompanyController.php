<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCompanyRequest;
use App\Models\ProfileCompany;
use Illuminate\Http\Request;

class ProfileCompanyController extends Controller
{
    public function index()
    {
        $profileCompany = ProfileCompany::first();
        $profileCompanyCount = ProfileCompany::count();
        return view('pages.profileCompany.index', compact('profileCompany', 'profileCompanyCount'));
    }

    public function create()
    {

        $profileCompanyCount = ProfileCompany::count();
        if ($profileCompanyCount > 0) {
            return redirect()->back();
        } else {
            return view('pages.profileCompany.create');
        }
    }

    public function store(ProfileCompanyRequest $request)
    {
        ProfileCompany::create($request->validated());
        return redirect()->route('profileCompany.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $profileCompany = ProfileCompany::findOrFail($id);
        return view('pages.profileCompany.edit', compact('profileCompany'));
    }

    public function update(ProfileCompanyRequest $request, $id)
    {
        ProfileCompany::findOrFail($id)->update($request->validated());
        return redirect()->route('profileCompany.index');
    }

    public function destroy(string $id)
    {
        $profileCompany = ProfileCompany::findOrFail($id);
        $profileCompany->delete();
        return redirect()->route('profileCompany.index');
    }
}