<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QualificationController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::all();
        return view('qualification.index', compact('qualifications'));
    }

    public function create()
    {
        return view('qualification.create');
    }

    public function store(Request $request)
    {
        try {
            $qualification = Qualification::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } catch (\Exception $th) {
            Log::error($th->getMessage());
        }

        return redirect()->route('qualifications.index');
    }

    public function show(Qualification $qualification)
    {

    }

    public function edit(Qualification $qualification)
    {
        return view('qualification.edit', compact('qualification'));
    }

    public function update(Request $request, Qualification $qualification)
    {

    }
}
