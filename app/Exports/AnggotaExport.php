<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AnggotaExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $columns;

    public function __construct($columns) {
        $this->columns = $columns;
    }

    public function query()
    {
        return Anggota::query();
    }

    public function headings(): array
    {
        return $this->columns;
    }
    /**
     * $provName = $anggota['province']['name']
     * 
     * $tmpData =  $anggota['province'];
     * $tmpData = $tmpData['name];
     * $provName = $tmpData
    * @return \Illuminate\Support\Collection 
    */
    
    public function map($anggota): array
    {
        $data = [];

        foreach ($this->columns AS $column) {
            if (str_contains($column,'.')) {
                $fields = explode('.', $column);
                $tmpData = $anggota;
                foreach ($fields as $field) {
                    $tmpData = $tmpData[$field];
                }

                $data[] = $tmpData;
            } else {
                $data[] = $anggota[$column];
            }
        }

        return $data;
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'A' => DataType::TYPE_STRING,
    //         'B' => DataType::TYPE_STRING,
    //         'C' => DataType::TYPE_STRING,
    //         'D' => DataType::TYPE_STRING,
    //         'E' => DataType::TYPE_STRING,
    //         'F' => DataType::TYPE_STRING,
    //         'G' => DataType::TYPE_STRING,
    //         'H' => DataType::TYPE_STRING,
    //         'I' => DataType::TYPE_STRING,
    //         'J' => DataType::TYPE_STRING,
    //         'K' => DataType::TYPE_STRING,
    //         'L' => DataType::TYPE_STRING,
    //         'M' => DataType::TYPE_STRING,
    //         'N' => DataType::TYPE_STRING,
    //         'O' => DataType::TYPE_STRING,
    //         'P' => DataType::TYPE_STRING
    //     ];
    // }
}
