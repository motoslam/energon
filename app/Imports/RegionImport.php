<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithUpserts;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;


class RegionImport implements ToModel,
    WithBatchInserts,
    WithHeadingRow,
    WithUpserts,
    WithChunkReading,
    WithValidation
{

    public function model(array $row)
    {
        $federalDistrict = $row['federal_district'];
        $explodeToken = ' -'; // пробел и тире
        $federalDistrictNamePart = strtok($federalDistrict, $explodeToken);
        $federalDistrictShortName = '';

        while ($federalDistrictNamePart !== false) {
            $federalDistrictShortName .= mb_substr($federalDistrictNamePart, 0, 1, "UTF-8");
            $federalDistrictNamePart = strtok($explodeToken);
        }

        $federalDistrictShortName .= 'ФО';

        return new Region([
            'tax_office' => $row['tax_office'],
            'name' => $row['name'],
            'full_name' => $row['name_with_type'],
            'type' => $row['type'],
            'federal_district' => $row['federal_district'],
            'fias_id' => $row['fias_id'],
            'short_fd' => $federalDistrictShortName
        ]);
    }

    public function rules(): array
    {
        return [
            'tax_office' => 'required',
            'fias_id' => 'required',
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
