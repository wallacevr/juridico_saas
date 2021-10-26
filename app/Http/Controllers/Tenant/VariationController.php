<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    // Return all Variations
    public function index()
    {
        return view('tenant.variations.index', [
            'variations' => Variation::paginate(10),
        ]);
    }

    // Show the Variation create form
    public function create()
    {
        return view('tenant.variations.create');
    }

    // Show the Variation edit form
    public function edit(Variation $variation)
    {
        return view('tenant.variations.edit', [
            'variation' => $variation,
            'options' => $variation->options()->get(),
        ]);
    }

    // Store a Variation
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = generateSlug($data['name'], 'variations');

        $variation = Variation::create($data);

        if (!$variation->save()) {
            return back()->withInput()->with("error", "Error creating variation.");
        }

        return redirect()->route('tenant.variations.index')->with("success", "Variation created successfully!");
    }

    // Update a Variation
    public function update(Request $request, Variation $variation)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();

        if (!$variation->update($data)) {
            return back()->withInput()->with("error", "Error updating variation.");
        }

        return redirect()->route('tenant.variations.index')->with('success', 'Variation updated successfully');
    }

    // Delete a Variation
    public function destroy(Variation $variation)
    {
        if (!$variation->delete()) {
            return redirect()->route('tenant.variations.index')->with("error", "Error deleting variation.");
        }

        return redirect()->route('tenant.variations.index')->with("success", "Variation deleted successfully!");
    }
}
