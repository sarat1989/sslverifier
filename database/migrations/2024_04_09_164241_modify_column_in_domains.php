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
        Schema::table('domains', function (Blueprint $table) {
		$table->string('domain_ip')->nullable()->change();
                $table->string('domain_registrar')->nullable()->change();
                $table->timestamp('domain_created_at')->nullable()->change();
		$table->timestamp('domain_updated_at')->nullable()->change();
                $table->timestamp('domain_expires_at')->nullable()->change();
		$table->string('domain_nameserver_1')->nullable()->change();
		$table->string('domain_nameserver_2')->nullable()->change();
                $table->string('domain_verified')->nullable()->change();
                $table->string('ssl_enabled')->nullable()->change();
		$table->string('ssl_issuer')->nullable()->change();
                $table->string('ssl_common_name')->nullable()->change();
		$table->timestamp('ssl_issued_at')->nullable()->change();
		$table->timestamp('ssl_expires_at')->nullable()->change();
            	$table->timestamp('created_at')->nullable()->change();		
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domains', function (Blueprint $table) {
            //
        });
    }
};
