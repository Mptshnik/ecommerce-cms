<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AttributeFamily;
use App\Models\AttributeGroup;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class AttributeFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributeFamilies = AttributeFamily::all();

        return view('attribute-families.index', compact('attributeFamilies'));
    }

    private function getAllAttributeIDs($groups)
    {
        $ids = [];

        foreach ($groups as $group)
        {
            foreach ($group->attributes as $attribute)
            {
                $ids[] = $attribute->id;
            }
        }

        return $ids;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = AttributeFamily::where('code', 'default')->first()->groups;

        $ids = $this->getAllAttributeIDs($groups);

        $attributes = ProductAttribute::whereNotIn('id', $ids)->get();

        return view('attribute-families.create', compact('groups', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeFamily $attributeFamily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttributeFamily $attributeFamily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttributeFamily $attributeFamily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeFamily $attributeFamily)
    {
        if (AttributeFamily::all()->count() < 2) {
            return redirect()->route('attribute-families.index')
                ->with('fail', 'В системе должна быть минимум одня коллекция атрибутов');
        }

        $attributeFamily->delete();

        return redirect()->route('attribute-families.index')
            ->with('success', 'Запись успешно удалена');
    }
}
