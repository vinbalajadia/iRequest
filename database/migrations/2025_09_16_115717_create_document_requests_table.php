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
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->foreignId('student_id')->constrained();
            $table->enum('document_type', ['Transcript of Records', 'Diploma', 'Certificate of Enrollment', 'Good Moral Certificate', 'Clearance', 'Others']);
            $table->text('purpose');
            $table->enum('status', ['pending', 'processing', 'approved', 'ready_for_pickup', 'rejected', 'completed'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_requests');
    }
};
