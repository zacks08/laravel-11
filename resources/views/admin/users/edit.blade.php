@extends('admin.layouts.app')
@section('title', 'Editar Usuário')
@section('content')



<h1>Editar Usuário {{$user->name}}</h1>



@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update' , $user->id) }}" method="POST">
    @csrf()
    @method('PUT')

    <input type="text" name="name" placeholder="'Nome' "value="{{($user -> name)}}" >



    <input type="email"  name="email" placeholder="'Email'" value="{{($user -> email)}}" >



    <input type="password" name="password" placeholder="'Senha'" >

    <button type="submit">Criar Usuário</button>
</form>

@endsection