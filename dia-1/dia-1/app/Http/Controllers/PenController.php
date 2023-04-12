<?php

namespace App\Http\Controllers;

use App\Models\Pen;
use Illuminate\Http\Request;

class PenController extends Controller
{

    public function __construct(private Pen $pen)
    {
        # code...
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pens = $this->pen->paginate(10);
        return response()->json($pens, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pen = $request->all();

        $createPen = $this->pen->create($pen);

        return $createPen;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $pen = $this->pen->find($id);
       return response()->json($pen, 200);
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
        $data = $request->all();
        $pen = $this->pen->find($id);
        $pen->update($data);

        return response()->json($pen, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pen = $this->pen->find($id);
        $pen->delete();
        return response()->json([
            'message' => 'Excluido com sucesso'
        ]);
    }
}
