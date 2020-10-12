<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\Expert;

class ExpertController extends Controller
{
    use Expert;

    public function educate()
    {
        return $this->getEducate();
    }

    public function education()
    {
        $id =request('id');
        return $this->getEducation($id);
    }

    public function specialty()
    {
        $id =request('id');
        return $this->getSpecialty($id);
    }

    public function profession()
    {
        return $this->getProfession();
    }
}
