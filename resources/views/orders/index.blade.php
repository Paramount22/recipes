@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Orders
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">User</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $key => $order)
                        <tr>

                            <th scope="row">{{$key + 1}}</th>
                            <td><a href="{{route('orders.show', $order)}}">{{$order->created_at}}</a></td>
                            <td>{{$order->user->name}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                        data-target="#exampleModal-{{$order->id}}">
                                    Delete
                                </button>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{$order->id}}" tabindex="-1"
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
                                               Order will be deleted.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{route('orders.destroy', $order)}}" method="post">@csrf
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
                   Create new order
               </div>
               <div class="card-body">
                   <form action="{{route('orders.store')}}" method="post">
                       @csrf
                       <div class="btn-group">
                           <button class="btn btn-primary">Create</button>
                       </div>
                   </form>
               </div>
           </div>
        </div>
    </div>

@endsection
