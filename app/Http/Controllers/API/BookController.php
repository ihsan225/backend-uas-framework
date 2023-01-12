<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::get();

        $output = array(
            'error' => false,
            'msg' => 'Data Berhasil Ditampilkan',
            'data' => $data
        );
        return $output;
    }
    public function get_by_id($id_buku)
    {
        // var_dump(Mahasiswa::find($id));
        // var_dump(Mahasiswa::where('id', $id)->first()); 
        // die;

        return response()->json(['book' => Book::find($id_buku)]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'genre_buku' => 'required|string|max:255',
        ]);

        Book::create($request->all());

        return response()->json(['book' => Book::all()]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_buku' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'genre_buku' => 'required|string|max:255',
        ]);
        $update = Book::where('id_buku', $request->id_buku)->update($request->all());
        if ($update) {
            return response()->json(['msg' => 'update data successfully']);
        }
    }

    public function destroy($id_buku)
    {
        $del = Book::where('id_buku', $id_buku)->delete();
        if ($del) {
            return response()->json(['msg' => 'delete data successfully']);
        }
    }
}
