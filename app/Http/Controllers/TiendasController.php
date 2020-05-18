<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tienda;

class TiendasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function tienda()
    {
        return view('tiendas.tienda');        
    }

    public function index(Request $request)
    {
        $tiendas = Tienda::orderBy('id', 'ASC')->paginate(5);        
        
        return [
            'paginate' => [
                'total'         => $tiendas->total(),
                'current_page'  => $tiendas->currentPage(),
                'per_page'      => $tiendas->perPage(),
                'last_page'     => $tiendas->lastPage(),
                'from'          => $tiendas->firstItem(),
                'to'            => $tiendas->lastItem()
            ],
            'tiendas' => $tiendas            
        ];        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'fecha_apertura' => 'required'
        ]);

        Tienda::create($request->all());
        return;
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
        $this->validate($request, [
            'nombre' => 'required',
            'fecha_apertura' => 'required'
        ]);

        Tienda::find($id)->update($request->all());        
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tienda = Tienda::findOrFail($id);
        $tienda->delete();
    }
}
