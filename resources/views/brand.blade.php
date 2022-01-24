@extends('welcome')
@section('content')
    <div class="my-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Cart List : <span class="bg-danger p-1 ox-2">  {{count($addtocartList)}}</span>
          </button>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Cart List</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                  @foreach ($addtocartList as $item)
                    <div class="col-md-12 mt-4">
                        <form action="{{route('placeOrder')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$item['product']['id']}}">
                        <input type="hidden" name="cart_id" value="{{$item['id']}}">
                            <div class="card">
                                 <div class="card-header">{{$item['product']['name']}}</div>
                                 <div class="card-body">
                                     <input type="hidden" class="one_product_price" value="{{$item['product']['price']}}">
                                    <p class="price_details"><strong> price :</strong> <input type="number" name="product_price" class="product_price" readonly value="{{$item['product']['price']}}"></p>
                                    <p><strong>description :</strong>  {{$item['product']['description']}}</p>
                                    <p class="d-flex">
                                        <strong>no of item :</strong>
                                         <div class="d-flex mx-2 product_details">
                                               <input type="number" name="no_item" class="no_item" value="1" readonly>
                                               <div class="btn btn-primary mx-2 more">+</div>
                                               <div class="btn btn-danger mx-2 less">-</div>
                                         </div>
                                       </p>
                                 </div>
                                 <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="Place Order">
                                 </div>
                            </div>
                        </form>
                    </div>
                  @endforeach
              </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>
      
    <div class="container-fluid">
        <div class="card mt-4">
           <div class="card-header text-center">Brand List</div>
           <div class="card-body">
               <div class="row">
                   @foreach ($brands as $item)
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-header">{{$item['name']}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach ($item['product'] as $product)
                                            <div class="card">
                                                <div class="card-header text-center">{{$product['name']}}</div>
                                                <div class="card-body">
                                                    <p>stock : {{$product['stock']}}</p>
                                                    <p>price : {{$product['price']}}</p>
                                                    <p>description : {{$product['description']}}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <form action="{{route('addToCart')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product['id']}}">
                                                        <button type="submit" class="btn btn-primary">Add to cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
           </div>
    </div>
    </div>
    <script>
        $(document).ready(function(){
            $('body').on('click','.more',function(){
                var currenttvalue = $(this).parents('.product_details').find('.no_item').val();
                var currentprice = $(this).parents('.card-body').find('.one_product_price').val();
                $(this).parents('.product_details').find('.no_item').val((parseInt(currenttvalue)+1));
                $(this).parents('.card-body').find('.price_details .product_price').val((currentprice*(parseInt(currenttvalue)+1)))
            });
            $('body').on('click','.less',function(){
                var currenttvalue = $(this).parents('.product_details').find('.no_item').val();
                var currentprice = $(this).parents('.card-body').find('.one_product_price').val();
                $(this).parents('.product_details').find('.no_item').val((parseInt(currenttvalue)-1));
                $(this).parents('.card-body').find('.price_details .product_price').val((currentprice*(parseInt(currenttvalue)-1)))
            });
        });
    </script>
@endsection