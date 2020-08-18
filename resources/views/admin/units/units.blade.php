@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Units</div>

                    <div class="card-body">
                        <form action="{{route('units')}}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-6">

                                <label for="unit_name">Unit Name</label>
                                <input type="text" class="form-control" name="unit_name" id="unit_name"
                                       placeholder="Unit Name" required>

                            </div>
                            <div class="form-group col-md-6">

                                <label for="unit_code">Unit Code</label>
                                <input type="text" class="form-control" name="unit_code" id="unit_code"
                                       placeholder="Unit Code" required>

                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Save New Unit</button>
                            </div>


                        </form>
                        <div class="row">
                            @foreach($units as $unit)
                                <div class="col-md-3">
                                    <div class="alert alert-primary" role="alert">
                                        <span class="buttons-span">
                                            <span><a class="edit-unit" data-unitname="{{$unit->unit_name}}"
                                                     data-unitcode="{{$unit->unit_code}}"
                                                     data-unitid="{{$unit->id}}"><i class="fas fa-edit"></i></a></span>
                                            <span><a class="delete-unit"
                                                     data-unitname="{{$unit->unit_name}}"
                                                     data-unitcode="{{$unit->unit_code}}"
                                                     data-unitid="{{$unit->id}}"><i
                                                        class="fas fa-trash-alt"></i></a></span>



                                        </span>

                                        <p> {{$unit->unit_name}},{{$unit->unit_code}}</p>

                                    </div>
                                </div>

                            @endforeach

                            {{ (!is_null($tagsshowLinks)&&$showLinks) ? $units->links():''}}

                                <form action="{{route('search-units')}}" method="get">
                                    <div class="row">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="unit_search" id="unit_search"
                                               placeholder="Search Unit" required>
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


    <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="delete-message"></p>
                </div>
                <form action="{{route('units')}}" method="post" style="position: relative;">
                    @csrf
                    <div class="modal-body">
                        <p id="delete-message"></p>

                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="unit_id" value="" id="unit_id">
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
                    <h5 class="modal-title">edit Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('units')}}" method="post" >

                <div class="modal-body">
                    @csrf
                    <p id="delete-message"></p>
                </div>

                    <div class="form-group col-md-6">

                        <label for="edit_unit_name">Unit Name</label>
                        <input type="text" class="form-control" name="unit_name" id="edit_unit_name"
                               placeholder="Unit Name" required>

                    </div>


                    <div class="form-group col-md-6">
                        <label for="edit_unit_code">Unit Code</label>
                        <input type="text" class="form-control" name="unit_code" id="edit_unit_code"
                               placeholder="Unit Code" required>

                    </div>


                        <input type="hidden" name="_method" value="put">

                        <input type="hidden" name="unit_id" id="edit_unit_id">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    @if(Session::has('message'))

        <div class="toast" style="position: absolute; top: 5%; right: 5%;">
            <div class="toast-header">
                <strong class="mr-auto">Unit</strong>
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

    <script>

        $(document).ready(function () {
            var $deleteUnit = $('.delete-unit');
            var $deleteWindow = $('#delete-window');
            var $deleteMessage = $('#delete-message');

            $unitId = $('#unit_id');
            $deleteUnit.on('click', function (element) {
                element.preventDefault();
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');
                var unit_id = $(this).data('unitid');


                $unitId.val(unit_id);
                $deleteMessage.text('Are you sure you want to delete ' + unitName + ' with Code ' + unitCode + '?');


                $deleteWindow.modal('show');


            });


            var $editUnit = $('.edit-unit');

            var $editWindow = $('#edit-window');
            var $edit_unit_name = $('#edit_unit_name');
            var $edit_unit_code = $('#edit_unit_code');
            var $edit_unit_id = $('#edit_unit_id');


            $editUnit.on('click', function (element) {
                element.preventDefault();
                var unit_id = $(this).data('unitid');
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');

                $edit_unit_code.val(unitCode);
                $edit_unit_id.val(unit_id);
                $edit_unit_name.val(unitName);


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

