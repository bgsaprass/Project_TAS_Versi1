<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function create()
    {
        return view('address.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:500',
            'city'           => 'required|string|max:100',
            'postcode'       => 'required|string|max:20',
            'country'        => 'required|string|max:100',
        ]);

        $validated['user_id'] = Auth::id();

        Address::create($validated);

        return redirect()->route('checkout')->with('success', 'Alamat berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('address.edit', compact('address'));
    }


    public function update(Request $request, $id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:500',
            'city'           => 'required|string|max:100',
            'postcode'       => 'required|string|max:20',
            'country'        => 'required|string|max:100',
        ]);

        $address->update($validated);

        return redirect()->route('profile')->with('success', 'Alamat berhasil diperbarui.');
    }

   
    public function destroy($id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $address->delete();

        return redirect()->route('profile')->with('success', 'Alamat berhasil dihapus.');
    }
}
