<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Support\Facades\Log;

class CityImport implements ToModel,
    WithUpserts,
    WithBatchInserts,
    WithHeadingRow,
    WithChunkReading,
    WithValidation
{

    public function model(array $row)
    {
        $timezoneOffset = intval(str_replace('UTC+', '', $row['timezone']));

        $regionTaxOffice = intdiv(intval($row['tax_office']), 100) * 100;
        $parentRegion = Region::taxOffice($regionTaxOffice)->first();

        if (!$parentRegion) {
            Log::debug('Skip city in tax_office: ' . $row['tax_office'], [
                'row_city' => $row['city'],
                'row_settlement' => $row['settlement'],
                'parentRegion' => $parentRegion->id
            ]);
            return null;
        }

        $cityType = $row['settlement_type'] ?? $row['city_type'] ?? $row['region_type'] ?? null;
        $cityName = $row['city'] ?? $row['region'] ?? $row['settlement'] ?? null ;

        return new City([
            'region_id' => $parentRegion->id,
            'tax_office' => $row['tax_office'],
            'type' => $cityType,
            'name' => $cityName,
            'full_name' => $row['address'],
            'postal_code' => $row['postal_code'],
            'fias_id' => $row['fias_id'],
            'geo_lat' => $row['geo_lat'],
            'geo_lon' => $row['geo_lon'],
            'federal_district' => $row['federal_district'],
            'foundation_year' => $row['foundation_year'],
            'timezone_offset' => $timezoneOffset,
        ]);
    }

    public function rules(): array
    {
        return [
            'fias_id' => ['required'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 250;
    }

    public function uniqueBy()
    {
        return 'fias_id';
    }
}
