@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header  d-flex justify-content-between">
                    <h3>Edit Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('product.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if (session('delete'))
                            <div class="alert alert-success">{{session('delete')}}</div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control category" name="category_id">
                                        <option  value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option {{$category->id == $products->category_id ? 'selected' : ''}} value="{{$category->id == $products->category_id ? $category->id : ''}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Subcategory</label>
                                    <select class="form-control subcategory" name="subcategory_id">
                                        @foreach ($subcategories as $subcategory)
                                            <option {{$subcategory->id == $products->subcategory_id ? 'selected' : ''}} value="{{$subcategory->id == $products->subcategory_id ? $subcategory->id : ''}}">{{$subcategory->subcategory_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Brand</label>
                                    <select class="form-control" name="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option {{$brand->id == $products->brand_id ? 'selected' : ''}} value="{{$brand->id == $products->brand_id ? $brand->id : ''}}">{{{$brand->brand_name}}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="{{$products->product_name}}">
                                    @error('product_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Price</label>
                                    <input type="number" class="form-control" name="product_price" value="{{$products->product_price}}">
                                    @error('product_price')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Discount (%)</label>
                                    <input type="number" class="form-control" name="discount" value="{{$products->discount}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Tags</label>
                                    <input type="text" class="form-control border-0 px-0" id="input-tags" name="tags[]" value="{{$products->tags}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <input type="text" class="form-control" name="short_desp" value="{{$products->short_desp}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea class="form-control" id="summernote" name="long_desp" id="" cols="30" rows="10">{!!$products->long_desp!!}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Additional Information</label>
                                    <textarea id="summernote2" name="addi_info" class="form-control" cols="30" rows="10">{!!$products->addi_info!!}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Preview Image</label>
                                    <input type="file" class="form-control" name="prev_img" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    <img width="150" src="{{asset('uploads/product/preview/')}}/{{$products->prev_img}}" id="blah" alt="">
                                    @error('prev_img')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="upload__box">
                                    <div class="upload__btn-box">
                                      <label class="upload__btn">
                                        Gallery Images
                                        <input width="150" name="gallery[]" type="file" multiple="" data-max_length="20" class="upload__inputfile" id="gallery-photo-add" multiple>
                                      </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 m-auto">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100 upload__btn btn_design">Update Product</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
    <script>
        $("#input-tags").selectize({
            delimiter: ",",
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input,
                };
            },
            });
    </script>
    <script>
        $('.category').change(function() {
            let category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/getsubcategory',
                type: 'POST',
                data:{'category_id': category_id},

                success:function(data){
                    $('.subcategory').html(data);
                }
            });

        })
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#summernote2').summernote();
        });
    </script>
    {{-- gallary image --}}
    
    <script>
        jQuery(document).ready(function () {
        ImgUpload();
        });

        function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function () {
            $(this).on('change', function (e) {
            imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
            var maxLength = $(this).attr('data-max_length');

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            var iterator = 0;
            filesArr.forEach(function (f, index) {

                if (!f.type.match('image.*')) {
                return;
                }

                if (imgArray.length > maxLength) {
                return false
                } else {
                var len = 0;
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i] !== undefined) {
                    len++;
                    }
                }
                if (len > maxLength) {
                    return false;
                } else {
                    imgArray.push(f);

                    var reader = new FileReader();
                    reader.onload = function (e) {
                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                    imgWrap.append(html);
                    iterator++;
                    }
                    reader.readAsDataURL(f);
                }
                }
            });
            });
        });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
                imgArray.splice(i, 1);
                break;
            }
            }
            $(this).parent().parent().remove();
        });
        }
    </script>
@endsection