@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!! !is_null($product)?' Update Product <span class="product-header-title">'.$product->title:'New Product' !!}

                    </div>

                    <div class="card-body">

                        <form action="{{(!is_null($product))?route('update-product'):route('new-product')}}" method="post" class="row">
                            @csrf

                            @if(!is_null($product))
                                <input type="hidden" name="_method" value="put">

                                <input type="hidden" name="product_id" value="{{$product->id}}">


                            @endif


                            <div class="form-group col-md-12">
                                <label for="product_title">Product title</label>
                                <input type="text" class="form-control" name="product_title" id="product_title"
                                       value="{{!is_null($product)?$product->title:''}}"
                                       placeholder="product Title" required>

                            </div>
                            <div class="form-group col-md-12">
                                <label for="product_description">Product description</label>
                                <textarea type="text" class="form-control" name="product_description"
                                          id="product_description" rows="10"

                                          placeholder="product description"
                                          required>{{!is_null($product)?$product->description:''}}</textarea>

                            </div>
                            <div class="form-group col-md-12">

                                <label for="product_category">Product Category</label>
                                <select class="form-control" name="product_category" id="product_category" required>
                                    <option>select a category</option>

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{(!is_null($product)&&($product->category->id===$category->id))?'selected':''}}
                                        >{{$category->name}}
                                        </option>
                                    @endforeach


                                </select>

                            </div>


                            <div class="form-group col-md-12">

                                <label for="product_unit">Product Unit</label>
                                <select class="form-control" name="product_unit" id="product_unit" required>
                                    <option>select a category</option>

                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}"
                                            {{(!is_null($product)&&($product->hasUnit->id===$unit->id))?'selected':''}}>
                                            {{$unit->formatted()}}
                                        </option>
                                    @endforeach


                                </select>

                            </div>


                            <div class="form-group col-md-6">
                                <label for="product_price">Product Price</label>
                                <input type="number" class="form-control" name="product_price" id="product_price"
                                       step="any"
                                       placeholder="Product Price" required
                                       value="{{(!is_null($product))? $product->price:''}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_discount">Product discount</label>
                                <input type="number" class="form-control" name="product_discount" id="product_discount"
                                       step="any"
                                       placeholder="Product Price" required
                                       value="{{(!is_null($product))? $product->discount:0}}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="product_total">Product Total</label>
                                <input type="number" class="form-control" name="product_total" id="product_total"
                                       step="any"
                                       placeholder="Product Total" required
                                       value="{{(!is_null($product))? $product->total:''}}">
                            </div>


                            <div class="form-group col-md-12">
                                <table id="options-table" class="table table-striped">


                                </table>
                                <a class="btn btn-outline-dark add-option-btn" href="#">Add Option</a>

                            </div>

                            <div class="form-group col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>

                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>




    <div class="modal options-window" id="options-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body row">
                    <div class="form-group col-md-6">

                        <label for="option_name">Option Name</label>
                        <input type="text" class="form-control" name="option_name" id="option_name"
                               placeholder="option Name" required>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="option_value">option Value</label>
                        <input type="text" class="form-control" name="option_value" id="option_value"
                               placeholder="option value" required>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary add-option-button">add option</button>
                </div>


            </div>
        </div>
    </div>



    {{--<div class="modal options-window" tabindex="-1" role="dialog" id="options-window">--}}
    {{--    <div class="modal-dialog" role="document">--}}
    {{--        <div class="modal-content">--}}
    {{--            <div class="modal-header">--}}
    {{--                <h5 class="modal-title">Option</h5>--}}
    {{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                    <span aria-hidden="true">&times;</span>--}}
    {{--                </button>--}}
    {{--            </div>--}}
    {{--            <div class="modal-body row">--}}
    {{--                <div class="form-group col-md-6">--}}
    {{--                    <label for="option_name">Option Name</label>--}}
    {{--                    <input type="text" class="form-control" name="option_name" id="option_name"--}}
    {{--                           placeholder="Option Name" required>--}}
    {{--                </div>--}}
    {{--                <div class="form-group col-md-6">--}}
    {{--                    <label for="option_value">Option Value</label>--}}
    {{--                    <input type="text" class="form-control" name="option_value" id="option_value"--}}
    {{--                           placeholder="Option Value" required>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="modal-footer">--}}
    {{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
    {{--                <button type="submit" class="btn btn-primary add-option-button">Add Option</button>--}}
    {{--            </div>--}}


    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}


    {{--    <div class="modal image-window" tabindex="-1" role="dialog" id="options-window">--}}
    {{--        <div class="modal-dialog" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title">delete image</h5>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                        <span aria-hidden="true">&times;</span>--}}
    {{--                    </button>--}}
    {{--                </div>--}}

    {{--                <div class="modal-footer">--}}
    {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
    {{--                    <button type="submit" class="btn btn-primary delete-image-btn">delete image</button>--}}
    {{--                </div>--}}


    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection



@section('scripts')

    <script>
        $(document).ready(function () {
            var optionNamesList=[];
            var $optionWindow = $('#options-window');
            var $addOptionBtn = $('.add-option-btn');

            var $optionsTable = $('#options-table');
            var optionNamesRow = '';

            $addOptionBtn.on('click', function (e) {
                e.preventDefault();
                $optionWindow.modal('show');

            });

            $(document).on('click', '.remove-option', function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });

            $(document).on('click', '.add-option-button', function (e) {
                e.preventDefault();
                var $optionName = $('#option_name');
                if ($optionName === '') {
                    alert('option name is required');
                    return false;

                }

                if(!optionNamesList.includes($optionName.val())){
                    optionNamesList.push($optionName.val());
                    optionNamesRow='<td><input type="hidden" name="options[]" value="'+$optionName.val()+'"></td>'
                }



                var $optionValue = $('#option_value');
                if ($optionValue === '') {
                    alert('option val is required');
                    return false;

                }
                var optionRow = `
                <tr>
                      <td>
                          ` + $optionName.val() + `



                       </td>
                         <td>
                                  ` + $optionValue.val() + `


                       </td>


                     <td>
                    <a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>
                                <input type="hidden" name="` + $optionName.val() + `[]" value="` + $optionValue.val() + `">
                       </td>
                </tr>


                               `;
                $optionsTable.append(optionRow);
                $optionsTable.append(optionNamesRow);



                $optionValue.val('');

            });


        });


    </script>




@endsection








{{--@section('scripts')--}}
{{--    <script>--}}
{{--        var optionNamesList = [];--}}

{{--    </script>--}}

{{--    <script>--}}

{{--        var imageDelete = '{{route('delete-image')}}';--}}


{{--    </script>--}}
{{--    @if(!is_null($product->jsonOptions()))--}}
{{--        @foreach($product->jsonOptions() as $optionName=>$options)--}}
{{--            <script>optionNamesList.push('{{$optionName}}');</script>--}}
{{--        @endforeach--}}
{{--    @endif--}}


{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            console.log(optionNamesList);--}}

{{--            var $optionWindow = $('#options-window');--}}
{{--            var $imageWindow = $('.image-window');--}}
{{--            var $addOptionBtn = $('.add-option-btn');--}}
{{--            var $optionsTable = $('#options-table');--}}
{{--            var optionNamesRow = '';--}}
{{--            var $activateImageUpload = $('.activate-image-upload');--}}
{{--            $addOptionBtn.on('click', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $optionWindow.modal('show');--}}
{{--            });--}}

{{--            $(document).on('click', '.remove-option', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $(this).parent().parent().remove();--}}


{{--            });--}}


