<h1>Novo Usuário</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf()
    <div>
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Criar Usuário</button>
</form>