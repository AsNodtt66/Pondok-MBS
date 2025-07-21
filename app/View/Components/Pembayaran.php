<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Santri;

class Pembayaran extends Component
{
    public $santri;
    public $pembayarans;

    public function __construct(Santri $santri)
    {
        $this->santri = $santri;
        $this->pembayarans = $santri->pembayarans()->paginate(10);
    }

    public function render()
    {
        return view('components.pembayaran');
    }
}