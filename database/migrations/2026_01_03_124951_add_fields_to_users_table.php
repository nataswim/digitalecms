<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->string('first_name')->after('email');
            $table->string('last_name')->after('first_name');
            $table->string('avatar')->nullable()->after('password');
            $table->string('phone', 20)->nullable()->after('avatar');
            $table->text('bio')->nullable()->after('phone');
            $table->string('email_verification_token')->nullable()->after('email_verified_at');
            $table->ipAddress('last_ip')->nullable()->after('email_verification_token');
            $table->timestamp('last_login_at')->nullable()->after('last_ip');
            $table->foreignId('role_id')->nullable()->after('last_login_at')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'username',
                'first_name',
                'last_name',
                'avatar',
                'phone',
                'bio',
                'email_verification_token',
                'last_ip',
                'last_login_at',
                'role_id',
            ]);
        });
    }
};