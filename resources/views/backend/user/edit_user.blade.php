@extends('admin.admin_master')

@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Update User</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form  method="post" action="{{ route('user.update', $user->id) }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Role <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="role" id="role" required class="form-control">
                                                                <option value="" selected="" disabled="">Select Role</option>
                                                                <option value="Admin" {{$user->role == "Admin" ? "selected" : ""}}>Admin</option>
                                                                <option value="Operator" {{$user->role == "Operator" ? "selected" : ""}}>Operator</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Email<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="email" required name="email" value="{{$user->email}}"  class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" value="{{$user->name}}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-12">
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info md-5" value="Update"></input>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- /.row -->

    <!-- /.content -->

    <!-- /.content-wrapper -->


@endsection

