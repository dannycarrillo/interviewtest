@extends('app')

@section('title')
COALITION PROJECT
@stop

@section('body')
<div class='container'>
    <div id="ownform">
        <form id="addForm" method='POST' action='/coalition-test/public/'>
            <input hidden name='_token' value='{{csrf_token()}}'>
            <div class='form-group'>
                <label for='description'>Product Name</label>
                <input type='text' name='description' name='description' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='quantity'>Quantity In Stock</label>
                <input type='text' name='quantity' name='quantity' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='price_per'>Price Per Item</label>
                <input type='text' name='price_per' name='price_per' class='form-control'>
            </div>
            <input type='text' name='date' hidden value="<?php echo date("Y-m-d h:i:s") ?>">
            <input type='submit' value='Create' class='btn btn-primary'>
        </form>
    </div>
    <div>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <td>
                        Product Name
                    </td>
                    <td>
                        Quantity In Stock
                    </td>
                    <td>
                        Price Per Item
                    </td>
                    <td>
                        Date Submitted
                    </td>
                    <td>
                        Total
                    </td>
                </tr>
            </thead>
            <tbody>
                @if (isset($jsonProducts))
                    @foreach($jsonProducts as $product)
                    <tr>
                        <td>
                            {{$product['description']}}
                        </td>
                        <td>
                            {{$product['quantity']}}
                        </td>
                        <td>
                            ${{$product['price_per']}}
                        </td>
                        <td>
                            {{$product['date']}}
                        </td>
                        <td>
                            ${{$product['price_per'] * $product['quantity']}}
                        </td>
                        <td>
                            <a href='delete/{{$product['description']}}' class="deleteElement"><span class='glyphicon glyphicon-remove'></span></a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <strong>Total: @if(isset($total))${{$total}} @endif</strong>
    </div>
</div>
@stop