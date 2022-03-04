@extends('cms.parent')

@section('title',__('cms.specialities'))

@section('page_name',__('cms.index'))
@section('main_page',__('cms.specialities'))
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
              <h3 class="card-title">{{__('cms.specialities')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('cms.name_en')}}</th>
                    <th>{{__('cms.name_ar')}}</th>
                    <th style="width: 40px">{{__('cms.active')}}</th>
                    <th>{{__('cms.created_at')}}</th>
                    <th>{{__('cms.updated_at')}}</th>
                    <th>{{__('cms.settings')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($specialties as $specialty)
                  <tr>
                    <td>{{$specialty->id}}</td>
                    <td>{{$specialty->name_en}}</td>
                    <td>{{$specialty->name_ar}}</td>
                    <td><span class="badge @if($specialty->active) bg-success @else bg-danger @endif">{{$specialty->active_status}}</span></td>
                    <td>{{$specialty->created_at}}</td>
                    <td>{{$specialty->updated_at}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('specialties.edit'),[$specialty->id]}}" class="btn btn-warning">
                              <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </button>
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
<script src="{{asset('cms/dist/js/demo.js')}}"></script>
@endsection
