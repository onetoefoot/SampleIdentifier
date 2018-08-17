<?php

namespace Onetoefoot\Sampleidentifier\Models;

use Illuminate\Database\Eloquent\Model;

class SiRecord extends Model
{
    protected $table = 'si_records';

    protected $fillable = [
        'user_id',
        'identifier',
        'sample',
        'session',
        'created_at',
        'updated_at'
    ];
}
