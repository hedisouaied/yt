<?php

namespace App\Http\Controllers;

use App\Exports\ListeParticipantExport;
use App\Exports\TousParticipantExport;
use App\Models\Checkout;
use App\Models\devis;
use App\Models\Passager;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class devisAdminController extends Controller
{
    public function index(Request $request)
    {

        $devis = Checkout::where('id','!=',0);

        if(isset($request->gouvernorat) && ($request->gouvernorat != "")){
            $users = User::where('gouvernorat',$request->gouvernorat)->get();

            $passagers = Passager::where('gouvernorat',$request->gouvernorat)->get();

            $array_id_user = array();
            foreach($users as $user){
                $array_id_user[] = $user->id;
            }

            $array_id_pass = array();
            foreach($passagers as $passager){
                $array_id_pass[] = $passager->id;
            }

            $devis = $devis->Where(function ($query) use ($array_id_user, $array_id_pass) {
                $query->whereIn('sess_id', $array_id_user)
                      ->orWhereIn('pass_id', $array_id_pass);
            });

        }

        if(isset($request->etat_filtre) && ($request->etat_filtre != "")){

            $devis = $devis->where('etat',$request->etat_filtre);
        }


        if(isset($request->date_debut) && ($request->date_debut != "")){


            $devis = $devis->where('created_at','>=',$request->date_debut);
        }

        if(isset($request->date_fin) && ($request->date_fin != "")){


            $devis = $devis->where('created_at','<=',$request->date_fin);
        }


        $devis = $devis->orderby('id', 'DESC')->get();

        return view('backend.devis.index', compact('devis'));
    }


    public function index_jour()
    {
        $devis = Checkout::whereDate('created_at', '=', date('Y-m-d'))->orderby('id', 'DESC')->get();

        return view('backend.devis.index_jour', compact('devis'));
    }


    public function index_encours()
    {
        $devis = Checkout::where('etat', 'encours')->orderby('id', 'DESC')->get();

        return view('backend.devis.index_encours', compact('devis'));
    }


    public function index_accepte()
    {
        $devis = Checkout::where('etat', 'accepte')->orderby('id', 'DESC')->get();

        return view('backend.devis.index_accepte', compact('devis'));
    }


    public function index_delivred()
    {
        $devis = Checkout::where('etat', 'delivred')->orderby('id', 'DESC')->get();

        return view('backend.devis.index_delivred', compact('devis'));
    }

    public function index_refuse()
    {
        $devis = Checkout::where('etat', 'refuse')->orderby('id', 'DESC')->get();

        return view('backend.devis.index_refuse', compact('devis'));
    }




    public function devisClient(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {

            $devis = Checkout::where('sess_id',$user->id)->orderby('id', 'DESC')->get();

            return view('backend.devis.indexclient', compact(['devis','user']));

        } else {
            return back()->with('error', 'Data not found');
        }


    }




    public function listeParticipantTous(Request $request)
    {



        $deviss = Checkout::where('id','!=',0);

        if(isset($request->gouvernorat) && ($request->gouvernorat != "")){
            $users = User::where('gouvernorat',$request->gouvernorat)->get();

            $passagers = Passager::where('gouvernorat',$request->gouvernorat)->get();

            $array_id_user = array();
            foreach($users as $user){
                $array_id_user[] = $user->id;
            }

            $array_id_pass = array();
            foreach($passagers as $passager){
                $array_id_pass[] = $passager->id;
            }

            $devis = $deviss->Where(function ($query) use ($array_id_user, $array_id_pass) {
                $query->whereIn('sess_id', $array_id_user)
                      ->orWhereIn('pass_id', $array_id_pass);
            });

        }

        if(isset($request->etat_filtre) && ($request->etat_filtre != "")){

            $devis = $deviss->where('etat',$request->etat_filtre);
        }


        if(isset($request->date_debut) && ($request->date_debut != "")){


            $devis = $deviss->where('created_at','>=',$request->date_debut);
        }

        if(isset($request->date_fin) && ($request->date_fin != "")){


            $devis = $deviss->where('created_at','<=',$request->date_fin);
        }


        $deviss = $deviss->orderby('id', 'DESC')->get();



        $tous_participant = array();

        $tous_participant[]=['Commande numèro :','Etat de commande : ','Date : ','','Nom & Prenom : ','Numèro téléphone : ','Email : ','Gouvernorat : ','Adresse : '];

        foreach($deviss as $devis){

            if($devis->sess_id != NULL){
                $user = User::where('id',$devis->sess_id)->first() ;
            }


            if($devis->pass_id != NULL){
                $user = Passager::where('id',$devis->pass_id)->first() ;
            }


                $participant = array();

                $participant[]='#'.$devis->id;


                $participant[]=''.$devis->etat;

                $participant[]=''.$devis->created_at;

                $participant[]='A propos client ';

                $participant[]=''.$user->full_name;
                $participant[]=''.'tel:'.$user->phone;
                $participant[]=''.$user->email;
                $participant[]=''.$user->gouvernorat;
                $participant[]=''.$user->address;


                $array_prod = explode('/',$devis->prod_ids);
                $array_quantite = explode('/',$devis->quantite);
                $array_prix = explode('/',$devis->prix);
                $total = 0 ;


                if($devis->prod_ids != ""){
                    for ($i = 0; $i < count($array_prod); $i++){

                        $product = Product::where('id',$array_prod[$i])->first();

                        if($product){

                        $participant[]='Produit '.($i+1);
                        $participant[]=$product->title;
                        $participant[]='Quantité : '.$array_quantite[$i].' pièce(s)';
                        $participant[]='Prix unitaire : '.$array_prix[$i].' TND';
                        $participant[]='Prix : '.($array_quantite[$i]*$array_prix[$i]).' TND';


                        $total = $total + ($array_prix[$i]*$array_quantite[$i]) ;
                        }

                    }
                }


                $participant[]='Sous Total :'.$total.' TND';

                $participant[]='Prix de livraison: :'.$devis->prix_livraison.' TND';
                $total = $total+($devis->prix_livraison);


                if( ($devis->reduction_points) == "0" ){

                    //points fidelite

                    $participant[]='réduction points fidélité : -0 TND';
                    $total = $total-0;

                }else{

                   //points fidelite

                   $participant[]='réduction points fidélité :'.'-'.number_format(($devis->reduction_points),2).' TND';

                   $total = $total-($devis->reduction_points);

                }


                if($devis->coupon_discount !== NULL ){
                    //coupon

                    $participant[]='réduction coupon :'.'-'.(($total*$devis->coupon_discount)/100).' TND';

                    $total = $total-(($total*$devis->coupon_discount)/100);

                }else{
                    $participant[]='réduction coupon :-0 TND';

                }

                //total
                $participant[]='Total :'.$total.' TND';


                $tous_participant[]=$participant;


        }

        $export = new TousParticipantExport([$tous_participant]);

        //  return Excel::download( $export, 'Commande-'.$devis->id.'-v-'.date('h-m-d-m-y').'.xlsx');

        return Excel::download($export, 'Commandes-v-'.date('h-m-d-m-y').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="Commandes-v-'.date('h-m-d-m-y').'.xlsx"'
        ]);



    }


    public function listeParticipant(Request $request, $id)
    {
        $devis = Checkout::find($id);
        if ($devis) {


            if($devis->sess_id != NULL){
                $user = User::where('id',$devis->sess_id)->first() ;
            }


            if($devis->pass_id != NULL){
                $user = Passager::where('id',$devis->pass_id)->first() ;
            }


                $participant[]=['Commande numèro #'.$devis->id,'Date : '.$devis->created_at];

                $participant[]=['A propos client : ','',''];
                $participant[]=['Nom & Prenom','Numèro téléphone','Email','Gouvernorat','Adresse'];
                $participant[]=[$user->full_name,'tel:'.$user->phone,$user->email,$user->gouvernorat,$user->address];


                $participant[]=['','',''];

                $array_prod = explode('/',$devis->prod_ids);
                $array_quantite = explode('/',$devis->quantite);
                $array_prix = explode('/',$devis->prix);
                $total = 0 ;

                $participant[]=['Nom de produit','Quantité','Prix unitaire',"Prix d'achat"];
                $participant[]=['','',''];

                if($devis->prod_ids != ""){
                    for ($i = 0; $i < count($array_prod); $i++){

                        $product = Product::where('id',$array_prod[$i])->first();
                        if($product){
                        $participant[]=['Produit '.($i+1),'',''];
                        $participant[]=[$product->title,$array_quantite[$i].' pièce(s)',$array_prix[$i].' TND',($array_quantite[$i]*$array_prix[$i]).' TND'];

                        $total = $total + ($array_prix[$i]*$array_quantite[$i]) ;

                        $participant[]=['','',''];
                        }

                    }
                }


                $participant[]=['','','','','','Sous Total :'];

                $participant[]=['','','','','',$total.' TND'];



                $participant[]=['','','','','','Prix de livraison :'];

                $participant[]=['','','','','',$devis->prix_livraison.' TND'];

                $total = $total+($devis->prix_livraison);



                if( ($devis->reduction_points) == "0" ){

                    //points fidelite

                    $participant[]=['','','','','','réduction points fidélité :'];

                    $participant[]=['','','','','','-0 TND'];

                    $total = $total-0;
                }else{

                   //points fidelite

                   $participant[]=['','','','','','réduction points fidélité :'];

                   $participant[]=['','','','','','-'.number_format(($devis->reduction_points),2).' TND'];

                   $total = $total-($devis->reduction_points);
                }


                if($devis->coupon_discount !== NULL ){
                    //coupon

                    $participant[]=['','','','','','réduction coupon :'];

                    $participant[]=['','','','','','-'.(($total*$devis->coupon_discount)/100).' TND'];

                    $total = $total-(($total*$devis->coupon_discount)/100);
                }else{
                    $participant[]=['','','','','','réduction coupon :'];

                    $participant[]=['','','','','','-0 TND'];

                }

                //total
                $participant[]=['','','','','','Total :'];

                $participant[]=['','','','','',$total.' TND'];




                $export = new ListeParticipantExport([$participant]);

              //  return Excel::download( $export, 'Commande-'.$devis->id.'-v-'.date('h-m-d-m-y').'.xlsx');


                return Excel::download($export, 'Commande-'.$devis->id.'-v-'.date('h-m-d-m-y').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
                    'Content-Type' => 'application/vnd.ms-excel',
                    'Content-Disposition' => 'attachment; filename="Commande-'.$devis->id.'-v-'.date('h-m-d-m-y').'.xlsx"'
                ]);


        }else{
            return back()->with('error', 'data not found');
        }
    }



    public function edit($id)
    {

        $item = Checkout::find($id);
        if ($item) {



            $array_prod = explode('/',$item->prod_ids);



            $products = Product::whereNotIn('id', $array_prod)->orderBy('title','ASC')->get();


            return view('backend.devis.edit', compact(['item','products']));
        } else {
            return back()->with('error', 'clients not found');
        }
    }

    public function update(Request $request, $id)
    {
        $blog = Checkout::find($id);
        if ($blog) {

            $this->validate($request, [
                'etat' => 'nullable|in:encours,accepte,refuse,delivred',
            ]);
            $data = $request->all();

            $points = 0 ;

            if($blog->sess_id != NULL){
                $user = User::find($blog->sess_id);
                $points = $user->points;
            }

            if ($request->etat == "accepte") {



                $array_prod = explode('/',$blog->prod_ids);
                $array_quantite = explode('/',$blog->quantite);
                $array_prix = explode('/',$blog->prix);
                $total = 0 ;

                if($blog->prod_ids != ""){
                    for ($i = 0; $i < count($array_prod); $i++){

                        $products = Product::find($array_prod[$i]);
                        $data_prod['stock'] = $products->stock - $array_quantite[$i] ;
                        $products->fill($data_prod)->save();

                        $total = $total + ($array_prix[$i]*$array_quantite[$i]) ;
                    }

                    $points = $points+((int)($total)) ;
                }
            }

            if (($request->etat == "encours" ) && ($blog->etat == "accepte") ) {



                $array_prod = explode('/',$blog->prod_ids);
                $array_quantite = explode('/',$blog->quantite);
                $array_prix = explode('/',$blog->prix);
                $total = 0 ;

                if($blog->prod_ids != ""){
                    for ($i = 0; $i < count($array_prod); $i++){

                        $products = Product::find($array_prod[$i]);
                        $data_prod['stock'] = $products->stock + $array_quantite[$i] ;
                        $products->fill($data_prod)->save();

                        $total = $total + ($array_prix[$i]*$array_quantite[$i]) ;
                    }

                    $points = $points-((int)($total)) ;
                }
            }


            if($blog->sess_id != NULL){
                $status1 = $user->update(['points'=>$points]);
            }


            $array_operation = array();
            if($blog->operations_admin == ""){
                $array_operation[] = Auth::user()->id.'-changer état de commande ('.$request->etat.')';

            }else{
                $array_operation = explode('/',$blog->operations_admin);
                $array_operation[] = Auth::user()->id.'-changer état de commande ('.$request->etat.')';
            }
            $data['operations_admin'] = implode('/',$array_operation);



            $status = $blog->fill($data)->save();
            if ($status) {
                return back()->with('success', 'Commande modifié avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function devisModifier(Request $request, $id)
    {

        $blog = Checkout::find($id);

        if ($blog) {

            $array_operation = array();

            if($blog->operations_admin == ""){
                $array_operation[] = Auth::user()->id.'-changer quantité de produits de commande ' ;
            }else{
                $array_operation = explode('/',$blog->operations_admin);
                $array_operation[] = Auth::user()->id.'-changer quantité de produits de commande ' ;
            }

            $data['operations_admin'] = implode('/',$array_operation);





            $array_prods = array();
            $array_quantity = array();
            $array_prix = array();

            $count = count($request->id);

            for($i=0;$i<$count ;$i++ ){

                if($request->quantity[$i] !== "0"){

                $array_prods[]= $request->id[$i];
                $array_quantity[]= $request->quantity[$i];
                $array_prix[]=$request->price[$i];
                }

            }

            $data['prod_ids'] = implode('/',$array_prods);
            $data['quantite'] = implode('/',$array_quantity);
            $data['prix'] = implode('/',$array_prix);

            //dd($data);

            if(count($array_prods) != 0){
                $status = $blog->fill($data)->save();
                if ($status) {

                    return back()->with('success', 'Commande modifié avec succès');
                } else {
                    return back()->with('error', 'something went wrong!');
                }
            }else{
                return back()->with('error', 'vous ne pouvez pas supprimer tous les produits de commandes');
            }

        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function devisAjoutProduct(Request $request, $id)
    {

        $blog = Checkout::find($id);

        if ($blog) {


            $array_operation = array();

            if($blog->operations_admin == ""){
                $array_operation[] = Auth::user()->id.'-ajouter produit au commande ';
            }else{
                $array_operation = explode('/',$blog->operations_admin);
                $array_operation[] = Auth::user()->id.'-ajouter produit au commande ';
            }

            $data['operations_admin'] = implode('/',$array_operation);




            if($blog->prod_ids != ""){

            $array_prod = explode('/',$blog->prod_ids);
            $array_quantite = explode('/',$blog->quantite);
            $array_prix = explode('/',$blog->prix);
            }else{
                $array_prod = array();
                $array_quantite = array();
                $array_prix = array();
            }
            //dd($request->prod_id);
            $product = Product::find($request->prod_id);

            $array_prod[] = $product->id ;
            $array_quantite[] = 1 ;
            $array_prix[] =($product->price-$product->discount) ;




            $data['prod_ids'] = implode('/',$array_prod);
            $data['quantite'] = implode('/',$array_quantite);
            $data['prix'] = implode('/',$array_prix);

            //dd($data);


            $status = $blog->fill($data)->save();
            if ($status) {
                return back()->with('success', 'Commande modifié avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }


        } else {
            return back()->with('error', 'Data not found');
        }
    }



    public function devisRemarque(Request $request, $id)
    {

        $blog = Checkout::find($id);
        if ($blog) {

            $this->validate($request, [
                'remarque' => 'nullable',
            ]);
            $data = $request->all();

            $array_operation = array();

            if($blog->operations_admin == ""){
                $array_operation[] = Auth::user()->id.'-changer remarque';
            }else{
                $array_operation = explode('/',$blog->operations_admin);
                $array_operation[] = Auth::user()->id.'-changer remarque';
            }

            $data['operations_admin'] = implode('/',$array_operation);



            $status = $blog->fill($data)->save();
            if ($status) {
                return back()->with('success', 'Commande modifié avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devis = Checkout::find($id);
        if ($devis) {
            $status = $devis->delete();
            if ($status) {
                return redirect()->route('devis.index')->with('success', 'Commande supprimé avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
