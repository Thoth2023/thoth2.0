<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    use HasFactory;
    protected $table = 'activity_log';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = [
        'activity',
        'id_module',
        'id_project',
        'id_user',
        'time'
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }
}
