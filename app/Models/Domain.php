<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
	use HasFactory;
   	protected $fillable = [
        'domain_friendly_name',
	'domain_name',
	'domain_ip',
	'domain_registrar',
	'domain_created_at',
	'domain_updated_at',
	'domain_expires_at',
	'domain_nameserver_1',
	'domain_nameserver_2',
	'domain_verified',
	'ssl_enabled',
	'ssl_issuer',
	'ssl_common_name',
	'ssl_issued_at',
	'ssl_expires_at',
	'favicon_url',

    ];
}
