@extends('cms.parent')

@section('title',__('cms.edit_specialty'))
@section('page_name',__('cms.edit'))
@section('main_page',__('cms.specialities'))
@section('small_page_name',__('cms.edit'))

@section('style')

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
                            <h3 class="card-title">{{__('cms.edit_specialty')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('specialties.update',[$specialty->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> {{__('cms.success')}}!</h5>
                                            {{session('message')}}
                                        </div>
                                @endif
                                <div class="form-group">
                                    <label for="name_en_input">{{__('cms.name_en')}}</label>
                                    <input type="text" class="form-control" id="name_en_input" name="name_en" value="{{old('name_en') ?? $specialty->name_en}}" placeholder="{{__('cms.name_en')}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_ar_input">{{__('cms.name_ar')}}</label>
                                    <input type="text" class="form-control" id="name_ar_input" name="name_ar" value="{{old('name_ar') ?? $specialty->name_ar}}" placeholder="{{__('cms.name_ar')}}">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="activecheckbox"  name="active" @if($specialty->active) checked @endif>
                                        <label class="custom-control-label" for="activecheckbox">{{__('cms.active')}}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{__('cms.save')}}</button>
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

@endsection
