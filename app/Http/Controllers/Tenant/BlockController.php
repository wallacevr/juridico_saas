<?php

namespace App\Http\Controllers\Tenant;

use App\Block;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    // Return all Blocks
    public function index()
    {
        return view('tenant.blocks.index', [
            'blocks' => Block::paginate(5),
        ]);
    }

    // Return a single Block
    public function show(Block $block)
    {
        return view('tenant.blocks.show', [
            'block' => $block,
        ]);
    }

    // Show the Block create form
    public function create()
    {
        return view('tenant.blocks.create');
    }

    // Show the Block edit form
    public function edit(Block $block)
    {
        return view('tenant.blocks.edit')->with(['block' => $block]);
    }

    // Store a Block
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
        ]);

        $data = $request->all();
        $data['short_code'] = isset($data['short_code']) ? generateShortcode($data['short_code'], 'blocks') : null;

        $block = Block::create($data);

        if (!$block->save()) {
            return back()->withInput()->with("error", "Error creating block.");
        }

        return redirect()->route('tenant.blocks.index')->with("success", "Block created successfully!");
    }

    // Update a Block
    public function update(Request $request, Block $block)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = isset($data['status']) ? '1' : '0';

        if (isset($data['short_code']) && $data['short_code'] != $block->short_code) {
            $data['short_code'] = generateShortcode($data['short_code'], 'blocks', $block->id);
        }

        if (!$block->update($data)) {
            return back()->withInput()->with("error", "Error updating block.");
        }

        return redirect()->route('tenant.blocks.index')->with('success', 'Block updated successfully');
    }

    // Delete a Block
    public function destroy(Block $block)
    {
        if (!$block->delete()) {
            return redirect()->route('tenant.blocks.index')->with("error", "Error deleting block.");
        }

        return redirect()->route('tenant.blocks.index')->with("success", "Block deleted successfully!");
    }
}
