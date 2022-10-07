<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    // Store a Option
    public function store(Request $request)
    {
        $this->validate($request, [
            'option_name' => 'required',
            'value' => 'required_without:image_url',
            'image_url' => 'required_without:value|image|mimes:jpeg,png,jpg',
        ]);

        $data = $request->all();

        $lastOptionOrder = Option::select('order')->where('variation_id', $data['variation_id'])->orderByDesc('order')->first();

        if (isset($data['type']) && $data['type'] === 'IMAGE') {
            $image = $request->file('image_url');

            $data['value'] = storeImage($image, '/images/options');
        }

        $option = Option::create([
            'name' => $data['option_name'],
            'variation_id' => $data['variation_id'],
            'value' => $data['value'],
            'type' => isset($data['type']) ? $data['type'] : 'NONE',
            'order' => isset($lastOptionOrder) ? ++$lastOptionOrder->order : 1,
        ]);

        if (!$option->save()) {
            return back()->with("error", "Error creating option.");
        }

        return back()->with("success", "Option created successfully!");
    }

    // Update a Option
    public function update(Request $request, Option $option)
    {
        $this->validate($request, [
            'option_name' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg',
        ]);

        $data = $request->all();

        if (isset($data['type']) && $data['type'] === 'IMAGE') {

            if (!isset($data['image_url'])) {
                return back()->with("error", "Missing option image.");
            }

            $image = $request->file('image_url');

            $data['value'] = storeImage($image, '/images/options');

            deleteImage($option->value, 'options');
        }

        $updateResponse = $option->update([
            'name' => $data['option_name'],
            'value' => isset($data['value']) ? $data['value'] : $option->value,
            'type' => isset($data['type']) ? $data['type'] : 'NONE',
        ]);

        if (!$updateResponse) {
            return back()->with("error", "Error updating option.");
        }

        return back()->with('success', 'Option updated successfully');
    }
     // Return all Collections
     public function getAll($variation)
     {
        $options = Option::all()->reject(function ($option) {
            return $option->variation_id != $variation;
        })->map(function ($option) {
            return ['id'=>$option->id,'text'=>$option->name];
        
        });
         return response()->json(['results'=>$options]);
     }
    // Delete a Option
    public function destroy(Option $option)
    {
        if (!$option->delete()) {
            return back()->with("error", "Error deleting option.");
        }

        return back()->with("success", "Option deleted successfully!");
    }
}
