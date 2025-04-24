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
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('profile_photo');
            $table->string('profile_name');
            $table->set('profile_division', ['Executive', 'Finance', 'Marketing', 'Product', 'Internal']);
            $table->set('profile_sub_division', ['Chief', 'PR', 'EEO', 'FAVE', 'FILE', 'LNT', 'HRD', 'RND']);
            $table->set('profile_position', ['CEO', 'CFO', 'CMO', 'CPO', 'CIO', 'Manager', 'Staff']);
            $table->set('profile_region', ['KMG', 'ALS', 'BDG', 'MLG']);
            $table->string('profile_linkedin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
