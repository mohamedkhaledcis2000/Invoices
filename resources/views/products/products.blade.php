@extends('layouts.master')

@section('css')
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    المنتجات  - فواتير للادارة القانونية
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@section('content')

    {{--Display Errors--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">
        {{--        add section--}}
        @if (session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="btn ripple btn-secondary" data-target="#productmodel" data-toggle="modal" href="#sectionmodel">اضافة منتج</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                <th class="wd-15p border-bottom-0">اسم القسم</th>
                                <th class="wd-20p border-bottom-0">الوصف</th>
                                <th class="wd-10p border-bottom-0">تعديل</th>
                                <th class="wd-10p border-bottom-0">حذف</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0 ?>
                            @foreach($products as $product)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>

                                    @foreach($sections as $section)
                                        @if($product->section_id == $section->id)
                                            {{$section->name}}
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>{{$product->description}}</td>
                                    <td>

                                        <button class="btn ripple btn-secondary" data-target="#edit{{$product->id}}" data-toggle="modal" type="button">Update</button>
                                    </td>
                                    <td>
                                        <form action="{{route('products.destroy',$product->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>




                                <!-- Small modal for editig product -->
                                <div class="modal" id="edit{{$product->id}}">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{route('products.update',[$product->id])}}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-group">
                                                        <label for="name">اسم المنتج</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">اسم القسم</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$section->name}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">الوصف </label>
                                                        <input type="text" class="form-control" id="description" name="description" value="{{$product->description}}">
                                                    </div>

                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn ripple btn-primary" type="submit">تعديل القسم</button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Small Modal for editing  -->


                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    <!-- Small modal for adding new product -->
    <div class="modal" id="productmodel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form action="{{route('products.store')}}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <label for="name">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="name">اسم القسم</label>
{{--                            <input type="text" class="form-control" id="section_id" name="section_id">--}}
                            <select name="section_id" class="form-control select2-no-search">
                                <option label="Choose one">
                                </option>
                                @foreach($sections as $section)
                                <option value="{{$section->id}}">{{$section->name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="notes">ملاحظات</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input class="btn ripple btn-primary" type="submit" value="اضافة منتج">
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End Small Modal -->








    <!-- Container closed -->
    <!-- main-content closed -->
@endsection
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection

