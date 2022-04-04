<?php

namespace App\Http\Controllers;

use App\Premio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('Premios.lista');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $premio = new Premio();
          $premio->nome = $request->nome;
          $premio->descricao = $request->descricao;

          if($request->hasFile('inputImagem')){
                $imagem = $request->file('inputImagem');
                $name = uniqid(date('HisYmd')); // gerando nome da imagem com a hora
                $extension = $imagem->getClientOriginalExtension(); // pegando a extenção do arquivo
                $nameFile = "{$name}.{$extension}";  //nome que ira ser salvo na base de dados
                $premio->imagem = $nameFile;
                Storage::disk('public')->put("premios/{$nameFile}" , File::get($imagem->getPathname()));
          }else{
            $premio->imagem = null;
          }

       try{
            $premio->save();
            return redirect()->back()->with('success', 'Salvo Com Sucesso!');

          } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Erro ao Salva Cadastro');
          }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
