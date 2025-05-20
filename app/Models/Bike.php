<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Bike extends Model
{
    /** @use HasFactory<\Database\Factories\BikeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'year',
        'price',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'meta_image',
        'status',
    ];

    protected static function booted()
    {
        static::created(function (Bike $bike) {
            $defaultSpecs = [
                20 => 'τετραβάλβιδος, Τετράχρονος, Υγρόψυκτος, 2EEK',
                21 => '689 κ.εκ.',
                22 => '80,0 χλστ. x 68,6 χλστ.',
                23 => '11.5:1',
                24 => '54 kW στις 9.000 σ.α.λ.',
                25 => '68 Nm στις 6.500 σ.α.λ.',
                26 => 'Υγρό κάρτερ',
                27 => 'Υγρός, Πολύδισκος',
                28 => 'TCI',
                29 => 'Ηλεκτρική μίζα',
                30 => 'Μόνιμης εμπλοκής, 6 ταχυτήτων',
                31 => 'Αλυσίδα',
                32 => '4,3 λ./100 χλμ.',
                33 => '100 γρ./χλμ.',
                34 => 'Ηλεκτρονικός ψεκασμός καυσίμου',
                35 => 'διπλός σκελετός, Χαλύβδινος σωλήνας',
                36 => '27º',
                37 => '105 χλστ.',
                38 => 'Ανεστραμμένο τηλεσκοπικό πιρούνι',
                39 => 'ανάρτηση με μοχλικό, Ψαλίδι',
                40 => '230 χλστ.',
                41 => '220 χλστ.',
                42 => 'Διπλό υδραυλικό δισκόφρενο, Ø 282 χλστ.',
                43 => 'Μονό υδραυλικό δισκόφρενο, Ø 245 χλστ.',
                44 => '90/90 - 21 M/C 54V',
                45 => '150/70 R 18 M/C 70V M+S',
            ];

            $now = now();

            $specsToInsert = [];

            foreach ($defaultSpecs as $specId => $value) {
                $specsToInsert[] = [
                    'bike_id' => $bike->id,
                    'spec_id' => $specId,
                    'value' => $value,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('bike_spec_values')->insert($specsToInsert);
        });
    }

    public function brand()
    {
        return $this->belongsTo(MotoBrand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(MotoCategory::class, 'category_id');
    }

    public function specValues()
    {
        return $this->hasMany(\App\Models\BikeSpecValue::class, 'bike_id');
    }
}
