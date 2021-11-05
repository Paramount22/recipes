@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Items
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order->items as $key => $item)
                            <tr>

                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->name}}</td>
                                <td>
                                    1

                                    <i class="fas fa-plus"></i>
                                    <i class="fas fa-minus"></i>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#exampleModal-{{$item->id}}">
                                        Delete
                                    </button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Item will be deleted.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{route('items.destroy', $item)}}"
                                                          method="post">@csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>No orders</tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add new item
                </div>
                <div class="card-body">
                    <form action="{{route('items.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input class="form-control @error('name') is-invalid
                                    @enderror" type="number" name="name" value="{{old('name')}}"  autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <input type="hidden" name="order_id" value="{{$order->id}}">

                        <div class="form-group">
                            <button class="btn btn-primary">Create</button>
                            <a href="{{route('orders.index')}}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
