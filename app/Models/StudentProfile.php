<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentProfile extends Model
{
    use Notifiable;

    protected $table = 'student_profiles';

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'contact_number',
        'address',
        'program_id',
        'year_level_id',
        'profile_photo',
    ];

    // ✅ Belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ Belongs to a program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // ✅ Belongs to a year level
    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class);
    }

    // ✅ Has many clearance requests
    public function clearanceRequests()
    {
        return $this->hasMany(ClearanceRequest::class, 'student_id');
    }
}
