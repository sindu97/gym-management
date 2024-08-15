<?php

namespace Database\Seeders;

use App\Models\PlanType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): bool
    {

        $defaultPlans = [
            [
                'name' => 'yearly',
                'slug' => Str::snake('half_yearly')
            ],
            [
                'name' => 'half_yearly',
                'slug' => Str::snake('half_yearly')
            ],
            [
                'name' => 'quaterly',
                'slug' => Str::snake('quaterly')
            ],
            [
                'name' => 'two_months',
                'slug' => Str::snake('two_months')
            ],
            [
                'name' => 'monthly',
                'slug' => Str::snake('monthly')
            ],
            [
                'name' => 'custom',
                'slug' => Str::snake('custom')
            ]
        ];

        foreach ($defaultPlans as $plan) {

            PlanType::updateOrCreate(
                ['slug' => $plan['slug']], // condition to check
                $plan // values to update or create
            );
        }
        return true;
    }
}
