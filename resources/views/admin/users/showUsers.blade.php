@extends('layouts.master')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminShowUsers')}}">Go Back</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
   <div class="container-fliud">
       <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                       
                       <div class="btn-group1" style="float:right">
                           <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadUserModal">Upload User</button>
                           <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addUserModal">
                            <i class="fa fa-plus"></i>
                              Add New User
                           </button>
                           <a href="{{route('adminExportUsersAsExcel')}}" class="btn btn-sm btn-secondary"> Export Excel</a>
                           <a href="{{route('adminExportUsersAsPdf')}}" class="btn btn-sm btn-primary"> Export Pdf</a>
                       </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-stripped">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phonenumber</th>
                                <th>Role</th>
                              
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if(!empty($users))
                                   @foreach($users as $key=>$user)
                                     <tr>
                                         <td>{{$key+1}}</td>
                                         <td>{{$user->name}}</td>
                                         <td>{{$user->email}}</td>
                                         <td>{{$user->phonenumber}}</td>
                                         <td>{{$user->role}}</td>
                                        
                                         <td>

                                            <div class="dropdown">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                     Action
                                                    </a>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li><a class="dropdown-item" href="#"><h6>More Action</h6></a></li>
                                                        <li><a class="dropdown-item" data-toggle="modal" data-target="#updateUserModal{{$user->id}}" href="#">Update</a></li>
                                                        <li><a class="dropdown-item" data-toggle="modal" data-target="#deleteUserModal{{$user->id}}" href="#">Delete</a></li>
                                                    </ul>
                                            </div>

                                         </td>
                                     </tr>


                                    <!--add user modal-->
                                    <div class="modal fade" id="updateUserModal{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h6>Update User </h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                </div>
                                                <form method="POST" action="{{route('adminUpdateUsers')}}">
                                                    @csrf
                                                <div class="modal-body">
                                                    <input type="text" name="id" value="{{$user->id}}"class="form-control" hidden="true">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Fullname</label>
                                                                <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Phonenumber</label>
                                                                <input type="number" name="phonenumber" value="{{$user->phonenumber}}" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label>Role</label>
                                                            <select name="role" class="form-control" required>
                                                                <option value="{{$user->role}}"> {{$user->role}}</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="Student">Student</option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-edit"></i>Save</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of add user modal-->


                                    <!--add user modal-->
                                    <div class="modal fade" id="deleteUserModal{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h6>Are you sure you want to delete this record ?</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                </div>
                                                <form method="POST" action="{{route('adminDeleteUsers')}}">
                                                    @csrf
                                               
                                                    <input type="text" name="id" value="{{$user->id}}"class="form-control" hidden="true">
                    
                                              
                                                <div class="modal-footer justify-content-between">
                                                    <button class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-trash"></i>Delete</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of add user modal-->


                                   @endforeach
                                @else
                                 <p>No users record</p>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
   </div>
</section>

<!--add user modal-->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h6>Add User</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            </div>
            <form method="POST" action="{{route('adminAddUsers')}}">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" name="name" class="form-control" placeholder="Eg John Doe" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Eg doe@gmail.com" required>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phonenumber</label>
                            <input type="number" name="phonenumber" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                              <option value="">Select .. </option>
                              <option value="admin">Admin</option>
                              <option value="Student">Student</option>
                        </select>
                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Save</button>
            </div>
           </form>
        </div>
    </div>
</div>
<!--end of add user modal-->

<!--add user modal-->
<div class="modal fade" id="uploadUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h6>Upload Users</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            </div>
            <form method="POST" action="{{route('adminImportUsersData')}}" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Select File</label>
                            <input type="file" name="user_file" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Save</button>
            </div>
           </form>
        </div>
    </div>
</div>
<!--end of add user modal-->

@endsection