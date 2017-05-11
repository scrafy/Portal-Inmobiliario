<?php

namespace App\BussinesModel\Interfaces\Web;

use App\Models\InputModels\Web\Footer\ContactMessage;

interface IFooterOperations {
     public function SendContactMessage(ContactMessage $message);
}
