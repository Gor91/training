<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\Expert;
use App\Models\Education;
use App\Models\Specialty;
use App\Models\SpecialtiesType;

class ExpertController extends Controller
{
    use Expert;
    public function education()
    {
       return $this->getEducation();
    }

    public function specialty($id)
    {
       return $this->getSpecialty($id);
    }

    public function profession()
    {
        return $this->getProfession();
    }
}
