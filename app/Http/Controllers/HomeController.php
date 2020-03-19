<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Clientes;
use App\Vendas;
use App\Estoque;
use Illuminate\Support\Facades\DB;
use View;

class HomeController extends Controller
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

    public function store_clients(Request $request){
        $id = $request->get('id', false);
        $attr['id_user']= Auth::id();
        $attr['name']= $request->name;
        $attr['email']= $request->email;
        $attr['telefone']= $request->telefone;
        $attr['whatsapp']= $request->whatsapp;
        $attr['divida_total'] = 0; //Total de dividas sempre vai ser iniciado em 0
        if($attr['email'] == ''){
            $attr['email']= 'Sem informação';
        }

        try{
            if($id){
                $total_debt = Clientes::query()->where('id', '=', $id)->get('divida_total');
                $attr['divida_total'] = $total_debt[0]['divida_total'];
                $client = Clientes::find($id);
                $client->fill($attr);
                $client->save();
                flash("Cliente Atualizado!")->success();
                return redirect()->route('clients');
            }
            else{
                Clientes::create($attr);
                flash("Cliente Registrado!")->success();
                return redirect()->route('clients');
            }     
        }
        catch (\Exception $e) {
            flash("ERROR")->error();
            return redirect()->route('home');
        }  
    }

    public function store_sales(Request $request){
        try{
            $id = $request->get('id', false);
            $attr['id_client']= $request->id_client;
            $attr['product']= $request->product;
            $attr['original_price']= $request->original_price;
            $attr['status'] = 0;
            if($id){
                $attr['current_price']= $request->current_price - $request->value_paid; //Se for uma edição, editar o current_price para o valor atual
            }
            else{
                $attr['current_price']= $request->original_price;  //Caso for criado uma nova venda, o valor do current_price, vai ser igual ao preço original da compra
            }
            $attr['latest_paiment']= $request->latest_paiment;
            $attr['description']= $request->description;
            $attr['divida_total'] = 0;

            if($id){
                $sale = Vendas::find($id);
                $sale->fill($attr);
                $sale->save();
                flash('Cliente Editado!')->warning();
                return redirect()->route('client_details', [$id => $attr['id_client']]);
            }
            else{
                $value = Clientes::query()->where('id', '=', $attr['id_client'])->get('divida_total');
                $newDebt =  $value[0]['divida_total'] + $request->original_price;
                Clientes::find($attr['id_client'])->update(['divida_total' => $newDebt]);
                Vendas::create($attr);
            }
            flash('Compra Registrada!')->success();
            return redirect()->route('client_details', [$id => $attr['id_client']]);
        }
        catch(\Exception $e){
            flash("ERROR")->error();
            return redirect()->route('clients');
        }
    }

    public function search_clients(Request $request){
        $search_name = $request->search;
        $clients = Clientes::query()->where('name', 'LIKE', '%' . $search_name . '%')->where('id_user', '=', Auth::id())->get();
        if ($clients->isEmpty()){
            flash('Cliente não encontrado')->error();
            return redirect()->route('clients');
        }
        else{
            return view('clients', compact('clients'));
        }
    }

    public function client_details($id){ 
        try{
            $head = Clientes::find($id);
            $sales = DB::table('vendas')->where('id_client', '=', $id)->where('status', '=', 0)->latest()->OrderBy('created_at')->get();
            return view('client_details', ['id'=>$id], array_merge(['head' => $head], ['sales' => $sales]));
        }
        catch (\Exception $e) {
            flash("ERROR")->error();
            return redirect()->route('clients');
        }
    }


    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function clients()
    {
        $clients = DB::table('clientes')->where('id_user', '=', Auth::id())->latest()->OrderBy('created_at')->get();
        return view('clients', compact('clients'));
    }

    public function delete($id){ 
        try{
            $head = Clientes::find($id);
                if($head->id_user == Auth::id()){
                    $clients_purchases = Vendas::where('id_client', '=', $head->id)->get('id');

                    foreach($clients_purchases as $value){
                        Vendas::find($value->id)->delete(); // Deleta todas as vendas do cliente caso o cliente seja excluido
                    }

                    $head->delete();
                    return redirect()->route('clients');
                }
                else{
                    flash('Cliente não encontrado!')->error();
                    return redirect()->route('clients');
                }
        }
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }
    }

    public function delete_sales($id){ 
        try{
            $sales_head = Vendas::find($id);
            $verify = Clientes::find($sales_head->id_client);

            if($verify->id_user == Auth::id()){
                $id_client = $sales_head['id_client'];
                $total_debt = DB::table('clientes')->where('id', '=', $sales_head['id_client'])->get('divida_total');
                $new_total_debt = $total_debt[0]->divida_total - $sales_head['current_price'];
                Clientes::find($sales_head['id_client'])->update(['divida_total' => $new_total_debt]);
                $sales_head->delete();
                return redirect()->route('client_details', [$id => $id_client]);
            }
            else{
                flash('Cliente não encontrado!')->error();
                return redirect()->route('clients');
            }
        }
        catch (\Exception $e) {
            flash("ERROR")->error();
            return redirect()->route('home');
        }
    }

    public function sales_details($id){ 
        try{
            $head = Vendas::find($id);
            $verify = Clientes::find($head->id_client);
            
            if($verify->id_user == Auth::id()){
                return view('sales_details', array_merge(['head' => $head]));
            }
            else{
                flash('Cliente não encontrado!')->error();
                return redirect()->route('clients');
            }
        }
        catch (\Exception $e) {
            flash($e)->error();
            //return redirect()->route('home');
        }
    }

    public function payment(Request $request){ 
        try{
            $id = $request->id_sale;
                //Verificações
                if($request->value_paid > $request->missing_value){
                    flash('Valor pago maior que o valor faltante!')->error();
                    return redirect()->route('sales_details', [$id => $id]);
                }
                if($request->value_paid <= 0){
                    flash('Valor pago Vazio!')->error();
                    return redirect()->route('sales_details', [$id => $id]);
                }
                //Querys
            $total_debt = DB::table('clientes')->where('id', '=', $request->id_client)->get('divida_total');
            $updated_total_debt = $total_debt[0]->divida_total - $request->value_paid;
            $updated_missing_value = $request->missing_value - $request->value_paid;
            $updated_latest_paiment = $request->value_paid;

                //Updates no banco
            Clientes::find($request->id_client)->update(['divida_total' => $updated_total_debt]);
            Vendas::find($request->id_sale)->update(['current_price' => $updated_missing_value]);
            Vendas::find($request->id_sale)->update(['latest_paiment' => $updated_latest_paiment]);
            Vendas::find($request->id_sale)->update(['description' => $request->description]);
            
            return redirect()->route('clients');
        }
        catch (\Exception $e) {
            flash("ERROR")->error();
            return redirect()->route('home');
        }
    }

    public function payoff($id){
        try{
            $sales_head = Vendas::find($id);
            $verify = Clientes::find($sales_head->id_client);

            if($verify->id_user == Auth::id()){
                $id_client = $sales_head['id_client'];
                $total_debt = DB::table('clientes')->where('id', '=', $sales_head['id_client'])->get('divida_total');
                $new_total_debt = $total_debt[0]->divida_total - $sales_head['current_price'];
                Clientes::find($sales_head['id_client'])->update(['divida_total' => $new_total_debt]);
                Vendas::find($id)->update(['status' => 1]);
            }
            else{
                flash('Cliente não encontrado!')->error();
                return redirect()->route('clients');
            }
            flash('Divida Quitada')->warning();
            return redirect()->route('client_details', [$id => $id_client]);
        }
        catch (\Exception $e) {
            flash("ERROR")->error();
            return redirect()->route('home');
        }
    }


    // Controller de Visão Geral | OBS: Vai ser pouca coisa então nao quis gerar um controller novo pra isso


    public function indexGeral(){
        $profit = 0;
        $storage_buy = 0;
        $storage_sell = 0;
        $storage_count = 0;
        $clients_count = '';

        $alldebt = DB::table('clientes')
        ->where('id_user', '=', Auth::id())
        ->sum('divida_total');

        $high_debt = Clientes::where('id_user', '=', Auth::id())->max('divida_total');
        $mvp_client = DB::table('clientes')->where('divida_total', '=', $high_debt)->get();
            /*$high_buys = DB::table('vendas')
                            ->select('id_client', DB::raw('COUNT(id) as quant'))
                            ->groupBy('id_client')
                            ->orderBy(DB::raw('COUNT(id)'), 'DESC')
                            ->take(1)
                            ->get(); */

        $high_buys =DB::table('clientes')
                        ->where('id_user', '=', Auth::id())
                        ->join('vendas', 'clientes.id','=','id_client')
                        ->select('vendas.id_client', DB::raw('COUNT(vendas.id) as quant'))
                        ->groupBy('vendas.id_client')
                        ->orderBy(DB::raw('COUNT(vendas.id)'), 'DESC')
                        ->take(1)
                        ->get();

        if($high_buys->isEmpty()){
            $high_client_buys = '';
        }
        else{
            $high_client_buys = DB::table('clientes')
                                ->where('id_user', '=', Auth::id())
                                ->where('id', '=', $high_buys[0]->id_client)
                                ->get();  
        }
  
        $most_purchased_product =  DB::table('clientes')->where('id_user', '=', Auth::id())
                                    ->join('vendas','clientes.id','=','id_client')
                                    ->select('vendas.product')
                                    ->groupBy('vendas.product')
                                    ->orderByRaw('COUNT(*) DESC')
                                    ->limit(1)->get();

        if($most_purchased_product->isEmpty()){
            $most_purchased_product_count = '';
            $most_purchased_product = '';
        }
        else{
            $most_purchased_product_count = DB::table('clientes')->where('id_user', '=', Auth::id())
                                            ->join('vendas','clientes.id','=','id_client')
                                            ->where('vendas.product','=', $most_purchased_product[0]->product)
                                            ->count();
        }

        $clients_count = DB::table('clientes')->where('id_user', '=', Auth::id())
                            ->count('id');


        $var = DB::table('estoques')->where('id_user', '=',Auth::id())->get();
        foreach($var as $value){
            $profit = $profit + (($value->sell_price - $value->buy_price) * $value->quantity);
            $storage_buy = $storage_buy + ($value->buy_price * $value->quantity);
            $storage_sell = $storage_sell + ($value->sell_price * $value->quantity);
        }
        $storage_count = DB::table('estoques')->where('id_user', '=',Auth::id())->sum('quantity');


        return view('geral', compact('alldebt', 'mvp_client','high_client_buys','most_purchased_product','high_buys','most_purchased_product_count',
                                    'clients_count','storage_buy', 'storage_sell','storage_count','profit'));
    }
}
