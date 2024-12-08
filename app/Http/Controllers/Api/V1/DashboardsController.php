<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\SalesComissionResponse;
use App\Models\SalesComission;

class DashboardsController
{
  public function __construct(protected SalesComission $salesComission) {}

  public function sellersComissions()
  {
    return SalesComissionResponse::collection($this->salesComission->all());
  }
}
