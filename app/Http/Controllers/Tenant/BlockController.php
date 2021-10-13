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
        ]);

        $response = [
            "status" => "success",
            "message" => "Block created successfully!",
        ];

        $data = $request->all();
        $data['short_code'] = generateShortcode($data['short_code'], 'blocks');

        $block = Block::create($data);

        if (!$block->save()) {
            $response['status'] = "error";
            $response['message'] = "Error creating block.";
        }

        return redirect()
            ->route('tenant.blocks.index')
            ->with($response['status'], $response['message']);
    }

    // Update a Block
    public function update(Request $request, Block $block)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Block updated successfully!",
        ];

        $data = $request->all();
        $data['status'] = isset($data['status']) ? '1' : '0';
        $data['short_code'] = generateShortcode($data['short_code'], 'blocks', $block->id);

        if (!$block->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating Block.";
        }

        return redirect()
            ->route('tenant.blocks.index')
            ->with('success', 'Block updated successfully');
    }

    // Delete a Block
    public function destroy(Block $block)
    {
        $response = [
            "status" => "success",
            "message" => "Block deleted successfully!",
        ];

        if (!$block->delete()) {
            $response['status'] = "error";
            $response['message'] = "Error deleting Block.";
        }

        return redirect()
            ->route('tenant.blocks.index')
            ->with($response['status'], $response['message']);
    }
}
