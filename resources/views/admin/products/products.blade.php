@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products<a class="btn btn-primary" href="{{route('new-product')}}"><i
                                class="fas fa-plus-circle"></i></a></div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($products as $product)

                                <div class="col-md-4">
                                    <div class="alert alert-primary" role="alert">
                                        <h5>{{$product->title}}</h5>
                                        <p>Category
                                            : {{ (is_object($product->category)) ? $product->category->name :''}}</p>
                                        <p>Price : {{$currency_code}}{{$product->price}}</p>
                                        {!! (count($product->images)>0) ? '<img class="img-thumbnail card-img" src="'.$product->images[0]->url.'"/>' : ""  !!}


                                        @if(!is_null($product))
                                            <table id="options-table" class="table table-striped">
                                            @if(!is_null($product->jsonOptions()))
                                                @foreach($product->jsonOptions() as $optionName=>$options)
                                                    @foreach($options as $option)
                                                        <tr>
                                                            <td>{{$optionName}}</td>
                                                            <td>{{$option}}</td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </table>
                                            @endif
                                        @endif


                                        <a class="btn btn-success mt-2"
                                           href="{{route('update-product',['id'=>$product->id])}}">Update Product</a>
                                    </div>
                                </div>


                            @endforeach

                            {{$products->links()}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @if(Session::has('message'))

        <div class="toast" style="position: absolute; top: 5%; right: 5%;">
            <div class="toast-header">
                <strong class="mr-auto">Products</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">

                {{Session::get('message')}}
            </div>
        </div>

    @endif




@endsection

@section('scripts')


    @if(Session::has('message'))
        <script>
            jQuery(document).ready(function ($) {
                var $toast = $('.toast').toast({
                    autohide: false
                });
                $toast.toast('show');
            });

        </script>


    @endif
@endsection

