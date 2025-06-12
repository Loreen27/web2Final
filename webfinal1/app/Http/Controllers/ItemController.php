<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    
    public function create()
    {
        return view('items.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:items,email',
            'age' => 'required|integer|between:18,60',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email already exists',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be an integer',
            'age.between' => 'Age must be between 18 and 60',
        ]);

        try {
            Item::create($validated);
            return redirect()->back()->with('success', 'Item added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add item');
        }
    }

    
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:items,email,' . $item->id,
            'age' => 'required|integer|between:18,60',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email already exists',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be an integer',
            'age.between' => 'Age must be between 18 and 60',
        ]);

        try {
            $item->update($validated);
            return redirect()->back()->with('success', 'Item updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update item');
        }
    }

    
    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete item');
        }
    }
}

