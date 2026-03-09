# Sistema de Autenticação Separado - CREA-PR

## Visão Geral

O sistema agora possui autenticação completamente separada para Administradores e Municípios, com controle de acesso baseado em roles e proteção em múltiplas camadas.

## URLs de Acesso

### Administrador
- **Login**: `/admin/login`
- **Dashboard**: `/admin/dashboard`
- **Tema**: Vermelho/Laranja com ícone de escudo

### Município
- **Login**: `/login`
- **Dashboard**: `/municipality/dashboard`
- **Tema**: Roxo/Azul com ícone de prédio

## Credenciais

### Admin
```
Email: admin@crea-pr.org.br
Senha: admin123
Role: admin
```

### Municípios
As credenciais são enviadas por email após aprovação da manifestação de interesse.

## Arquitetura de Segurança

### 1. Redirecionamento Inteligente de Guests

**Localização**: `bootstrap/app.php`

```php
$middleware->redirectGuestsTo(function (Request $request) {
    // Se tentando acessar área admin, redireciona para login admin
    if ($request->is('admin/*')) {
        return route('admin.login');
    }
    // Caso contrário, redireciona para login de município
    return route('login');
});
```

**Resultado**: Usuários não autenticados são automaticamente direcionados ao login correto baseado na URL que tentaram acessar.

### 2. Redirecionamento Baseado em Role

**Localização**: `bootstrap/app.php`

```php
$middleware->redirectUsersTo(function (Request $request) {
    $user = $request->user();
    if ($user && $user->role === 'admin') {
        return route('admin.dashboard');
    }
    return route('municipality.dashboard');
});
```

**Resultado**: Após login, usuários são direcionados ao dashboard apropriado baseado em sua role.

### 3. Middleware de Proteção

#### EnsureUserIsAdmin
**Localização**: `app/Http/Middleware/EnsureUserIsAdmin.php`

```php
if (!$request->user() || $request->user()->role !== 'admin') {
    return redirect()->route('admin.login')
        ->with('error', 'Acesso negado. Apenas administradores podem acessar esta área.');
}
```

#### EnsureUserIsMunicipality
**Localização**: `app/Http/Middleware/EnsureUserIsMunicipality.php`

```php
if (!$request->user() || $request->user()->role !== 'municipality') {
    return redirect()->route('login')
        ->with('error', 'Acesso negado. Apenas municípios podem acessar esta área.');
}
```

**Aliases Registrados** (`bootstrap/app.php`):
```php
$middleware->alias([
    'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
    'municipality' => \App\Http\Middleware\EnsureUserIsMunicipality::class,
]);
```

### 4. Validação nos Controllers

#### AdminLoginController
**Localização**: `app/Http/Controllers/Auth/AdminLoginController.php`

```php
public function store(Request $request) {
    // Autenticação
    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('As credenciais fornecidas não correspondem aos nossos registros.'),
        ]);
    }
    
    // Validação de Role
    if (Auth::user()->role !== 'admin') {
        Auth::logout();
        throw ValidationException::withMessages([
            'email' => __('Você não tem permissão para acessar esta área. Use o login de município.'),
        ]);
    }
    
    $request->session()->regenerate();
    return redirect()->intended(route('admin.dashboard'));
}
```

#### AuthenticatedSessionController
**Localização**: `app/Http/Controllers/Auth/AuthenticatedSessionController.php`

```php
public function store(LoginRequest $request): RedirectResponse {
    $request->authenticate();
    $request->session()->regenerate();
    
    $user = Auth::user();
    
    // Rejeita administradores
    if ($user->role === 'admin') {
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Administradores devem usar o login administrativo.',
        ]);
    }
    
    return redirect()->intended(route('municipality.dashboard', absolute: false));
}
```

### 5. Proteção de Rotas

**Localização**: `routes/web.php`

