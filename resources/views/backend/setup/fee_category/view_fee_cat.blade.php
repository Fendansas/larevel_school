@extends('admin.admin_master')

@section('admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Fee Category List</h3>

                            <a href="{{ route('fee.category.add') }}"
                               style="float: right"
                               class="btn btn-rounded btn-success md-5">
                                Add Fee Category
                            </a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th>Name</th>
                                        <th width="25%">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $fee)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$fee->name}}</td>
                                            <td>
                                                <a href="{{ route('fee.category.edit', $fee->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('fee.category.delete', $fee->id) }}" id="delete" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    </div>
    <!-- /.content-wrapper -->


@endsection
