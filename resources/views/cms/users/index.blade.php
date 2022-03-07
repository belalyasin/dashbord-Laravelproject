@extends('cms.parent')

@section('title',__('cms.users'))

@section('page_name',__('cms.index'))
@section('main_page',__('cms.users'))
@section('small_page_name',__('cms.index'))

@section('style')

@endsection

@section('main_content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.users')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.name')}}</th>
                                    <th>{{__('cms.email')}}</th>
                                    <th style="width: 40px">{{__('cms.gender')}}</th>
                                    <th>{{__('cms.specialty')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    <th>{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span
                                            class="badge @if($user->gender == 'M') bg-success @else bg-warning @endif">{{$user->gender_type}}</span>
                                    </td>
                                    <td>{{$user->specialty->name_en}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('users.edit',[$user->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$user->id}}', this)" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
{{-- <script src="{{asset('cms/dist/js/demo.js')}}"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, element) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id, element)
            }
        })
    }
    function performDelete(id, element){
        // alert('Delete ...!');
        axios.delete('/cms/admin/users/'+id)
    .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        element.closest('tr').remove();
    })
    .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
    });
    }
</script>
@endsection
