<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TablaSheetExport implements FromCollection, WithHeadings, WithTitle
{
    protected $tabla;
    protected $data;

    public function __construct($tabla)
    {
        $this->tabla = $tabla;
        $this->data = DB::table($tabla)->get();
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        if ($this->data->isEmpty()) return [];

        return array_keys((array)$this->data->first());
    }

    public function title(): string
    {
        return substr($this->tabla, 0, 31);
    }
}