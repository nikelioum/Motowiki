<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Storage;

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
        'external_url'
    ];

    protected static function booted()
    {
        static::deleting(function ($bike) {
            if ($bike->image) {
                Storage::disk('public')->delete($bike->image);
            }
        });

        static::created(function (Bike $bike) {
            $now = now();

            // spec_id => default_value (empty string or sample default)
            $defaultSpecs = [
                56 => '', // Κυβισμός (engine_capacity)
                57 => '', // Ιπποδύναμη (horsepower)
                58 => '', // Ροπή (torque)
                59 => '', // Συμπίεση (compression)
                60 => '', // Κινητήρας (engine_type)

                61 => '', // Μήκος x Πλάτος x Ύψος (dimensions)
                62 => '', // Μεταξόνιο (wheelbase)
                63 => '', // Ύψος σέλας (seat_height)
                64 => '', // Βάρος (weight)

                65 => '', // Χωρητικότητα καυσίμου (fuel_capacity)
                66 => '', // Κατανάλωση καυσίμου (fuel_consumption)

                67 => '', // Τύπος μετάδοσης (transmission_type)
                68 => '', // Τελική μετάδοση (final_drive)

                69 => '', // Τύπος πλαισίου (frame_type)
                70 => '', // Μπροστινή ανάρτηση (front_suspension)
                71 => '', // Πίσω ανάρτηση (rear_suspension)

                72 => '', // Μπροστινά φρένα (front_brakes)
                73 => '', // Πίσω φρένα (rear_brakes)
                74 => '', // Μέγεθος τροχών (wheel_size)
            ];

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
