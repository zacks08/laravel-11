<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Usuários</h1>

    <a href="{{route('users.create')}}" class="">Novo</a>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Açoes</th>
        </tr>
    </thead>
    <tbody>
       @forelse($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="#">Editar</a>
                <a href="#">Excluir</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Nenhum usuário encontrado.</td>
       @endforelse
    </tbody>
</table>
{{ $users->links() }}
    
</body>
</html>