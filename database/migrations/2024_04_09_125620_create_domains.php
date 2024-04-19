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
        Schema::create('domains', function (Blueprint $table) {
		$table->id();
		$table->string('domain_name');
		$table->string('domain_ip');
                $table->string('domain_registrar');
                $table->timestamp('domain_created_at');
		$table->timestamp('domain_updated_at');
                $table->timestamp('domain_expires_at');
		$table->string('domain_nameserver_1');
		$table->string('domain_nameserver_2');
                $table->string('domain_verified');
                $table->string('ssl_enabled');
		$table->string('ssl_issuer');
                $table->string('ssl_common_name');
		$table->timestamp('ssl_issued_at');
		$table->timestamp('ssl_expires_at');
            	$table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
