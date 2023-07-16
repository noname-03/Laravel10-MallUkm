<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $user = auth()->guard('api')->user();
        $address = $user->addresses()->get();
        if (!$address) {
            return response()->json([
                'code' => '404',
                'message' => 'Data Alamat Tidak Ditemukan',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => '200',
            'message' => 'Data Alamat Berhasil Diambil',
            'data' => $address
        ]);
    }

    public function store(StoreAddressRequest $request)
    {
        $user = auth()->guard('api')->user();
        $address = $user->addresses()->create($request->validated());
        if (!$address) {
            return response()->json([
                'code' => '400',
                'message' => 'Data Alamat Gagal Ditambahkan',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => '200',
            'message' => 'Data Alamat Berhasil Ditambahkan',
            'data' => $address
        ]);
    }

    public function update(StoreAddressRequest $request, $id)
    {
        $user = auth()->guard('api')->user();
        $address = $user->addresses()->where('id', $id)->first();
        if (!$address) {
            return response()->json([
                'code' => '404',
                'message' => 'Data Alamat Tidak Ditemukan',
                'data' => null
            ]);
        }
        $address->update($request->validated());
        return response()->json([
            'code' => '200',
            'message' => 'Data Alamat Berhasil Diubah',
            'data' => $address
        ]);
    }

    public function delete($id)
    {
        $user = auth()->user();
        $address = $user->addresses()->where('id', $id)->first();
        if (!$address) {
            return response()->json([
                'code' => '404',
                'message' => 'Data Alamat Tidak Ditemukan'
            ]);
        }
        $address->delete();
        return response()->json([
            'code' => '200',
            'message' => 'Data Alamat Berhasil Dihapus'
        ]);
    }

    public function selected()
    {
        $address = auth()->guard('api')->user()->addresses()->where('status', 'selected')->first();
        if (!$address) {
            return response()->json([
                'code' => '404',
                'message' => 'Data Alamat Tidak Ditemukan',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => '200',
            'message' => 'Data Alamat Berhasil Diambil',
            'data' => $address
        ]);
    }

    public function updateSelected($id, Request $request)
    {
        $user = auth()->guard('api')->user();
        $address = $user->addresses()->where('id', $id)->first();

        if (!$address) {
            return response()->json([
                'code' => '404',
                'message' => 'Data Alamat Tidak Ditemukan',
                'data' => null
            ]);
        }

        $user->addresses()->where('id', '!=', $id)->update(['status' => 'unselected']);
        $address->update(['status' => 'selected']);

        return response()->json([
            'code' => '200',
            'message' => 'Data Alamat Berhasil Diubah',
            'data' => $address
        ]);
    }

}