<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    public function run()
    {
        Track::factory()
            ->count(19)->sequence(['name' => 'Circuit spa francorchamps', 'country' => 'Belgium', 'length' => 7.004, 'turns' => 20],
                                        ['name' => 'Bahrain International Circuit', 'country' => 'Bahrain', 'length' => 5.412, 'turns' => 15],
                                        ['name' => 'Jeddah Corniche Circuit', 'country' => 'Saudi Arabia', 'length' => 6.175, 'turns' => 27],
                                        ['name' => 'Albert Park Street Circuit', 'country' => 'Australia', 'length' => 5.278, 'turns' => 14],
                                        ['name' => 'Autodromo Enzo e Dino Ferrari', 'country' => 'Italy', 'length' => 4.909, 'turns' => 17],
                                        ['name' => 'Miami International Autodrome', 'country' => 'United States', 'length' => 5.412, 'turns' => 19],
                                        ['name' => 'Baku City Circuit', 'country' => 'Azerbaijan', 'length' => 6.003, 'turns' => 20],
                                        ['name' => 'Circuit Gilles Villeneuve', 'country' => 'Canada', 'length' => 4.361, 'turns' => 15],
                                        ['name' => 'Silverstone', 'country' => 'Britain', 'length' => 5.891, 'turns' => 18],
                                        ['name' => 'Red Bull Ring', 'country' => 'Austria', 'length' => 4.318, 'turns' => 10],
                                        ['name' => 'Circuit Paul Ricard', 'country' => 'France', 'length' => 5.809 , 'turns' => 15],
                                        ['name' => 'Hungaroring', 'country' => 'Hungary', 'length' => 4.381, 'turns' => 14],
                                        ['name' => 'Circuit Zandvoort', 'country' => 'Netherlands', 'length' => 4.259 , 'turns' => 14],
                                        ['name' => 'Autodromo Nazionale Monza', 'country' => 'Italy', 'length' => 5.793, 'turns' => 11],
                                        ['name' => 'Marina Bay Street Circuit', 'country' => 'Singapore', 'length' => 5.067, 'turns' => 23],
                                        ['name' => 'Suzuka International Racing Course', 'country' => 'Japan', 'length' => 5.807, 'turns' => 17],
                                        ['name' => 'Autodromo Hermanos Rodriguez', 'country' => 'Mexico', 'length' => 4.438, 'turns' => 14],
                                        ['name' => 'Autódromo José Carlos Pace', 'country' => 'Brazil', 'length' => 4.309, 'turns' => 15],
                                        ['name' => 'Yas Marina Circuit', 'country' => 'United Arab Emirates', 'length' => 5.281, 'turns' => 16],
                                       )
        ->create();
    }
}
