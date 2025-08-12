<?php

namespace App\Http\Controllers;

use App\Models\CustomFieldOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Log;

class FormFieldOptionController extends Controller
{
    public function index()
    {

    }

    public function edit(string $option)
    {
        $customFieldOption = CustomFieldOption::find($option);
        return view('admin.customfields.options.edit', compact('customFieldOption'));
    }

    public function store(Request $request)
    {
        try {
            $option = CustomFieldOption::create([
                'id' => Carbon::now()->timestamp,
                'identifier' => $request->identifier,
                'label' => $request->label,
                'custom_field_id' => $request->field_id,
            ]);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return redirect()->route('customfields.edit', $request->field_id);
    }

    public function update(Request $request, CustomFieldOption $option)
    {
        $option->update($request->except(['_token', '_method', 'action', 'confirm', 'is_active']) + [
            'is_active' => (bool)$request->is_active,
            ]);
        return redirect()->route('customfields.edit', $option->field->id);
    }
}
