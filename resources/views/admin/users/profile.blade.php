<x-admin-master>

    @section('content')

        <h1>User profile for : {{$user->name}}</h1>

        <div class="row">
            <div class="col-sm-6">

        <form action="{{route('user.profile.update',$user)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <img  class="img-profile rounded-circle" src="{{$user->avatar}}">
            </div>
            <div class="form-group">
                <input type="file" name="avatar">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm password</label>
                <input type="password" name="confirm-password" id="confirm-password" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>

            </div>
        </div>


    @endsection

</x-admin-master>