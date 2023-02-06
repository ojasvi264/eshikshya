<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'email',
        'password',
        'admission',
        'roll',
        'category_id',
        'class_id',
        'section_id',
        'gender',
        'bloodgroup',
        'dob',
        'phone',
        'caddress',
        'paddress',
        'caste',
        'religion',
    ];
    protected $appends = ['profile_image'];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //'role' => \App\Enum\UserRoleEnum::class
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'id');
    }

    public function issue_return(){
        return $this->hasOne(LibraryMember::class, 'student_id', 'id');
    }

    public function parent(){
        return $this->hasOne(SParent::class, 'student_id', 'id');
    }
    public function homeworksubmission()
    {
        return $this->hasMany(HomeworkSubmission::class);
    }
    public function getProfileImageAttribute($value)
    {
        return $this->hasMedia() ? $this->getMedia()[0]->getFullUrl() : '/images/user-icon.jpg';
    }
    public function assign_fees(){
        return $this->hasMany(AssignFee::class);
    }
    public function assign_discounts(){
        return $this->hasMany(AssignDiscount::class);
    }
}
