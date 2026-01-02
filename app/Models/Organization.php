<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'description',
        'type',
        'website_url',
        'contact_email',
        'contact_phone',
        'logo',
        'status',
        'created_by',
    ];

    /**
     * الفعاليات التابعة للجمعية
     */
    public function events(): HasMany
    {
        return $this->hasMany(OrganizationEvent::class, 'organization_id');
    }

    /**
     *المدير الذي أنشأ الجمعية
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class, 'created_by');
    }


    /**     * المنشئ (المدير)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Manager::class, 'created_by');
    }
}
