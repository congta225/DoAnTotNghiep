@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Phương thức rút tiền</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Thêm phương thức</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.withdraw-method.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên phương thức</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label>Số tiền tối thiểu</label>
                            <input type="text" class="form-control" name="minimum_amount" value="">
                        </div>
                        <div class="form-group">
                            <label>Số tiền tối đa</label>
                            <input type="text" class="form-control" name="maximum_amount" value="">
                        </div>
                        <div class="form-group">
                            <label>Phí rút tiền (%)</label>
                            <input type="text" class="form-control" name="withdraw_charge" value="">
                        </div>

                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" class="summernote"></textarea>
                        </div>

                        <button type="submmit" class="btn btn-primary">Thêm</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
