<?php

namespace App\Domain\Repositories;

use App\Models\PickupOffice;
use Japananimetime\Template\BaseRepository;

class PickupOfficeRepository extends BaseRepository
{
    public function model(): PickupOffice
    {
        return new PickupOffice();
    }
}
