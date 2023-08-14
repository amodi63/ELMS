<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $fillable = ['leave_type_id','start_date','end_date','status','comments','user_id'];
    protected static function booted(): void {

    
        // static::addGlobalScope(new UserScope);

    
    
    }
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
    public function employee(){
        return $this->belongsTo(User::class)->where('type', 'employee');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCommentsAttribute()
    {
        if ($this->status !== 'Deny') {
            return 'No Comments';
        }
        
        return $this->attributes['comments'];
    }
}
