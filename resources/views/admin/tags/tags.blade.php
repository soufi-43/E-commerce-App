@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tags</div>

                    <div class="card-body">
                        <form action="{{route('tags')}}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-6">

                                <label for="tag_name">Tag Name</label>
                                <input type="text" class="form-control" name="tag_name" id="tag_name"
                                       placeholder="Tag Name" required>


                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New Tag</button>
                            </div>


                        </form>
                        <div class="row">
                            @foreach($tags as $tag)

                                <div class="col-md-3">
                                    <div class="alert alert-primary" role="alert">
                                        <span class="buttons-span">
                                            <span><a class="edit-unit" data-tagname="{{$tag->tag}}"

                                                     data-tagid="{{$tag->id}}"><i class="fas fa-edit"></i></a></span>
                                            <span><a class="delete-unit"
                                                     data-tagname="{{$tag->tag}}"

                                                     data-tagid="{{$tag->id}}"><i
                                                        class="fas fa-trash-alt"></i></a></span>



                                        </span>

                                        <p>{{$tag->tag}}</p>
                                    </div>
                                </div>



                            @endforeach

                                {{ (!is_null($showLinks)&&$showLinks) ? $tags->links():''}}
                            <form action="{{route('search-tags')}}" method="get">
                                <div class="row">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="tag_search" id="tag_search"
                                               placeholder="Search Tag" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('message'))

        <div class="toast" style="position: absolute; top: 5%; right: 5%;">
            <div class="toast-header">
                <strong class="mr-auto">Tag</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">

                {{Session::get('message')}}
            </div>
        </div>

    @endif

    <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="delete-message"></p>
                </div>
                <form action="{{route('tags')}}" method="post" style="position: relative;">
                    @csrf
                    <div class="modal-body">
                        <p id="delete-message"></p>

                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="tag_id" value="" id="tag_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal edit-window" id="edit-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">edit Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tags')}}" method="post" >

                    <div class="modal-body">
                        @csrf
                        <p id="delete-message"></p>
                    </div>

                    <div class="form-group col-md-6">

                        <label for="edit_tag_name">Tag Name</label>
                        <input type="text" class="form-control" name="tag_name" id="edit_tag_name"
                               placeholder="Tag Name" required>

                    </div>


                    <input type="hidden" name="_method" value="put">

                    <input type="hidden" name="tag_id" id="edit_tag_id">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script>

        $(document).ready(function () {
            var $deleteUnit = $('.delete-unit');
            var $deleteWindow = $('#delete-window');
            var $deleteMessage = $('#delete-message');

            var $tagID = $('#tag_id');
            $deleteUnit.on('click', function (element) {
                element.preventDefault();
                var tag_id = $(this).data('tagid');
                $tagID.val(tag_id);
                $deleteMessage.text('Are you sure you want to delete tag ? ');
                $deleteWindow.modal('show');


            });

            var $editTag = $('.edit-unit');

            var $editWindow = $('#edit-window');
            var $edit_tag_name = $('#edit_tag_name');
            var $edit_tag_id = $('#edit_tag_id');


            $editTag.on('click', function (element) {
                element.preventDefault();
                var tag_id = $(this).data('tagid');
                var tagName = $(this).data('tagname');

                $edit_tag_id.val(tag_id);
                $edit_tag_name.val(tagName);


                $editWindow.modal('show');

            })



        })

    </script>



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







