<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

#[Fillable([
    'reference', 'name', 'email', 'phone', 'service', 'from_postcode', 'to_postcode',
    'property_size', 'pallets', 'distance_miles', 'move_date', 'flexible_date', 'extras', 'notes', 'status',
    'estimate_low', 'estimate_high', 'estimate', 'source',
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

    /** Where a lead came from. Website quotes arrive automatically; the rest are logged by staff. */
    public const SOURCES = [
        'website' => 'Website',
        'phone' => 'Phone call',
        'whatsapp' => 'WhatsApp',
        'email' => 'Email',
        'referral' => 'Referral',
        'repeat' => 'Repeat customer',
        'social' => 'Social media',
    ];

    /** Validation rules shared by the public quote form and the CRM. */
    public static function rules(): array
    {
        return [
            'service' => ['required', Rule::in(array_keys(config('fasttrack.services')))],
            'from_postcode' => ['required', 'string', 'max:12'],
            'to_postcode' => ['required', 'string', 'max:12'],
            'property_size' => ['required', Rule::in(array_keys(config('fasttrack.property_sizes')))],
            'pallets' => ['nullable', 'required_if:service,pallet-delivery', 'integer', 'min:1', 'max:26'],
            'move_date' => ['nullable', 'date', 'after_or_equal:today'],
            'flexible_date' => ['boolean'],
            'extras' => ['array'],
            'extras.*' => [Rule::in(array_keys(config('fasttrack.extras')))],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function casts(): array
    {
        return [
            'move_date' => 'date',
            'flexible_date' => 'boolean',
            'extras' => 'array',
            'estimate' => 'decimal:2',
            'distance_miles' => 'float',
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

    /** Filters used by the CRM list and CSV export. */
    public function scopeFilter(Builder $query, ?string $status, string $search = ''): void
    {
        $query->when($status && isset(self::STATUSES[$status]), fn ($q) => $q->where('status', $status))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(fn ($q) => $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('reference', 'like', "%$search%")
                    ->orWhere('from_postcode', 'like', "%$search%")
                    ->orWhere('to_postcode', 'like', "%$search%"));
            });
    }

    /** Other quotes from the same customer, matched on email or, failing that, phone. */
    public function relatedQuotes(): Builder
    {
        return static::query()
            ->whereKeyNot($this->id)
            ->when($this->email, fn ($q) => $q->where('email', $this->email), fn ($q) => $q->where('phone', $this->phone));
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
        if ($this->service === 'pallet-delivery' && $this->pallets) {
            return $this->pallets.' '.Str::plural('pallet', $this->pallets);
        }

        return config('fasttrack.property_sizes.'.$this->property_size, $this->property_size);
    }

    /**
     * Customer-facing progress for the Track my move page.
     *
     * @return array{steps: array<int, string>, current: int, closed: bool}
     */
    public function trackingStage(): array
    {
        $steps = ['Enquiry received', 'Quote sent', 'Booked', 'On the move', 'Completed'];
        $current = match ($this->status) {
            'new', 'contacted' => 0,
            'surveyed', 'quoted' => 1,
            'booked' => $this->move_date?->isToday() ? 3 : 2,
            'completed' => 4,
            default => 0,
        };

        return ['steps' => $steps, 'current' => $current, 'closed' => $this->status === 'lost'];
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
