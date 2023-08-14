<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\User;
use App\Traits\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    use Image;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gender = User::gender_types();
        $leave_types = LeaveType::pluck('title', 'id');
        
        return view("dashboard.employees.index",compact("gender", 'leave_types'));
    }

    public function getEmployees(Request $request)
    {
    
        if ($request->ajax()) {
            $data = User::with('leaveRequests')->employees()->get();
   
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('full_name', function ($row) {
                    return $row->full_name;
                })
                ->addColumn('action', function ($row) {
                    $actions = '<div class="dropdown dropdown-inline mt-5">
                                    <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-ver"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        ';
                                
                    if ($row->leaveRequests->count()) {
                        $actions .= '<a class="dropdown-item showAllRequests" href="' . route('employee.leaveRequests.show', $row->id) . '"> <i class="fas fa-eye text-info mr-1"></i> All Requests <span class="label label-rounded label-primary ml-1">'. $row->leaveRequests->count().'</span></a>';
                    }
                                
                    $actions .= '<a class="dropdown-item editBtn" href="javascript:void(0);" data-url="' . route('employees.edit', $row->id) . '" data-employee="' . $row->id . '"><i class="fas fa-edit text-warning mr-1"></i>Edit</a>
                                    <a class="dropdown-item delBtn" href="javascript:void(0);" data-url="' . route('employees.destroy', $row->id) . '" data-employee="' . $row->id . '"> <i class="fas fa-trash-alt text-danger mr-1"></i>Delete</a>
                                </div>
                            </div>';
                    
                    return $actions;
                })
                
                
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => $row->created_at->diffForHumans(),
                    ];
                })
                ->editColumn('avatar', function ($row) {
                
                    return [
                        'display' => $row->avatar_url,
                    ];
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        
        if(is_null($request->emp_id)){
           $employee  =  new User();
           $employee->avatar = $this->storeImage($request, 'avatar', 'employees');
        }else{
            $employee  =  User::employees()->find($request->emp_id);
            $employee->avatar = $this->updateImage($request, $employee, 'avatar','employees');
        }
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->gender = $request->gender;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->phone = $request->phone;
        $employee->password = $request->password;
        $employee->save();
        return response()->json(['status'=> true, 'data'=> $employee ,'message'=> 'Success!' ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $employee)
    {   
        return response()->json([
            'status' => true,
            'data' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employee)
    {
        User::employee()->find($employee)->delete();
        
        return response()->json(['message'=> 'Deleted Successfully!', 'status' => true]);
    }
}
