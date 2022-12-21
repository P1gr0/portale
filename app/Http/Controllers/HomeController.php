<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Get data to show in the home.

     */
    public function getData()
    {
        $data = Array (
            "chi_sono" => Array (
                "nome" => "Giuseppe",
                "cognome" => "Cuscito",
                "ruolo" => "Full-stack Developer"
            ),
            "contatti_social" => Array (
                "linkedin" => "https://linkedin.com/in/giusepp3-cuscit0",
                "github" => "https://github.com/P1gr0",
            ),
            "mi_piace" => "Nel tempo libero: <br>
            - sono interessato al mondo crypto &#8383; e blockchain; <br>
            - mi piace viaggiare &#127964; ovunque; <br>
            - mi piace il calcio &#9917; e gli sport di squadra; <br>
            - amo la musica &#127925; in particolare la batteria &#129345;.",
            "email" => "pinopi793@gmail.com"
        );

        return $data;
    }
}
