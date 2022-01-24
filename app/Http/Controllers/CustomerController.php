<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('customers.index', [
            'title' => 'Data Pelanggan',
            'customers' => Customer::all(),
            'provinces' => Province::all(),
            'cities' => City::all(),
            'districts' => District::all(),
            'villages' => Village::all(),
        ]);
    }

    public function getCities()
    {
        $cities = City::where('province_code', request()->get('id'))
            ->pluck('name', 'code');

        return response()->json($cities);
    }

    public function getDistricts()
    {
        $districts = District::where('city_code', request()->get('id'))
            ->pluck('name', 'code');

        return response()->json($districts);
    }

    public function getVillages()
    {
        $villages = Village::where('district_code', request()->get('id'))
            ->pluck('name', 'code');

        return response()->json($villages);
    }

    public function create()
    {
        return view('customers.create', [
            'title' => 'Tambah Pelanggan',
            'provinces' => Province::pluck('name', 'code'),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:255',
            'gender' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'village' => 'required',
        ]);

        $customer = Customer::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender'),
            'province' => request('province'),
            'city' => request('city'),
            'district' => request('district'),
            'village' => request('village'),
            'address' => request('address'),
        ]);

        toast('Data pelanggan berhasil dibuat!','success');
        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'title' => 'Edit Pelanggan',
            'customer' => $customer,
            'provinces' => Province::pluck('name', 'code'),
            'cities' => City::pluck('name', 'province_code'),
            'districts' => District::pluck('name', 'code'),
            'villages' => Village::pluck('name', 'code'),
        ]);
    }

    public function update(Customer $customer)
    {
        request()->validate([
            'name' => 'required|max:255',
            'gender' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'village' => 'required',
        ]);

        $customer->update([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender'),
            'province' => request('province'),
            'city' => request('city'),
            'district' => request('district'),
            'village' => request('village'),
            'address' => request('address'),
        ]);

        toast('Data pelanggan berhasil diedit!','success');
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        toast('Data pelanggan berhasil dibuat!','success');
        return back();
    }
}
