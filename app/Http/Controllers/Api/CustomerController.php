<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginCustomerRequest;
use App\Http\Requests\Api\RegisterCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function register(RegisterCustomerRequest $request)
    {
        $data = $request->validated();

        $data['phone_number'] = Crypt::encryptString($request->phone_number);
        $data['password'] = Hash::make($request->password);
        $data['first_name'] = Crypt::encryptString($request->first_name);
        $data['last_name'] = Crypt::encryptString($request->last_name);
        $data['middle_name'] = Crypt::encryptString($request->middle_name);

        $customer = Customer::create($data);

        $customer['auth_token'] = $customer->createToken('auth_token')->plainTextToken;

        return $customer;
    }

    public function login(LoginCustomerRequest $request)
    {
        if (!Auth::guard('customer')->attempt($request->validated()))
        {
            return response(['message' => 'Не правильно введен логин или пароль']);
        }

        $customer = Customer::where('email', $request->email)->first();
        $customer['auth_token'] = $customer->createToken('auth_token')->plainTextToken;

        return $customer;
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function getAuthorizedCustomer()
    {
        return Auth::user();
    }

}
