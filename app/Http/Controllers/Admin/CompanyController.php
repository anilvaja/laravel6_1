<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $company = Company::where('title', 'LIKE', "%$keyword%")
                ->orWhere('desc', 'LIKE', "%$keyword%")
                ->orWhere('contact_no', 'LIKE', "%$keyword%")
                ->orWhere('alt_contact_no', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('gst_no', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $company = Company::latest()->paginate($perPage);
        }

        return view('admin.company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'title' => 'required',
			'desc' => 'required',
			'contact_no' => 'required',
			'email' => 'required'
		]);
        $requestData = $request->all();
        
        Company::create($requestData);

        return redirect('admin/company')->with('flash_message', 'Company added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'title' => 'required',
			'desc' => 'required',
			'contact_no' => 'required',
			'email' => 'required'
		]);
        $requestData = $request->all();
        
        $company = Company::findOrFail($id);
        $company->update($requestData);

        return redirect('admin/company')->with('flash_message', 'Company updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Company::destroy($id);

        return redirect('admin/company')->with('flash_message', 'Company deleted!');
    }
}
