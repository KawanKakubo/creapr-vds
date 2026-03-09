# 🚀 Guia Rápido de Inicialização

## Setup Inicial (5 minutos)

### 1. Instalar Dependências
```powershell
composer install
npm install
```

### 2. Configurar Ambiente
```powershell
# Copiar arquivo de ambiente
Copy-Item .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### 3. Configurar .env
Edite o arquivo `.env` e configure:

```env
# Aplicação
APP_NAME="Smart Crea Cities"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de Dados PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=creapr_vds
DB_USERNAME=postgres
DB_PASSWORD=sua_senha

# Email (Mailtrap para testes)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_mailtrap_username
MAIL_PASSWORD=seu_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@creapr.org.br
MAIL_FROM_NAME="Smart Crea Cities"
```

### 4. Criar Banco de Dados
```sql
-- No PostgreSQL
CREATE DATABASE creapr_vds;
```

### 5. Rodar Migrations + Seeders
```powershell
php artisan migrate:fresh --seed
```

Isso irá:
- ✅ Criar todas as tabelas
- ✅ Popular 35 questões diagnósticas
- ✅ Preparar estrutura completa

### 6. Criar Usuário Admin
```powershell
php artisan tinker
```

Dentro do Tinker:
```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin CREA-PR',
    'email' => 'admin@creapr.org.br',
    'password' => Hash::make('admin123'),
    'role' => 'admin',
    'must_change_password' => false
]);

exit
```

### 7. Iniciar Servidor
```powershell
php artisan serve
```

Acesse: http://localhost:8000

---

## ⚡ Teste Rápido (10 minutos)

### Teste 1: Submissão de Manifestação
1. Acesse http://localhost:8000
2. Clique em "Manifestar Interesse"
3. Preencha:
   - **Município**: Curitiba
   - **Habitantes**: 1900000
   - **Regional**: Curitiba
   - **Setores**: Tecnologia, Educação
   - **Mais Engenharia**: **Sim**
   - **Responsável**: João Silva
   - **Email**: teste@curitiba.pr.gov.br
   - **Cargo**: Secretário
   - **Telefone**: (41) 99999-9999
   - **CPF**: 12345678900
   - **Prefeito**: Maria Santos
   - **Tel Prefeito**: (41) 98888-8888
4. Finalize e copie **email + senha** exibidos

**✅ Verificar**: 
- Protocolo gerado (formato: SCC-YYYYMMDD-XXXXX)
- Credenciais exibidas
- 2 emails enviados (verificar Mailtrap)

---

### Teste 2: Login e Troca de Senha
1. Acesse http://localhost:8000/login
2. Entre com email e senha copiados
3. Você será **redirecionado automaticamente** para troca de senha
4. Digite nova senha (mínimo 8 caracteres)
5. Confirme e submeta

**✅ Verificar**:
- Redirect para dashboard do município
- Flash message verde de sucesso
- Dashboard carrega corretamente

---

### Teste 3: Aprovação pelo Admin
1. Faça logout
2. Acesse http://localhost:8000/login
3. Entre com:
   - **Email**: admin@creapr.org.br
   - **Senha**: admin123
4. Você verá o **Dashboard Admin** com gráficos
5. Clique em "Ver Submissões"
6. Clique em "Ver Detalhes" na submissão criada
7. Altere status para **"Aprovado"**
8. Adicione observação: "Município aprovado para participação"
9. Clique em "Salvar Alterações"

**✅ Verificar**:
- Flash message verde
- Status atualizado
- Email de aprovação enviado

---

### Teste 4: Preencher Diagnóstico
1. Faça logout do admin
2. Faça login novamente como município (email teste@curitiba.pr.gov.br)
3. Dashboard agora mostra **botões dos diagnósticos liberados**
4. Clique em "Diagnóstico de Estímulo"
5. Preencha as **12 questões** (variedade de tipos)
6. Clique em "Finalizar Diagnóstico"

**✅ Verificar**:
- Redirect para dashboard
- Gauge de Estímulo atualizado (0-100 pontos)
- Badge "Concluído" aparece

---

### Teste 5: Gerenciar Questões
1. Faça login como admin
2. Clique em "Gerenciar Questões"
3. Visualize as **35 questões** listadas
4. Clique em "+ Nova Questão"
5. Preencha:
   - **Categoria**: Educação
   - **Questão**: O município possui biblioteca digital?
   - **Tipo**: yes_no
   - **Ordem**: 13
   - **Ativa**: ✓
6. Clique em "Criar Questão"

**✅ Verificar**:
- Questão criada com sucesso
- Aparece na listagem
- Preview funcionou ao vivo

7. Clique em "Editar" na nova questão
8. Altere tipo para **"checkbox"**
9. Adicione 3 opções:
   - "E-books"
   - "Audiolivros"
   - "Revistas digitais"
10. Salve alterações

**✅ Verificar**:
- Options builder funcionou
- Preview mudou para checkboxes
- Questão atualizada

---

## 📊 URLs Principais

| Rota | Descrição |
|------|-----------|
| http://localhost:8000 | Landing page |
| http://localhost:8000/manifestacao-interesse | Formulário de manifestação |
| http://localhost:8000/login | Login |
| http://localhost:8000/municipality/dashboard | Dashboard do município |
| http://localhost:8000/admin/dashboard | Dashboard admin |
| http://localhost:8000/admin/submissoes | Gerenciar submissões |
| http://localhost:8000/admin/questions | Gerenciar questões |

---

## 🔧 Comandos Úteis Durante Testes

```powershell
# Resetar banco e recriar tudo
php artisan migrate:fresh --seed

