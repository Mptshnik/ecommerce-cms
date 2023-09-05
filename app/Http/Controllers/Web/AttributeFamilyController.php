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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Вывод всех коллекций атрибутов
     */
    public function index()
    {
        $attributeFamilies = AttributeFamily::all();

        return view('attribute-families.index', compact('attributeFamilies'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Вывод страницы добавления
     */
    public function create()
    {
        $defaultAttributes = AttributeFamily::where('code', 'default')->first()->attributes->pluck('id');

        $attributes = ProductAttribute::whereNotIn('id', $defaultAttributes)->get();

        return view('attribute-families.create', compact('attributes'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает запрос на добавление данных
     * Возвращает страницу вывода всех коллекций атрибутов
     */
    public function store(Request $request)
    {
        $family = AttributeFamily::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        $defaultAttributes = AttributeFamily::where('code', 'default')->first()->attributes->pluck('id');

        $family->attributes()->syncWithoutDetaching($defaultAttributes);

        if ($request->attribute_ids) {
            $family->attributes()->syncWithoutDetaching($request->attribute_ids);
        }

        return redirect()->route('attribute-families.index')
            ->with('success', 'Запись успешно добавлена');
    }

    /**
     * @param AttributeFamily $attributeFamily
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Вывод страницы измененения
     * Функция принимает коллекцию атрибутов
     */
    public function edit(AttributeFamily $attributeFamily)
    {
        $defaultAttributes = AttributeFamily::where('code', 'default')->first()->attributes->pluck('id');

        $attributes = ProductAttribute::whereNotIn('id', $defaultAttributes)->get();

        return view('attribute-families.edit', compact('attributes', 'attributeFamily'));
    }

    /**
     * @param Request $request
     * @param AttributeFamily $attributeFamily
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает коллекцию атрибутов и запрос на изменение данных
     * Функция отвечает за сохранение изменений
     * Возвращает редирект на страницу вывода всех коллекций атрибутов
     */
    public function update(Request $request, AttributeFamily $attributeFamily)
    {
        $attributeFamily->update([
            'name' => $request->name,
        ]);

        $defaultAttributes = AttributeFamily::where('code', 'default')->first()->attributes->pluck('id');

        $attributeFamily->attributes()->sync($defaultAttributes);

        if ($request->attribute_ids) {
            $attributeFamily->attributes()->syncWithoutDetaching($request->attribute_ids);
        }

        return redirect()->route('attribute-families.index')
            ->with('success', 'Запись успешно изменена');
    }

    /**
     * @param AttributeFamily $attributeFamily
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает коллекцию атрибутов
     * Функция отвечает за удаление данных
     */
    public function destroy(AttributeFamily $attributeFamily)
    {
        if ($attributeFamily->code == 'default') {
            return redirect()->route('attribute-families.index')
                ->with('fail', 'Невозможно удалить системный атрибут');
        }

        if (AttributeFamily::all()->count() < 2) {
            return redirect()->route('attribute-families.index')
                ->with('fail', 'В системе должна быть минимум одня коллекция атрибутов');
        }

        $attributeFamily->delete();

        return redirect()->route('attribute-families.index')
            ->with('success', 'Запись успешно удалена');
    }
}
