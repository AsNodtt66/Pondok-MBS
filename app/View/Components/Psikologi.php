<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Santri;

class Psikologi extends Component
{
    public $santri;
    public $psikologiSantris;

    public function __construct(Santri $santri)
    {
        $this->santri = $santri;
        $this->psikologiSantris = $santri->psikologiSantris()->paginate(10);
    }

    public function render()
    {
        return view('components.psikologi');
    }
}