# Limpar cache
php artisan cache:clear
php artisan config:clear

# Ver logs de erro
Get-Content storage/logs/laravel.log -Tail 50

# Verificar rotas
php artisan route:list --path=admin

# Testar email manualmente (Tinker)
php artisan tinker
>>> Mail::to('teste@example.com')->send(new \\App\\Mail\\CredentialsEmail(['email' => 'teste@example.com', 'password' => '123456', 'protocolo' => 'SCC-20260309-12345']));
```

---

## 🐛 Troubleshooting

### Erro: "SQLSTATE[08006] Connection refused"
**Solução**: PostgreSQL não está rodando
```powershell
# Inicie o serviço PostgreSQL
# Windows: Services.msc → PostgreSQL → Start
```

### Erro: "Class 'Hash' not found"
**Solução**: Falta importação no Tinker
```php
use Illuminate\\Support\\Facades\\Hash;
```

### Emails não chegam
**Verificar**:
1. Credenciais corretas no `.env`
2. Mailtrap configurado
3. Logs em `storage/logs/laravel.log`

### Gráficos não aparecem
**Verificar**:
1. Chart.js CDN carregou (F12 → Network)
2. Dados sendo passados corretamente (View Source → procurar por chart data)
3. JavaScript sem erros (F12 → Console)

### "419 Page Expired" ao submeter formulários
**Solução**: 
1. Limpe cache: `php artisan cache:clear`
2. Verifique se `@csrf` está em todos os forms

---

## 📝 Credenciais Padrão

### Admin
- **Email**: admin@creapr.org.br
- **Senha**: admin123

### Município (após criar via formulário)
- **Email**: o que você preencheu no formulário
- **Senha**: a gerada automaticamente (copie da tela de sucesso)

---

## ✅ Checklist de Validação

Após rodar os testes, valide se:

- [ ] Landing page carrega sem erros
- [ ] Formulário multi-step funciona
- [ ] Emails são enviados (verificar Mailtrap)
- [ ] Login funciona
- [ ] Troca de senha obrigatória funciona
- [ ] Dashboard município exibe dados corretos
- [ ] Comitê pode adicionar/remover membros
- [ ] Diagnósticos só aparecem após aprovação admin
- [ ] Questões são carregadas corretamente
- [ ] Pontuação calcula automaticamente
- [ ] Dashboard admin exibe gráficos
- [ ] Filtros de submissões funcionam
- [ ] Aprovação envia email automático
- [ ] Export CSV baixa arquivo
- [ ] Gerenciamento de questões funciona
- [ ] Options builder funciona
- [ ] Ações em lote funcionam
- [ ] Preview de questões atualiza ao vivo

---

## 🎯 Próximos Passos Após Validação

1. **Correções de Bugs**: Anote todos os problemas encontrados
2. **Ajustes de UX**: Feedback sobre interface
3. **Configuração SMTP Real**: Trocar Mailtrap por servidor real
4. **Deploy**: Preparar ambiente de produção
5. **Documentação**: Criar manual para usuários finais
6. **Treinamento**: Capacitar equipe CREA-PR

---

**MVP Entregue! Agora é testar e validar! 🎉**

Se encontrar qualquer problema, compartilhe:
- URL onde ocorreu
- Mensagem de erro
- O que esperava vs o que aconteceu
- Logs (storage/logs/laravel.log)

Boa sorte nos testes! 🚀
