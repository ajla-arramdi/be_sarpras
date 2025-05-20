<?php // app/Http/Controllers/KategoriController.php
namespace App\Http\Controllers;


use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriApiController extends Controller
{

    public function index()
    {
        $kategoris = Kategori::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Kategori',
            'data' => $kategoris
        ]);
    }
}
