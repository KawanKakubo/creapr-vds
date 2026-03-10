# 📧 Guia: Como Testar Envio de E-mails

## Status Atual
- ✅ QUEUE_CONNECTION=database (Fila configurada)
- ⚠️ MAIL_MAILER=log (Emails salvos em log, NÃO são enviados de verdade)

---

## 🔥 OPÇÃO 1: Mailtrap (RECOMENDADO para desenvolvimento)

### Passo 1: Criar conta no Mailtrap
1. Acesse: https://mailtrap.io/
2. Crie uma conta gratuita
3. Vá em "Email Testing" > "Inboxes" > "My Inbox"
4. Copie as credenciais SMTP

### Passo 2: Configurar .env
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_username_do_mailtrap
MAIL_PASSWORD=sua_senha_do_mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@creapr.org.br"
MAIL_FROM_NAME="Smart Crea Cities"
```

### Passo 3: Limpar cache
```bash
php artisan config:clear
php artisan cache:clear
```

### Passo 4: Testar
1. Preencha o formulário de manifestação de interesse
2. Vá no Mailtrap e veja o email recebido!

---

## 📬 OPÇÃO 2: Gmail (Para produção/teste real)

### Passo 1: Criar senha de app do Gmail
1. Acesse: https://myaccount.google.com/security
2. Ative "Verificação em duas etapas"
3. Em "Senhas de app", crie uma nova senha
4. Copie a senha gerada (16 caracteres)

### Passo 2: Configurar .env
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_de_app_16_caracteres
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="seu_email@gmail.com"
MAIL_FROM_NAME="Smart Crea Cities"
```

### Passo 3: Limpar cache
```bash
php artisan config:clear
php artisan cache:clear
```

---

## 📝 OPÇÃO 3: Ver nos Logs (Atual)

### Para ver emails dos logs:
```bash
# Windows PowerShell
Get-Content storage\logs\laravel.log -Tail 100 | Select-String -Pattern "MAIL"

# Ou abra diretamente:
notepad storage\logs\laravel.log
```

---

## 🔄 Testando com Filas

Como `QUEUE_CONNECTION=database`, os emails vão para fila.

### Iniciar o worker da fila:
```bash
php artisan queue:work
```

**OU** processar fila manualmente:
```bash
php artisan queue:work --once
```

### Ver jobs na fila:
```bash
php artisan queue:failed
```

---

## ✅ Teste Completo - Passo a Passo

1. **Escolha uma opção acima** (Mailtrap recomendado)

2. **Configure o .env**

3. **Limpe o cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. **Inicie o worker da fila** (em um terminal separado):
   ```bash
   php artisan queue:work
   ```

5. **Preencha o formulário:**
   - Acesse: http://localhost/manifestacao-interesse
   - OU: https://sistema.creapr.org.br/manifestacao-interesse
   - Preencha todos os dados
   - Envie

6. **Verifique:**
   - No Mailtrap: veja o email na inbox
   - No Gmail: veja no seu email
   - Nos Logs: veja em storage/logs/laravel.log

---

## 🐛 Troubleshooting

### Email não chegou?
1. Verifique se o worker está rodando: `php artisan queue:work`
2. Veja se há jobs falhados: `php artisan queue:failed`
3. Veja os logs: `storage\logs\laravel.log`
4. Verifique o .env: `php artisan config:show mail`

### Reprocessar jobs falhados:
```bash
php artisan queue:retry all
```

### Limpar fila:
```bash
php artisan queue:flush
```

---

## 📊 Ver configuração atual de email:
```bash
php artisan config:show mail
```
