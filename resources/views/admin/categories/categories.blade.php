@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        <form action="{{route('categories')}}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-6">

                                <label for="tag_name">Category Name</label>
                                <input type="text" class="form-control" name="category_name" id="category_name"
                                       placeholder="category Name" required>


                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New Category</button>
                            </div>


                        </form>

                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-md-3">
                                    <div class="alert alert-primary" role="alert">
                                        <span class="buttons-span">
                                            <span><a class="edit-unit" data-categoryname="{{$category->name}}"

                                                     data-categoryid="{{$category->id}}"><i class="fas fa-edit"></i></a></span>
                                            <span><a class="delete-unit"
                                                     data-categoryname="{{$category->name}}"

                                                     data-categoryid="{{$category->id}}"><i
                                                        class="fas fa-trash-alt"></i></a></span>



                                        </span>
                                        <p> {{$category->name}}</p>

                                    </div>
                                </div>

                            @endforeach

                                {{ (!is_null($showLinks)&&$showLinks) ? $categories->links():''}}

                                <form action="{{route('search-categories')}}" method="get">
                                    <div class="row">
                                        @csrf
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="category_search" id="category_search"
                                                   placeholder="Search category" required>
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
                <strong class="mr-auto">Category</strong>
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
                    <h5 class="modal-title">Delete category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="delete-message"></p>
                </div>
                <form action="{{route('categories')}}" method="post" style="position: relative;">
                    @csrf
                    <div class="modal-body">
                        <p id="delete-message"></p>

                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="category_id" value="" id="category_id">
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
                    <h5 class="modal-title">edit category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('categories')}}" method="post" >

                    <div class="modal-body">
                        @csrf
                        <p id="delete-message"></p>
                    </div>

                    <div class="form-group col-md-6">

                        <label for="edit_category_name">category Name</label>
                        <input type="text" class="form-control" name="category_name" id="edit_category_name"
                               placeholder="Cat Name" required>

                    </div>


                    <input type="hidden" name="_method" value="put">

                    <input type="hidden" name="category_id" id="edit_category_id">


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


    <script>

        $(document).ready(function () {
            var $deleteUnit = $('.delete-unit');
            var $deleteWindow = $('#delete-window');
            var $categoryID=$('#category_id');
            var $deleteMessage = $('#delete-message');

            $deleteUnit.on('click', function (element) {
                element.preventDefault();
                var cat_id = $(this).data('categoryid');
                $categoryID.val(cat_id);
                $deleteMessage.text('Are you sure you want to delete category ? ');
                $deleteWindow.modal('show');


            });

            var $editCat = $('.edit-unit');

            var $editWindow = $('#edit-window');
            var $edit_cat_name = $('#edit_category_name');
            var $edit_cat_id = $('#edit_category_id');


            $editCat.on('click', function (element) {
                element.preventDefault();
                var catName = $(this).data('categoryname');
                var catID = $(this).data('categoryid');

                $edit_cat_name.val(catName);
                $edit_cat_id.val(catID);


                $editWindow.modal('show');

            });

        });

    </script>





@endsection
