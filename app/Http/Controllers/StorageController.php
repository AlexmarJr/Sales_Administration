<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Clientes;
use App\Vendas;
use App\Estoque;


class StorageController extends Controller
{
    public function index(){
        $storage = DB::table('estoques')->where('id_user', '=',Auth::id())->get();;
        return view('storage', compact('storage'));
    }

    public function store_storage(Request $request){
        
        $id = $request->get('id', false);
        $attr['id_user']= Auth::id();
        $attr['name_product']= $request->name_product;
        $attr['buy_price']= $request->buy_price;
        $attr['sell_price']= $request->sell_price;
        $attr['quantity']= $request->quantity;
        $attr['description']= $request->description;
        $attr['status'] = 0;


            $verify = DB::table('estoques')->where('name_product', '=', $attr['name_product'])->where('id_user', '=', Auth::id())->get(); /* Um possivel armengue
                                                                                                                            Verificar se ja existe um cliente com esse
                                                                                                                            nome e se é do usuario atualmente logado */
            
            if(isset($id)){ //Verificar se ja existe um $id, se for o caso, a função saberar que é uma edição
                try{
                    if($id){
                        $storage = Estoque::find($id);
                        $storage->fill($attr);
                        $storage->save();
                    }
                    else{
                        Estoque::create($attr);
                    }
                    flash('Produto Registrado no Estoque')->success();
                    return redirect()->route('storage_home');
                    }
                catch (\Exception $e) {
                    flash($e)->error();
                    return redirect()->route('storage_home');
                }
            }
            else{
                flash("Cliente Já Existe!")->error();
                return redirect()->route('storage_home');
            }
    }

    public function edit_storage($id){
        $storage = DB::table('estoques')->where('id_user', '=',Auth::id())->get();;
        $head = Estoque::find($id);
        return view('storage', compact('storage', 'head'));
    }

    public function delete_product($id){ 
        try{
            $storage_head = Estoque::query()->where('id', '=', $id)->where('id_user', '=', Auth::id());
            $verify =  Estoque::query()->where('id', '=', $id)->where('id_user', '=', Auth::id())->get();
            
            if($verify->isEmpty()){
                flash('Produto não encontrado!')->error();
                return redirect()->route('storage_home');
            }
            else{
                $storage_head->delete();
                flash('Produto Excluido')->warning();
                return redirect()->route('storage_home');
            }
        }
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }
    }

    public function search_product(Request $request){
        $search_product = $request->search;
        $storage = Estoque::query()->where('name_product', 'LIKE', '%' . $search_product . '%')->where('id_user', '=', Auth::id())->get();
        if ($storage->isEmpty()){
            flash('Produto não encontrado')->error();
            return redirect()->route('storage_home');
        }
        else{
            return view('storage', compact('storage'));
        }
    }
}