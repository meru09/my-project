<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'shipping_cost' => Setting::getValue('shipping_cost', '12.00'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'shipping_cost' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(
            ['key' => 'shipping_cost'],
            ['value' => $request->input('shipping_cost')]
        );

        return redirect()->route('admin.settings.edit')->with('success', 'Shipping settings updated.');
    }
}
