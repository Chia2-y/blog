<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TestImport implements ToCollection
{

    public function collection(Collection $collection)
    {
        // TODO: Implement collection() method.
        return $collection;
    }
}
