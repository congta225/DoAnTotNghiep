@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Chân trang</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập nhật chân trang</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.footer-grid-three.update', $footer->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$footer->name}}">
                        </div>

                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input type="text" class="form-control" name="url" value="{{$footer->url}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$footer->status === 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                              <option {{$footer->status === 0 ? 'selected' : ''}} value="0">Dừng hoạt động</option>
                            </select>
                        </div>

                        <button type="submmit" class="btn btn-primary">Cập nhật</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection