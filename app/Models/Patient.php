<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory,SoftDeletes,HasUuids;

    protected $fillable = [
        'image',
        'old_hospital_number',
        'last_name',
        'first_name',
        'suffix',
        'alias',
        'middle_name',
        'maiden_name',
        'date_of_birth',
        'sex',
        'civil_status',
        'place_of_birth',
        'blood_type',
        'nationality',
        'if_indigenous',
        'employment_status',
        'present_region_code',
        'present_province_code',
        'present_city_code',
        'present_barangay_code',
        'present_zip_code',
        'permanent_street_number',
        'permanent_province_code',
        'permanent_city_code',
        'permanent_barangay_code',
        'permanent_zip_code',
        'contact_person_name',
        'contact_person_address',
        'contact_person_mobile_tel_number',
        'relationship',
        'spouse_last_name',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_address',
        'spouse_mobile_tel_number',
        'spouse_is_deceased',
        'fathers_last_name',
        'fathers_first_name',
        'fathers_middle_name',
        'fathers_suffix',
        'fathers_address',
        'fathers_mobile_tel_number',
        'fathers_is_deceased',
        'mothers_last_name',
        'mothers_first_name',
        'mothers_middle_name',
        'mothers_address',
        'mothers_mobile_tel_number',
        'mothers_is_deceased'
    ];
}
