<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

use App\Models\InputModels\ExternalApi\MainOperations\ViewBookModel;
use App\Models\InputModels\ExternalApi\MainOperations\BookModel;

interface IExternalApiMainBookOperations {

    public function getBooks(ViewBookModel $search);

    public function getBook(BookModel $search);
}
