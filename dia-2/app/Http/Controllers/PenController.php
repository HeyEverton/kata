<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePenRequest;
use App\Http\Requests\UpdatePenRequest;
use App\Models\Pen;
use Illuminate\Http\Request;

class PenController extends Controller
{
    public function __construct(private Pen $pen)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pens = $this->pen->paginate();
        return response()->json($pens, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePenRequest $request)
    {
        $input = $request->validated();
        $pen = $this->pen->create($input);
        return response()->json([
            'message' => 'A caneta foi criada com sucesso!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pen = $this->pen->findOrFail($id);
        return response()->json($pen, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenRequest $request, $id)
    {
        $input = $request->validated();
        $pen = $this->pen->findOrFail($id);
        $pen->update($input);
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
    }
}
