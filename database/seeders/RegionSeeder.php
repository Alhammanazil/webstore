<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Http;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Clear existing regions
            Region::truncate();
            $this->command->info('Cleared existing regions...');

            // Province
            $this->command->info('Fetching Province Data...');
            $response = Http::timeout(30)->get('https://wilayah.id/api/provinces.json');
            $provinces = $response->json('data') ?? [];

            if (empty($provinces)) {
                $this->command->error('Failed to fetch province data');
                return;
            }

            foreach ($provinces as $province) {
                Region::create([
                    'code' => data_get($province, 'code'),
                    'name' => data_get($province, 'name'),
                    'type' => 'province',
                    'parent_code' => null,
                ]);

                $this->seedRegencies($province);
            }

            $this->command->info('Region seeding completed successfully!');
        } catch (\Exception $e) {
            $this->command->error('Error during seeding: ' . $e->getMessage());
        }
    }

    private function seedRegencies($province): void
    {
        try {
            $provinceCode = data_get($province, 'code');
            $provinceName = data_get($province, 'name');

            $response = Http::timeout(30)->get("https://wilayah.id/api/regency/{$provinceCode}.json");
            $regencies = $response->json('data') ?? [];

            if (empty($regencies)) {
                $this->command->warn("No regency data found for: {$provinceName}");
                return;
            }

            foreach ($regencies as $regency) {
                Region::create([
                    'code' => data_get($regency, 'code'),
                    'name' => data_get($regency, 'name'),
                    'type' => 'regency',
                    'parent_code' => $provinceCode,
                ]);

                $this->seedDistricts($regency);
            }
        } catch (\Exception $e) {
            $this->command->warn("Error fetching regencies: " . $e->getMessage());
        }
    }

    private function seedDistricts($regency): void
    {
        try {
            $regencyCode = data_get($regency, 'code');
            $regencyName = data_get($regency, 'name');

            $response = Http::timeout(30)->get("https://wilayah.id/api/districts/{$regencyCode}.json");
            $districts = $response->json('data') ?? [];

            if (empty($districts)) {
                $this->command->warn("No district data found for: {$regencyName}");
                return;
            }

            foreach ($districts as $district) {
                Region::create([
                    'code' => data_get($district, 'code'),
                    'name' => data_get($district, 'name'),
                    'type' => 'district',
                    'parent_code' => $regencyCode,
                ]);

                $this->seedVillages($district);
            }
        } catch (\Exception $e) {
            $this->command->warn("Error fetching districts: " . $e->getMessage());
        }
    }

    private function seedVillages($district): void
    {
        try {
            $districtCode = data_get($district, 'code');

            $response = Http::timeout(30)->get("https://wilayah.id/api/villages/{$districtCode}.json");
            $villages = $response->json('data') ?? [];

            if (empty($villages)) {
                return;
            }

            foreach ($villages as $village) {
                Region::create([
                    'code' => data_get($village, 'code'),
                    'name' => data_get($village, 'name'),
                    'type' => 'village',
                    'postal_code' => data_get($village, 'postal_code'),
                    'parent_code' => $districtCode,
                ]);
            }
        } catch (\Exception $e) {
            $this->command->warn("Error fetching villages: " . $e->getMessage());
        }
    }
}
