<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('image')->nullable();
            $table->string('old_hospital_number')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('suffix')->nullable();
            $table->string('alias')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('maiden_name')->nullable();
            $table->date('date_of_birth');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('place_of_birth')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('nationality')->nullable();
            $table->string('if_indigenous')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('present_region_code');
            $table->string('present_province_code');
            $table->string('present_city_code');
            $table->string('present_barangay_code');
            $table->string('present_zip_code')->nullable();
            $table->string('permanent_street_number');
            $table->string('permanent_province_code');
            $table->string('permanent_city_code');
            $table->string('permanent_barangay_code');
            $table->string('permanent_zip_code')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_address')->nullable();
            $table->string('contact_person_mobile_tel_number')->nullable();
            $table->string('relationship')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_address')->nullable();
            $table->string('spouse_mobile_tel_number')->nullable();
            $table->string('spouse_is_deceased')->nullable();
            $table->string('fathers_last_name')->nullable();
            $table->string('fathers_first_name')->nullable();
            $table->string('fathers_middle_name')->nullable();
            $table->string('fathers_suffix')->nullable();
            $table->string('fathers_address')->nullable();
            $table->string('fathers_mobile_tel_number')->nullable();
            $table->string('fathers_is_deceased')->nullable();
            $table->string('mothers_last_name')->nullable();
            $table->string('mothers_first_name')->nullable();
            $table->string('mothers_middle_name')->nullable();
            $table->string('mothers_address')->nullable();
            $table->string('mothers_mobile_tel_number')->nullable();
            $table->string('mothers_is_deceased')->nullable();
          

            $table->softDeletes();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
