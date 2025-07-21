<?php 

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Santri;

class Hafalan extends Component
{
    public $santri;
    public $progressHafalans;

    public function __construct(Santri $santri)
    {
        $this->santri = $santri;
        $this->progressHafalans = $santri->progressHafalans()->paginate(10);
    }

    public function render()
    {
        return view('components.hafalan');
    }
}