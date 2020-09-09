<?php

use Illuminate\Database\Seeder;

use App\SpamWord;

class SpamWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [ 'word' => 'tarifas', 'pts' => 1 ],
            [ 'word' => 'contactanos', 'pts' => 2 ],
            [ 'word' => 'buy', 'pts' => 3 ],
            [ 'word' => 'oferta/s', 'pts' => 4 ],
            [ 'word' => 'viagra', 'pts' => 5 ],
        ];

        foreach ($rows as $row) 
            SpamWord::create($row);
    }
}
