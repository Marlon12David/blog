<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('navigation-menu', ['categories' => $categories]);
    }
}
