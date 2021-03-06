@extends('admin.master')
@section('main-content')
<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-md-8 offset-md-2 pl-0 pr-0">
            @if (Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Message : </strong> {{Session::get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">{{$user->name}}'s Profile</h4>
                </div>
            </div>
            <form action="{{route('update-user-photo')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="table-responsive p-1">
                    <table class="table table-striped table-bordered dt-responsive nowrap text-center"
                        style="width: 100%;">
                        <tr>
                            <td><img src="{{asset('/')}}admin/assets/images/avatar.png" id="profile_photo"
                                    style="max-width:400px;"></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" class="custom-file-input" id="avatar"
                                            onchange="showImage(this, 'profile_photo')">
                                        <label class="custom-file-label" for="inputGroupFile02" id="fileLabel">Choose
                                            File</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <input name="user_id" type="hidden" value="{{$user->id}}">
                        <tr>
                            <td><button type="submit" class="btn btn-block my-btn-submit">Update Photo</button></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->
@endsection
