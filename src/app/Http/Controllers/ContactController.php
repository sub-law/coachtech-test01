<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function create(Request $request)
  {
    $categories = Category::all(); 
    return view('create', compact('categories'));
  }

  public function confirm(ContactRequest $request)
  {
    $inputs = $request->validated();
    $inputs['full_name'] = $inputs['last_name'] . '　' . $inputs['first_name'];
    $genderLabels = ['1' => '男性', '2' => '女性', '3' => 'その他'];
    $inputs['gender_label'] = $genderLabels[$inputs['gender']] ?? '未選択';

    $inputs['tel_full'] = $inputs['tel1'] . '-' . $inputs['tel2'] . '-' . $inputs['tel3'];

    $category = Category::find($inputs['category_type']);
    $inputs['category_name'] = $category ? $category->content : '未選択';

    session()->flash('_old_input', $inputs);
    return view('confirm', compact('inputs'));
  }

  public function store(ContactRequest $request)
  {
    $validated = $request->validated();

    Contact::create([
      'first_name' => $validated['first_name'],
      'last_name' => $validated['last_name'],
      'gender' => $validated['gender'],
      'email' => $validated['email'],
      'tel' => $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'],
      'address' => $validated['address'],
      'building' => $validated['building'] ?? null,
      'detail' => $validated['detail'],
      'category_id' => $validated['category_type'],
    ]);

    return view('thanks');
  }
}