{{--            $(document).on('click', '.add-option-button', function (e) {--}}

{{--                e.preventDefault();--}}
{{--                var $optionName = $('#option_name');--}}
{{--                if ($optionName.val() === '') {--}}
{{--                    alert('Option Name is required');--}}
{{--                    return false;--}}

{{--                }--}}
{{--                var $optionValue = $('#option_value');--}}
{{--                if ($optionValue.val() === '') {--}}
{{--                    alert('option value is required');--}}
{{--                    return false;--}}

{{--                }--}}

{{--                if (!optionNamesList.includes($optionName.val())) {--}}
{{--                    optionNamesList.push($optionName.val());--}}
{{--                    optionNamesRow = '<td><input type="hidden" name="options[]" value="' + $optionName.val() + '"></td>';--}}
{{--                }--}}


{{--                var optionRow = `--}}
{{--                <tr>--}}
{{--                    <td>--}}

{{--                               ` + $optionName.val() + `--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                                     ` + $optionValue.val() + `--}}

{{--                     </td>--}}
{{--                           <td>--}}
{{--                <a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>--}}
{{--                   <input type="hidden" name="` + $optionName.val() + `[]" value="` + $optionValue.val() + ` ">--}}
{{--                     </td>--}}


{{--                </tr>--}}

{{--                `;--}}
{{--                $optionsTable.append(--}}
{{--                    optionRow--}}
{{--                );--}}
{{--                $optionsTable.append(--}}
{{--                    optionNamesRow--}}
{{--                );--}}

{{--                $optionValue.val('');--}}


{{--            });--}}

