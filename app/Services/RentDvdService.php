<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Dvd;

class RentDvdService
{
  public function __construct(
    private readonly Dvd $dvd,
    private readonly Customer $customer
  ) {}

  public function customerRentedDvd(Dvd $dvd, Customer $customer)
  {
    $dvd->customer()->attach($customer->id);
  }
}
