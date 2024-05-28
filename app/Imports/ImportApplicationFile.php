<?php

namespace App\Imports;

use App\Models\Application;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportApplicationFile implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Application([]);
    }
}