{{--            function readURL(input, imageID) {--}}
{{--                if (input.files && input.files[0]) {--}}
{{--                    var reader = new FileReader();--}}

{{--                    reader.onload = function (e) {--}}
{{--                        $('#' + imageID).attr("src", e.target.result);--}}


{{--                    }--}}
{{--                    reader.readAsDataURL(input.files[0]);--}}
{{--                }--}}

{{--            }--}}

{{--            function resetFileUpload(fileUploadID, imageID, $eI, $eD) {--}}
{{--                $('#' + imageID).attr('src', '');--}}
{{--                $eI.fadeIn();--}}
{{--                if($eD!=null){--}}
{{--                    $eD.fadeOut();--}}

{{--                }--}}

{{--                $("#" + fileUploadID).val('');--}}
{{--                var element =document.getElementById(fileUploadID);--}}
{{--                element.value = '';--}}

{{--            }--}}


{{--            $activateImageUpload.on('click', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                var fileUploadID = $(this).data('fileid');--}}
{{--                var me = $(this);--}}

{{--                //$(this).children('input.image-file-upload').trigger('click') ;--}}
{{--                //console.log(fileUploadID) ;--}}
{{--                $('#' + fileUploadID).trigger('click');--}}

{{--                var imagetag = '<img id="i' + fileUploadID + '"  src="" class="card-img-top">';--}}
{{--                $(this).append(imagetag);--}}
{{--                $('#' + fileUploadID).on('change', function (e) {--}}
{{--                    readURL(this, 'i' + fileUploadID);--}}
{{--                    me.find('i').fadeOut();--}}
{{--                    $removeThisImage = me.parent().find('.remove-image-upload');--}}
{{--                    $removeThisImage.fadeIn();--}}
{{--                    $removeThisImage.on('click', function (e) {--}}

{{--                        e.preventDefault();--}}

{{--                        resetFileUpload(fileUploadID, 'i' + fileUploadID, me.find('i'), $removeThisImage);--}}


{{--                    });--}}

{{--                });--}}


{{--            });--}}
{{--            $('.remove-image-upload').on('click', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                var me = $(this);--}}
{{--                var imageID = me.data('imageid');--}}

{{--                var removeID = $(this).data('removeimg');--}}
{{--                var fileUploadID = $(this).data('fileid');--}}
{{--                var $removeThisImage = me.parent().find('.remove-image-upload');--}}

{{--                $('.delete-image-btn').data('ed', $removeThisImage);--}}
{{--                $('.delete-image-btn').data('fileid', fileUploadID);--}}
{{--                $('.delete-image-btn').data('removeimg', removeID);--}}
{{--                $('.delete-image-btn').data('imageid', imageID);--}}
{{--                $imageWindow.modal('show');--}}


{{--            });--}}
{{--            $(document).on('click', '.delete-image-btn', function (e) {--}}
{{--                e.preventDefault();--}}

{{--                var imageID = $(this).data('imageid');--}}
{{--                var removeID = $(this).data('removeimg');--}}
{{--                var fileUploadID = $(this).data('fileid');--}}
{{--                var ed = $(this).data('ed');--}}
{{--                resetFileUpload(fileUploadID, 'i' + fileUploadID, $('#' + removeID).find('i'), ed);--}}
{{--                $.ajax({--}}
{{--                    url: imageDelete,--}}
{{--                    data: {--}}
{{--                        image_id: imageID,--}}
{{--                    },--}}
{{--                    dataType: 'json',--}}
{{--                    method: 'post',--}}
{{--                });--}}
{{--                $imageWindow.modal('hide');--}}


{{--            });--}}


{{--        });--}}


{{--    </script>--}}

{{--@endsection--}}



