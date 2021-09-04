@extends('layouts.app')

@section('content')
    <header class="row justify-content-between align-items-center">
        <h2>{{$user->name}} </h2>
        <p> {{ Str::plural( 'Comment', $count) }}: {{$count}}</p>
    </header>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @foreach( $comments as $comment )
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="name">
                            <img src="{{asset('images/avatars')}}/{{$comment->user->avatar}}" width="30" alt="">
                            <a href="{{route('show.user.comments', $comment->user->id)}}">{{$comment->user->name}}</a>
                        </div>
                        @can('update', $comment)
                            <div class="comments-links">
                                <a class="text-success mr-1" href="" data-toggle="modal"
                                   data-target="#commentEditModal{{$comment->id}}">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <a class="text-danger" href="#" data-toggle="modal"
                                   data-target="#commentModal{{$comment->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <!-- Modal edit comment-->
                                <div class="modal fade" id="commentEditModal{{$comment->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit comment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('comments.update', $comment)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                    <textarea class="form-control" placeholder="Write your comment"
                                                              name="text" rows="7">{{$comment->text}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal delete comment -->
                                <div class="modal fade" id="commentModal{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                The record will be deleted.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel
                                                </button>
                                                <form action="{{route('comments.destroy', $comment)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! nl2br($comment->text) !!}</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <small>
                                {{$comment->created_at->diffForHumans()}}
                            </small>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ $comments->links() }}
        </div>
    </div>




@endsection
