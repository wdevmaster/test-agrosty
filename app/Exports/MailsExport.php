<?php

namespace App\Exports;

use App\Mail;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Resources\MailResource;

class MailsExport implements FromCollection
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MailResource::collection(Mail::all());
    }
}
