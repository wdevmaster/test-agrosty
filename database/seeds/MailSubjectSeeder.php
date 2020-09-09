<?php

use Illuminate\Database\Seeder;

use App\MailSubject;

class MailSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['name' => 'Reclamo'],
            ['name' => 'Solicitud'],
            ['name' => 'Queja']
        ];

        foreach ($rows as $row)
            MailSubject::create($row);
    }
}
