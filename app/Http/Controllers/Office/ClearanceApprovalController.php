<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;
use App\Models\Clearance;

class ClearanceApprovalController extends Controller
{
    /**
     * 🏛️ BUSINESS OFFICE — View all student clearance requests
     */
    public function businessOfficeIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'business_office')->get();

        return view('dashboard.business_office.clearance_requests.index', compact('requests'));
    }

    /**
     * ✅ BUSINESS OFFICE — Accept a clearance request
     */
    public function businessOfficeAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'library_in_charge'; // Next in line
        $request->save();

        return redirect()->back()->with('success', 'Request approved and sent to Library.');
    }

    /**
     * ⏸️ BUSINESS OFFICE — Hold a clearance request
     */
    public function businessOfficeHold($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 📚 LIBRARY IN CHARGE — View requests
     */
    public function libraryIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'library_in_charge')->get();

        return view('dashboard.library.clearance_requests.index', compact('requests'));
    }

    public function libraryAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'dean'; // Next in line
        $request->save();

        return redirect()->back()->with('success', 'Request approved and sent to Dean.');
    }

    public function libraryHold($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 🎓 DEAN — View requests
     */
    public function deanIndex()
{
    $dean = auth()->user(); // logged-in dean
    $departmentId = $dean->department_id;

    // Get requests where the student's department matches the dean's department
    $requests = ClearanceRequest::where('current_office', 'dean')
        ->whereHas('studentProfile.program', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId);
        })
        ->get();

    return view('dashboard.dean.clearance_requests.index', compact('requests'));
}

public function deanAccept($id)
{
    $request = ClearanceRequest::findOrFail($id);
    $request->status = 'accepted';
    $request->current_office = 'vp_sas'; // Next in line
    $request->save();

    return redirect()->back()->with('success', 'Request approved and sent to VP-SAS.');
}

public function deanHold($id)
{
    $request = ClearanceRequest::findOrFail($id);
    $request->status = 'held';
    $request->save();

    return redirect()->back()->with('warning', 'Request put on hold.');
}


    /**
     * 🏛️ VP-SAS — Final Office
     */
    public function vpSasIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'vp_sas')->get();

        return view('dashboard.vp_sas.clearance_requests.index', compact('requests'));
    }

    public function vpSasAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'completed';
        $request->current_office = null; // End of the chain
        $request->save();

        return redirect()->back()->with('success', 'Clearance fully approved!');
    }

    public function vpSasHold($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }
}
