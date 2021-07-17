<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style_edit_profile.css')}}">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                <a href="{{route('user.profile')}}" class="btn btn-primary">Back</a>
                <div class="account-settings">
                    <div class="user-profile">
                        {{-- <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                            @csrf --}}

                        <div class="user-avatar">
                            <img src="{{ url( '/images/'.$user->image ) }}" alt="Image"/>
                        </div>
                            {{-- <div class="form-group">
                                <input type="file" name="image" class="form-control">
                            </div> --}}


                    </div>

                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Personal Details</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">Name</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Enter your name" value="{{$user->name}}" name="name">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="eMail">Email</label>
                                <input type="email" class="form-control" id="eMail" placeholder="Enter email" value="{{$user->email}}" name="email">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter phone number" value="{{$user->phone}}" name="phone">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="text">Profession</label>
                                <input type="text" class="form-control" id="profession" placeholder="Your profession" value="{{$user->profession}}" name="profession">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">Avatar</label>
                                <input type="file" class="form-control" id="image"  name="image">
                            </div>
                        </div>
                    </div>

                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                {{-- <button type="button" id="submit" name="submit" class="btn btn-primary">Update</button> --}}
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>
        </div>

</body>
</html>
