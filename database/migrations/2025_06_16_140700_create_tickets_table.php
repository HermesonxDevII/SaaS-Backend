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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
                  
            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->onDelete('cascade');

            $table->foreignId('solicitation_type_id')
                  ->constrained('solicitation_types')
                  ->onDelete('cascade');
            
            $table->longText('description')->nullable();

            $table->foreignId('priority_id')
                  ->constrained('priorities')
                  ->onDelete('cascade');
            
            $table->foreignId('responsible_team_id')
                  ->constrained('responsible_teams')
                  ->onDelete('cascade');
            
            $table->longText('attachments')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
