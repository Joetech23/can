<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'reference', 'name', 'email', 'phone', 'service', 'from_postcode', 'to_postcode',
    'property_size', 'move_date', 'flexible_date', 'extras', 'notes', 'status', 'estimate', 'source',
])]
class Quote extends Model
{
    use HasFactory;

    /** Pipeline stages in order, with their badge colours. */
    public const STATUSES = [
        'new' => ['label' => 'New', 'tone' => 'sky'],
        'contacted' => ['label' => 'Contacted', 'tone' => 'violet'],
        'surveyed' => ['label' => 'Surveyed', 'tone' => 'amber'],
        'quoted' => ['label' => 'Quote sent', 'tone' => 'orange'],
        'booked' => ['label' => 'Booked', 'tone' => 'go'],
        'completed' => ['label' => 'Completed', 'tone' => 'emerald'],
        'lost' => ['label' => 'Lost', 'tone' => 'slate'],
    ];

    public const OPEN = ['new', 'contacted', 'surveyed', 'quoted'];

    protected function casts(): array
    {
        return [
            'move_date' => 'date',
            'flexible_date' => 'boolean',
            'extras' => 'array',
            'estimate' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        // References are derived from the row id so they can never collide.
        static::creating(function (Quote $quote) {
            $quote->reference ??= 'tmp-'.Str::uuid();
        });
        static::created(function (Quote $quote) {
            if (str_starts_with($quote->reference, 'tmp-')) {
                $quote->updateQuietly(['reference' => 'FT-'.($quote->id + 2400)]);
            }
        });
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->latest()->latest('id');
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status]['label'] ?? ucfirst($this->status);
    }

    /** Position in the pipeline as a percentage, for progress bars. */
    public function progress(): int
    {
        if ($this->status === 'lost') {
            return 0;
        }
        $keys = array_keys(array_diff_key(self::STATUSES, ['lost' => 1]));

        return (int) round((array_search($this->status, $keys) + 1) / count($keys) * 100);
    }

    public function sizeLabel(): string
    {
        return config('fasttrack.property_sizes.'.$this->property_size, $this->property_size);
    }

    public function serviceLabel(): string
    {
        return config('fasttrack.services.'.$this->service.'.name', $this->service);
    }

    public function initials(): string
    {
        return collect(explode(' ', $this->name))->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');
    }
}
