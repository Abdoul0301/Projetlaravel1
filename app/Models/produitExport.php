<?php
namespace App\Models;


use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class produitExport implements FromCollection,WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings():array{
        return[
            'id',
            'photo',
            'nom',
            'desc',
            'prix',
            'qtstock',

        ];
    }
    public function collection()
    {
        return Produit::all();
    }
}


