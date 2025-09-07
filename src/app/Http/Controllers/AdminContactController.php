<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Category;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    { 
        $query = Contact::with('category')
            ->keywordSearch($request->input('keyword'))
            ->genderSearch($request->input('gender'))
            ->categorySearch($request->input('category_id'))
            ->dateSearch($request->input('date'));

        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        return response()->json([
            'full_name' => $contact->full_name,
            'gender_label' => $contact->gender_label,
            'email' => $contact->email,
            'tel' => $contact->tel,
            'address' => $contact->address,
            'building' => $contact->building,
            'category_name' => $contact->category_name,
            'detail' => $contact->detail,
        ]);
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Contact::with('category')
            ->keywordSearch($request->input('keyword'))
            ->genderSearch($request->input('gender'))
            ->categorySearch($request->input('category_id'))
            ->dateSearch($request->input('date'));

        $contacts = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $columns = ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'];

        return response()->stream(function () use ($contacts, $columns) {
            $stream = fopen('php://output', 'w');
            fputs($stream, chr(0xEF) . chr(0xBB) . chr(0xBF)); 
            fputcsv($stream, $columns);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    $contact->full_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category_name,
                    $contact->detail,
                ]);
            }

            fclose($stream);
        }, 200, $headers);
    }

}