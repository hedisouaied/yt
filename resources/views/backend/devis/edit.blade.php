@extends('backend.layouts.master')


@section('content')


<div class="main-content">

<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>

<div class="col-md-12">
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)

                    <li>{{$error}}</li>

                    @endforeach

                </ul>
            </div>
    @endif
</div>


<h4 class="box-title">Commande num #{{$item->id}} (Ajouter un produit au commande)</h4>

<div class="col-md-12 col-xs-12">
    <div class="box-content">

        <form action="{{route('devis.ajoutproduct',$item->id)}}" method="POST" >

            @csrf

            <div>
            <select class="form-control select2_1" name="prod_id" >

                @foreach ($products as $product )
                    <option value="{{$product->id}}">{{$product->title}}</option>
                @endforeach

            </select>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-info" >Ajouter ce produit à cette commande</button>
            </div>

        </form>

    </div>
    <!-- /.box-content -->
</div>
<!-- /.col-md-6 -->

<h4 class="box-title">Commande num #{{$item->id}} (Modifier les quantités)</h4>

@php
    $array_prod = explode('/',$item->prod_ids);
    $array_quantite = explode('/',$item->quantite);
    $array_prix = explode('/',$item->prix);
    $total = 0 ;

    $count = count($array_prod) ;
@endphp

<form action="{{route('devis.modifier',$item->id)}}" method="POST"  >
    <div class="alert alert-warning" ><i class="fa fa-exclamation-triangle"></i> Pour supprimer un produit de cette commande , il suffit de modifier sa quantité en 0 !</div>
    <div class="alert alert-warning" ><i class="fa fa-exclamation-triangle"></i> s'il reste <u>un produit</u> dans votre commande, <b>vous ne pouvez pas le supprimer</b>  !</div>
    <div class="alert alert-warning" ><i class="fa fa-exclamation-triangle"></i> Si vous voulez supprimer la commande : utiliser <i class="fa fa-trash" style="font-size: 33px;" ></i> dans <b>la liste des commandes</b> !</div>

    @csrf
    <table class="table table-bordered table-striped">
        <tbody>
        @if($item->prod_ids != "")
            @for ($i = 0; $i < count($array_prod); $i++)

                @php
                    $product = (\App\Models\Product::where('id',$array_prod[$i])->first());
                @endphp

                @if ($product)
                
            
                    <tr>
                        <td style="width: 35%">{{\App\Models\Product::where('id',$array_prod[$i])->value('title')}}</td>
                        <td>{{number_format($array_prix[$i],3)}}TND</td>
                        <td>
                            <input type="number" name="quantity[]" value="{{$array_quantite[$i]}}" @if ($count == 1)
                                min="1"
                            @else
                            min="0"
                            @endif  >
                            <input type="hidden" name="id[]" value="{{$array_prod[$i]}}"  >
                            <input type="hidden" name="price[]" value="{{$array_prix[$i]}}"  >
                        </td>
                    </tr>
                    
                @endif
            @endfor

        
            <tr>
                <td style="width: 35%"> </td>
                <td> </td>
                <td><button type="submit" class="btn btn-warning" >Modifier</button></td>
            </tr>
        @else
            no products : commande à supprimer
        @endif 

        </tbody>
    </table>
</form>
</div>

@endsection

@section('scripts')



@endsection
