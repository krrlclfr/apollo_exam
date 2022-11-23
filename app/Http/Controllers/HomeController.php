<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Random;
use App\Models\BreakDowns;
class HomeController extends Controller
{
    //
    public function index()
    {   
        $names = array(
            'Johnathon',
            'Anthony',
            'Erasmo',
            'Raleigh',
            'Nancie',
            'Tama',
            'Camellia',
            'Augustine',
            'Christeen',
            'Luz',
            'Diego',
            'Lyndia',
            'Thomas',
            'Georgianna',
            'Leigha',
            'Alejandro',
            'Marquis',
            'Joan',
            'Stephania',
            'Elroy',
            'Zonia',
            'Buffy',
            'Sharie',
            'Blythe',
            'Gaylene',
            'Elida',
            'Randy',
            'Margarete',
            'Margarett',
            'Dion',
            'Tomi',
            'Arden',
            'Clora',
            'Laine',
            'Becki',
            'Margherita',
            'Bong',
            'Jeanice',
            'Qiana',
            'Lawanda',
            'Rebecka',
            'Maribel',
            'Tami',
            'Yuri',
            'Michele',
            'Rubi',
            'Larisa',
            'Lloyd',
            'Tyisha',
            'Samatha',
        ); // List of Names
 
        
        for($i = 5; $i < 10; $i++)
        {   
            $random_name = $names[rand(0, count($names) -1)]; // Generate Random Names

            $rand = Random::create([
                'values' => $random_name,
            ]);

            for($j = 5; $j < 10; $j++)
            {
                $randomString = Str::random(5);
                $brk = BreakDowns::create([
                    'values' => $randomString,
                    'random_id' => $rand->id
                ]);

                $brk->save();
            }

            $rand->save();
        }

        $rand = Random::with('breakdowns')->get();  //Retrieve Data from Random table(id) with relationship with Breakdown table (random_id)

        return view('welcome', compact('rand'));

    }
}
