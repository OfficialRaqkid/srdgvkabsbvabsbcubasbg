<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;
use App\Models\Clearance;

class ClearanceApprovalController extends Controller
{
    /**
     * 🏛️ BUSINESS OFFICE — (Initial Posting) View requests
     */
    public function businessOfficeIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'business_office')->get();
        return view('dashboard.business_office.clearance_requests.index', compact('requests'));
    }

    /**
     * ✅ BUSINESS OFFICE — Accept and send to Library
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
     * ⏸️ BUSINESS OFFICE — Hold
     */
    public function businessOfficeHold($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 📚 LIBRARY — View requests
     */
    public function libraryIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'library_in_charge')->get();
        return view('dashboard.library_in_charge.clearance_requests.index', compact('requests'));
    }

    public function libraryAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'dean'; // Next
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
        $dean = auth()->user();
        $departmentId = $dean->department_id ?? null;

        $requests = ClearanceRequest::with(['student.program.department', 'student.yearLevel'])
            ->where('current_office', 'dean')
            ->when($departmentId, function ($query, $departmentId) {
                $query->whereHas('student.program', function ($q) use ($departmentId) {
                    $q->where('department_id', $departmentId);
                });
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
     * 🏛️ VP-SAS — View requests
     */
    public function vpSasIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'vp_sas')->get();
        return view('dashboard.vp_sas.clearance_requests.index', compact('requests'));
    }

    public function vpSasAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->current_office = 'business_office'; // 👈 Back to B.O for final sign
        $request->save();

        return redirect()->back()->with('success', 'Request approved and sent back to Business Office for final signing.');
    }

    public function vpSasHold($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold.');
    }

    /**
     * 🏁 FINAL BUSINESS OFFICE SIGNING — Completes the clearance
     */
    public function finalBusinessOfficeIndex()
    {
        $requests = ClearanceRequest::where('current_office', 'business_office')->get();
        return view('dashboard.business_office.clearance_requests.final', compact('requests'));
    }

    public function finalBusinessOfficeAccept($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'completed';
        $request->current_office = null; // ✅ Clearance completed
        $request->save();

        return redirect()->back()->with('success', 'Clearance fully completed!');
    }

    public function finalBusinessOfficeHold($id)
    {
        $request = ClearanceRequest::findOrFail($id);
        $request->status = 'held';
        $request->save();

        return redirect()->back()->with('warning', 'Request put on hold by Business Office.');
    }
}
