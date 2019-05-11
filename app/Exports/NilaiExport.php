<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiExport implements FromArray, ShouldAutoSize
{
    protected $nilai;

    public function __construct(array $nilai)
    {
        $this->nilai = $nilai;
    }

    public function array(): array
    {
        return $this->nilai;
    }
}
