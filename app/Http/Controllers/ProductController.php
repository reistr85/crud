<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $product;

    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    public function index()
    {
        $prod = $this->product->all();
        $i    = 1;
        return view('painel.index', compact('prod', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prod = null;
        return view('painel.create', compact('prod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->except('_token');

        $messages =
            [
                'name.required' => 'O Campo Nome é Obrigatório.',
                'description.required' => 'O Campo Descrição é Obrigatório.'
            ];

        $this->validate($request, $this->product->rules, $messages);

        $insert = $this->product->insert($dataForm);

        if($insert)
            return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = true;
        $prod = $this->product->find($id);
        return view('painel.create', compact('prod','show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod = $this->product->find($id);
        return view('painel.create', compact('prod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();

        $messages =
            [
                'name.required' => 'O Campo Nome é Obrigatório.',
                'description.required' => 'O Campo Descrição é Obrigatório.'
            ];

        $this->validate($request, $this->product->rules, $messages);

        $update = DB::table('products')
            ->where('id', $id)
            ->update(['name' => $dataForm['name'], 'description' => $dataForm['description']]);
        if($update)
            return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = $this->product->find($id);
        $delete = $prod->delete();

        if($delete)
            return redirect()->route('products.index');
    }
}
