<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequestRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Scopes\UserScope;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class LeaveRequestController extends Controller
{
    public function index()
    {
        return view('dashboard.leave-requests.index');
    }
    public function store(LeaveRequestRequest $request) {
        if (!is_null($request->leave_request_id)) {
            $leave_request = LeaveRequest::find($request->leave_request_id);
    
            if (!$leave_request) {
                return response()->json(['message' => 'Leave request not found!', 'status' => false]);
            }
    
            if ($leave_request->status !== 'Pending') {
                return response()->json(['message' => 'You can only update pending leave requests.', 'status' => false]);
            }
    
            $leave_request->update($request->all());
        } else {
            if (LeaveRequest::where('user_id', $request->user_id)->where('status', 'Pending')->exists()) {
                return response()->json(['message' => 'You have requests under review!', 'status' => false]);
            }
    
            $leave_request = LeaveRequest::create($request->all());
        }
    
        return response()->json(['data' => $leave_request, 'message' => 'Your Request Sent Successfully!', 'status' => true]);
    }
    

    public function edit(User $employee, LeaveRequest $leave_request)
    {

        return response()->json([
            'status' => true,
            'data' => $leave_request
        ]);
    }
    public function show($employee = null)
    {
        if ($employee) {
            $employee = User::find($employee);
            if ($employee) {
                $leave_types = LeaveType::pluck('title', 'id');
                return view('dashboard.employees.leaveRequests', compact('employee', 'leave_types'));
            }
        }

        return view('dashboard.employees.leaveRequests');
    }


    public function getEmployeeRequest(Request $request)
    {
        if ($request->ajax()) {

            $emp_id = $request->route('employee');

            if ($emp_id) {
                $data = LeaveRequest::with(['leaveType'])->where('user_id', $emp_id)->get();
            } else {
                $data = LeaveRequest::with(['leaveType', 'user'])->get();
            }

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('employee_name', function ($row) {
                    return $row->user->full_name;
                })
                ->addColumn('diff_of_nums', function ($row) {
                    return $row->CalculateDateDifferenceInDays($row->start_date,$row->end_date) . " Days";
                })
                ->addColumn('action', function ($row) {
                    $actions = '<div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-ver"></i>
                                    </button>
                                    <div class="dropdown-menu">';

                    if (auth()->user()->type === 'admin') {
                        if ($row->status !== 'Approved') {
                            $actions .= '<a class="dropdown-item changeLeaveRequestStatus" data-action="Approved" href="javascript:void(0);" data-leave-request-id="' . $row->id . '" data-leave-request="' . $row->id . '" data-url="' . route('employee.leaveRequests.changeLeaveRequestStatus') . '"><i class="far fa-check-circle text-success mr-1"></i> Approve</a>';
                        }
                        if ($row->status !== 'Deny') {
                            $actions .= '<a class="dropdown-item changeLeaveRequestStatus" data-action="Deny" href="javascript:void(0);" data-leave-request-id="' . $row->id . '" data-url="' . route('employee.leaveRequests.changeLeaveRequestStatus') . '" ><i class="far fa-times-circle text-danger mr-1"></i> Deny</a>';
                        }
                    }
                    if($row->status == 'Pending' && auth()->user()->type === 'employee'){
                        $actions .= '<a class="dropdown-item editRequestBtn" href="javascript:void(0);" data-url="' . route('employee.leave-request.edit', [$row->user_id, $row->id]) . '" data-leave-request-id="' . $row->id . '"><i class="fas fa-edit text-warning mr-1"></i>Edit</a>';

                    }
                    $actions .= '<a class="dropdown-item delRequestBtn" href="javascript:void(0);" data-url="' . route('employee.leave-request.destroy', [$row->user_id, $row->id]) . '" data-leave-request-id="' . $row->id . '"> <i class="fas fa-trash-alt text-danger mr-1"></i>Delete</a>
                                </div>
                            </div>';

                    return $actions;
                })
              


                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => $row->created_at->diffForHumans(),
                    ];
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Change leaveRequest Status
     */
    public function changeLeaveRequestStatus(Request $request)
    {

        $request->validate([
            'leaveRequest' => ['required', Rule::exists('leave_requests', 'id')],
            'action' => ['required', 'in:Approved,Deny'],
            "comments" => ['required_if:action,Deny', 'string']
        ]);
        $leaveRequest = LeaveRequest::findOrFail($request->leaveRequest);

        $newStatus = null;

        switch ($request->action) {
            case 'Approved':
                $newStatus = 'Approved';
                break;
            case 'Deny':
                $newStatus = 'Deny';
                $leaveRequest->comments = $request->comments;
                break;
        }

        if ($newStatus !== null) {
            $leaveRequest->status = $newStatus;
            $leaveRequest->save();

            return response()->json([
                'message' => "Leave Request $newStatus Successfully!",
                'status' => true
            ]);
        }

        return response()->json([
            'message' => 'Invalid action provided.',
            'status' => false
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $leave_request =  LeaveRequest::find($request->leaveRequest)->delete();
        if ($leave_request) {

            return response()->json(['message' => 'Deleted Successfully!', 'status' => true]);
        }
    }
}
