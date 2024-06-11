<?php

namespace Smarg2847\SecureCode\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecureCode extends Model
{

    protected $table = 'secure_codes';

    protected $fillable = [
        'code',
        'module',
        'module_record',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reset(): self
    {
        $this->update([
            'module' => null,
            'module_record' => null,
            'updated_at' => now(),
        ]);

        return $this->fresh();
    }

    public function assign(string $moduleRecord): self
    {
        $this->update([
            'module' => 'User', 
            'module_record' => $moduleRecord,
            'updated_at' => now(),
        ]);

        return $this->fresh();
    }

}