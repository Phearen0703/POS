<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $data['company'] = DB::table('companies')->find(1);
        return view('backends.company.index', $data);
    }

    public function edit()
    {
        $data['company'] = DB::table('companies')->find(1);
        return view('backends.company.edit', $data);
    }
    public function update(Request $r)
    {

   
        $this->validate($r, [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [];
        $company = DB::table('companies')->find(1);

        if (!$company) {
            return redirect()->route('admin.company')->with(['status' => 'error', 'sms' => 'Company not found.']);
        }

        // Always include name (assuming it’s in the form)
        $data['name'] = $r->input('name');
        $data['email'] = $r->input('email');
        $data['phone'] = $r->input('phone');

        // Handle new photo upload
        if ($r->hasFile('photo')) {
            // Delete old photo if exists
            if ($company->photo && Storage::disk('custom')->exists($company->photo)) {
                Storage::disk('custom')->delete($company->photo);
            }

            // Save new photo to custom disk
            $path = $r->file('photo')->store('images/company', 'custom');
            $data['photo'] = $path;
        }

        // Perform update
        $updated = DB::table('companies')->where('id', 1)->update($data);

        return redirect()->route('admin.company')->with([
            'status' => $updated ? 'success' : 'error',
            'sms' => $updated ? 'Company updated successfully.' : 'Update failed.',
        ]);
    }


}
