@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">
    <style>
        .autocomplete-suggestions {
            border: 1px solid #e4e4e4;
            background: #F4F4F4;
            cursor: default;
            overflow: auto
        }
        .autocomplete-suggestion {
            padding: 2px 5px;
            font-size: 1.2em;
            white-space: nowrap;
            overflow: hidden
        }
        .autocomplete-selected {
            background: #f0f0f0
        }
        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399ff;
            font-weight: bolder
        }
    </style>
@stop
@section('content')
    <?php $user = session('user') ?>
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        @if($user)
                            <h5 class="title text-primary"><i class="fa fa-user text-info"></i> <span class="label label-info">Modification {{$user->nom}}</span></h5>
                        @else
                            <h4 class="title"><i class="fa fa-user text-info"></i> <span class="label label-info">Ajouter un utilisateur</span></h4>
                        @endif
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                @if($user)
                                <form action="{{route('users.update', ['user' => $user])}}" method="post">
                                    {{method_field('PATCH')}}
                                @else
                                <form action="{{route('users.store')}}" method="post">
                                @endif
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                                <label for=""><i class="fa fa-user text-danger"></i> Nom Founisseur</label>
                                                @if($user)
                                                    <input type="text" class="form-control" placeholder="Ex. Joe" name="name" id="name" value="{{old('name')? old('name') : $user->name}}">
                                                @else
                                                    <input type="text" class="form-control" placeholder="Ex. Joe" name="name" id="name" value="{{old('name')}}">
                                                @endif
                                            </div>
                                            @if($errors->has('name'))
                                                <span class="text-danger">
                                                    <p style="font-size: 11px">{{$errors->first('name')}}</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                                                <label for=""><i class="fa fa-user text-danger"></i> Pseudo</label>
                                                @if($user)
                                                    <input type="text" class="form-control" placeholder="Ex. joe" name="username" disabled rel="tooltip" title="Vous ne pouvez pas modifier ces informations" id="username" value="{{old('username')? old('username') : $user->username}}">
                                                @else
                                                    <input type="text" class="form-control" placeholder="Ex. joe" name="username" id="username" value="{{old('username')}}">
                                                @endif
                                            </div>
                                            @if($errors->has('username'))
                                                <span class="text-danger">
                                                    <p style="font-size: 11px">{{$errors->first('username')}}</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                                <label for=""><i class="fa fa-at text-danger"></i> Email</label>
                                                @if($user)
                                                    <input type="text" class="form-control" placeholder="Ex. exemple@gmail.com" name="email" disabled rel="tooltip" title="Vous ne pouvez pas modifier ces informations" id="email" value="{{old('email')? old('email') : $user->email}}">
                                                @else
                                                    <input type="text" class="form-control" placeholder="Ex. exemple@gmail.com" name="email" id="email" value="{{old('email')}}">
                                                @endif
                                            </div>
                                            @if($errors->has('email'))
                                                <span class="text-danger">
                                                    <p style="font-size: 11px">{{$errors->first('email')}}</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                                <label for="">Mot de passe</label>
                                                <input type="password" class="form-control" placeholder="*****" name="password" id="password" value="{{old('password')}}" required>
                                            </div>
                                            @if($errors->has('password'))
                                                <span class="text-danger">
                                                    <p style="font-size: 11px">{{$errors->first('password')}}</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                                <label for="">Confirmer</label>
                                                <input type="password" class="form-control" placeholder="*****" name="password_confirmation" id="password-confirm" required>
                                            </div>
                                            @if($errors->has('password'))
                                                <span class="text-danger">
                                                    <p style="font-size: 11px">{{$errors->first('password')}}</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <br>
                                            @if($user)
                                                <button type="submit" class="btn btn-primary btn-fill" rel="tooltip" title="Modifier"><i class="fa fa-edit"></i></button>
                                                <a href="{{route('users.index')}}" class="btn btn-danger btn-fill" rel="tooltip" title="Fermer"><i class="fa fa-close"></i></a>
                                            @else
                                                <button type="submit" class="btn btn-danger btn-fill" rel="tooltip" title="Enregister"><i class="fa fa-save"></i></button>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="fa fa-users"></i> <span class="label label-info">Tous les Utilisateurs</span></h4>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="usersTable">
                        <thead>
                        <th>Nom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Ajouté le</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('d M Y')}}</td>
                                <td>
                                    @if(\Auth::user()->id == 1 || Auth::user()->id == $user->id)
                                    <a href="{{route('users.show', ['user' => $user])}}" class="btn btn-xs btn-primary btn-simple" rel="tooltip" title="Modifier"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(\Auth::user()->id == 1)
                                    {{--<a href="{{route('users.edit', ['user' => $user])}}" data-toggle="tooltip" data-placement="left" rel="tooltip" title="Supprimer" class="btn btn-danger btn-xs delete btn-simple" data-method="DELETE" data-confirm="Etes-vous sûr"><i class="fa fa-trash"></i></a>--}}
                                    <a href="#" data-toggle="tooltip" data-placement="left" rel="tooltip" title="Supprimer" class="btn btn-danger btn-xs delete btn-simple" data-method="DELETE" data-confirm="Etes-vous sûr"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/getter-edit-sweet-alert.js')}}"></script>
    <script src="{{asset('assets/js/jquery.autocomplete.min.js')}}"></script>
@stop
@section('notification')
    <script>
        $(function () {
            $('#usersTable').DataTable()
        })
        function notification(type, message) {
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-bell',
                    message: type === 'success' ?
                        "<b>Notification</b><br> <i class='fa fa-hand-o-right'></i> " + message :
                        "<b>Notification</b><br> <i class='fa fa-hand-o-right'></i> " + message

                },{
                    type: type === 'success' ? 'success' : 'warning',
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'center'
                    }
                });

            });

        }
    </script>

    @if(Session::has('success-user'))
        <script type="text/javascript">
            notification('success', 'Utilisateur Créée');
        </script>
    @endif
    @if(Session::has('error-user'))
        <script type="text/javascript">
            notification('warning', 'Utilisateur existe déjà');
        </script>
    @endif
    @if(Session::has('supression-user'))
        <script type="text/javascript">
            notification('danger', 'Utilisateur suprimée');
        </script>
    @endif
    @if(Session::has('modification-user'))
        <script type="text/javascript">
            notification('success', 'Utilisateur modifiée');
        </script>
    @endif
@stop