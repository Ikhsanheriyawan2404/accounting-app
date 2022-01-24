<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'gender', 'phone', 'province', 'city', 'district', 'village', 'address'];

    public function getNameProvince()
    {
        // return Province::where('code', Customer::where('user')));
    }
}
