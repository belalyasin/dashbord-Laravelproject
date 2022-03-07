@extends('cms.parent')

@section('title',__('cms.create_user'))
@section('page_name',__('cms.create'))
@section('main_page',__('cms.users'))
@section('small_page_name',__('cms.create'))

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
@endsection

@section('main_content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.create_user')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{__('cms.specialities')}}</label>
                                <select class="form-control specialty" style="width: 100%;" id="specialty_id">
                                    @foreach ($specialties as $specialty )
                                    <option value="{{$specialty->id}}">{{$specialty->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('cms.email')}}">
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.gender')}}</label>
                                <select class="form-control gender" style="width: 100%;" id="gender">
                                    <option value="M">{{__('cms.male')}}</option>
                                    <option value="F">{{__('cms.fmale')}}</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()" class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<!-- Select2 -->
<script>
    // $('.select2').select2();
    $('.specialty').select2({
      theme: 'bootstrap4'
    });
    $('.gender').select2({
      theme: 'bootstrap4'
    });

    function performStore(){
        // alert('Perform Store Function');
    axios.post('/cms/admin/users', {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        specialty_id: document.getElementById('specialty_id').value,
        gender: document.getElementById('gender').value,
    })
    .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        document.getElementById('create_form').reset();
    })
    .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
    });
    }
</script>
@endsection