#### Rotas Admin
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [AdminSubmissionController::class, 'dashboard'])->name('dashboard');
    // ... outras rotas admin
});
```

#### Rotas Município
```php
Route::middleware(['auth', 'municipality', CheckMustChangePassword::class])
    ->prefix('municipality')->name('municipality.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ... outras rotas município
});
```

## Fluxos de Autenticação

### Fluxo Admin

1. **Acesso não autenticado**: Visitando `/admin/dashboard`
   - Redirecionado para `/admin/login` (via smart guest redirect)

2. **Tentativa de Login**: Submetendo credenciais em `/admin/login`
   - `AdminLoginController` valida credenciais
   - Valida `role === 'admin'`
   - Se não for admin: logout + mensagem de erro
   - Se for admin: regenera sessão + redireciona para `admin.dashboard`

3. **Navegação protegida**: Acessando qualquer `/admin/*`
   - Middleware `'auth'` verifica autenticação
   - Middleware `'admin'` verifica role
   - Se falhar: redireciona para `admin.login` com erro

4. **Logout**: POST para `/admin/logout`
   - Faz logout
   - Redireciona para `/admin/login`

### Fluxo Município

1. **Acesso não autenticado**: Visitando `/municipality/dashboard`
   - Redirecionado para `/login` (via smart guest redirect)

2. **Tentativa de Login**: Submetendo credenciais em `/login`
   - `AuthenticatedSessionController` valida credenciais
   - Verifica se `role === 'admin'` → rejeita com erro
   - Se for municipality: regenera sessão + redireciona para `municipality.dashboard`

3. **Navegação protegida**: Acessando qualquer `/municipality/*`
   - Middleware `'auth'` verifica autenticação
   - Middleware `'municipality'` verifica role
   - Middleware `CheckMustChangePassword` verifica se precisa trocar senha
   - Se falhar: redireciona para login apropriado com erro

4. **Logout**: Logout padrão do Laravel
   - Faz logout
   - Redireciona para home

## Prevenção de Acesso Cruzado

### Admin tentando acessar área do Município

**Cenário 1**: Admin tenta fazer login em `/login`
- ✅ Autenticação sucede
- ❌ Controller detecta `role === 'admin'`
- 🚫 Logout forçado + mensagem: "Administradores devem usar o login administrativo"

**Cenário 2**: Admin (já autenticado) tenta acessar `/municipality/*`
- ❌ Middleware `'municipality'` detecta `role !== 'municipality'`
- 🚫 Redirecionado para `/login` com erro

### Município tentando acessar área Admin

**Cenário 1**: Município tenta fazer login em `/admin/login`
- ✅ Autenticação sucede
- ❌ Controller detecta `role !== 'admin'`
- 🚫 Logout forçado + mensagem: "Você não tem permissão para acessar esta área"

**Cenário 2**: Município (já autenticado) tenta acessar `/admin/*`
- ❌ Middleware `'admin'` detecta `role !== 'admin'`
- 🚫 Redirecionado para `/admin/login` com erro

## Arquivos Criados/Modificados

### Novos Arquivos

1. **app/Http/Controllers/Auth/AdminLoginController.php**
   - Controller dedicado para autenticação admin
   - Métodos: `create()`, `store()`, `destroy()`

2. **app/Http/Middleware/EnsureUserIsAdmin.php**
   - Middleware para proteger rotas admin
   - Valida `role === 'admin'`

3. **app/Http/Middleware/EnsureUserIsMunicipality.php**
   - Middleware para proteger rotas município
   - Valida `role === 'municipality'`

4. **resources/views/auth/admin-login.blade.php**
   - Interface de login dedicada para administradores
   - Tema vermelho/laranja com ícone de escudo
   - Links para login de município

### Arquivos Modificados

1. **bootstrap/app.php**
   - Adicionado smart guest redirect (closure)
   - Adicionado smart user redirect (closure)
   - Registrados middleware aliases: `'admin'` e `'municipality'`

2. **app/Http/Controllers/Auth/AuthenticatedSessionController.php**
   - Adicionada validação para rejeitar admins
   - Redirecionamento para `municipality.dashboard`

3. **routes/web.php**
   - Adicionadas rotas de login admin: GET/POST `/admin/login`
   - Adicionada rota de logout admin: POST `/admin/logout`
   - Atualizadas rotas admin com middleware `['auth', 'admin']`
   - Atualizadas rotas município com middleware `['auth', 'municipality', CheckMustChangePassword]`

4. **resources/views/auth/login.blade.php**
   - Adicionado link para login administrativo
   - Texto: "É um administrador? Acesse o login administrativo"

## Links entre Páginas

### De Login Município para Login Admin
**Localização**: `resources/views/auth/login.blade.php`
```html
<a href="{{ route('admin.login') }}" class="text-red-600 font-semibold hover:text-red-700 underline">
    Acesse o login administrativo
</a>
```

### De Login Admin para Login Município
**Localização**: `resources/views/auth/admin-login.blade.php`
```html
<a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:text-purple-700 underline">
    Acesse o login de município
</a>
```

### No Header do Login Admin
```html
<a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">
    Login Município
</a>
```

## Testes Recomendados

### 1. Teste de Login Admin
- [ ] Acessar `/admin/login`
- [ ] Verificar tema vermelho/laranja
- [ ] Login com `admin@crea-pr.org.br` / `admin123`
- [ ] Verificar redirecionamento para `/admin/dashboard`
- [ ] Verificar acesso a outras rotas admin

### 2. Teste de Login Município
- [ ] Acessar `/login`
- [ ] Verificar tema roxo/azul
- [ ] Login com credenciais de município
- [ ] Verificar redirecionamento para `/municipality/dashboard`
- [ ] Verificar acesso a outras rotas município

### 3. Teste de Rejeição Cruzada
- [ ] Tentar login admin em `/login` → deve rejeitar
- [ ] Tentar login município em `/admin/login` → deve rejeitar
- [ ] Admin autenticado acessar `/municipality/*` → deve bloquear
- [ ] Município autenticado acessar `/admin/*` → deve bloquear

### 4. Teste de Redirecionamento Inteligente
- [ ] Não autenticado acessar `/admin/dashboard` → redireciona para `/admin/login`
- [ ] Não autenticado acessar `/municipality/dashboard` → redireciona para `/login`
- [ ] Admin autenticado visitar home → pode acessar
- [ ] Município autenticado visitar home → pode acessar

### 5. Teste de Logout
- [ ] Admin faz logout → redireciona para `/admin/login`
- [ ] Município faz logout → redireciona para home
- [ ] Após logout, não consegue acessar áreas protegidas

## Segurança Implementada

✅ **Autenticação Separada**: Dois endpoints de login distintos
✅ **Validação de Role**: Dupla validação (controller + middleware)
✅ **Prevenção de Acesso Cruzado**: Impossível acessar área de outra role
✅ **Redirecionamento Inteligente**: Baseado em contexto de requisição e role do usuário
✅ **Logout Separado**: Cada role tem seu próprio fluxo de logout
✅ **Mensagens Claras**: Erros específicos para cada situação
✅ **Proteção em Camadas**: Controller → Middleware → Routes
✅ **Regeneração de Sessão**: Previne session fixation attacks
✅ **CSRF Protection**: Ativo em todos os formulários

## Manutenção

### Adicionando Nova Rota Admin
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/nova-funcionalidade', [NovoController::class, 'index'])->name('nova');
});
```

### Adicionando Nova Rota Município
```php
Route::middleware(['auth', 'municipality', CheckMustChangePassword::class])
    ->prefix('municipality')->name('municipality.')->group(function () {
    Route::get('/nova-funcionalidade', [NovoController::class, 'index'])->name('nova');
});
```

### Criando Novo Tipo de Usuário
1. Adicionar nova role na coluna `role` da tabela `users`
2. Criar novo middleware `EnsureUserIs{Role}.php`
3. Registrar middleware alias em `bootstrap/app.php`
4. Atualizar smart redirects em `bootstrap/app.php`
5. Criar controller de login específico
6. Criar view de login específica
7. Adicionar rotas protegidas com novo middleware

## Notas Importantes

⚠️ **Produção**: Antes de ir para produção, altere o rate limit de manifestação de interesse:
```php
// routes/web.php - linha 25
->middleware('throttle:60,60')  // DESENVOLVIMENTO
->middleware('throttle:5,60')   // PRODUÇÃO
```

⚠️ **Credenciais**: As credenciais admin são definidas em `database/seeders/DatabaseSeeder.php`. Altere antes de ir para produção.

⚠️ **Middleware Order**: A ordem dos middlewares importa:
1. `'auth'` - Verifica se está autenticado
2. `'admin'` ou `'municipality'` - Verifica role
3. `CheckMustChangePassword` - Verifica senha (apenas município)

---

**Documentação criada em**: 2025-01-XX  
**Versão do Sistema**: 1.0  
**Laravel Version**: 11.x
