# Sistema CREA-PR - Trilha dos 3E's

Sistema completo de Manifestação de Interesse para o CREA-PR, desenvolvido em Laravel (TALL Stack).

## 🎯 Funcionalidades

### Área Pública
- ✅ Formulário de Manifestação de Interesse completo e estilizado
- ✅ Validação de campos com lógica condicional (Alpine.js)
- ✅ Geração automática de protocolo único
- ✅ Página de confirmação com comprovante imprimível

### Área Administrativa (Protegida)
- ✅ Dashboard com estatísticas
- ✅ Listagem de todas as submissões com paginação
- ✅ **Filtros avançados** (município, lei de inovação, fundo, período)
- ✅ **Exportação para CSV** com todos os dados
- ✅ Visualização detalhada de cada submissão
- ✅ Sistema de autenticação com Laravel Breeze

## 🔐 Credenciais de Acesso

### Administrador
- **E-mail:** admin@creapr.org.br
- **Senha:** admin123

## 🚀 Rotas do Sistema

### Rotas Públicas
- `GET /` - Página inicial
- `GET /manifestacao-interesse` - Formulário de manifestação
- `POST /manifestacao-interesse` - Envio do formulário
- `GET /inscricao-concluida/{protocolo}` - Comprovante de envio

### Rotas Administrativas (requerem login)
- `GET /admin/dashboard` - Dashboard administrativo
- `GET /admin/submissoes` - Lista de submissões (com filtros)
- `GET /admin/submissoes/exportar` - Exportar submissões para CSV
- `GET /admin/submissoes/{id}` - Detalhes da submissão

### Rotas de Autenticação
- `GET /login` - Página de login
- `POST /login` - Efetuar login
- `POST /logout` - Sair do sistema
- `GET /register` - Registrar novo usuário (opcional)

## 📊 Estrutura do Banco de Dados

### Tabela: submissions
Armazena todas as manifestações de interesse com os seguintes blocos:

1. **Informações do Município**
   - Nome, Prefeito, Mandato, População

2. **Marco Legal e Institucional**
   - Lei de Inovação
   - Fundo de Inovação
   - Conselho de CTI

3. **Governança e Estrutura**
   - Normativa de Governança Digital
   - Secretaria de CTI

4. **Contratos e Políticas Públicas**
   - Contratos com soluções inovadoras
   - Sandbox Regulatório
   - Living Lab
   - Transformação Digital

5. **Ecossistema de Inovação**
   - Número de startups
   - Ambientes de inovação
   - Hackathons realizados

6. **Planejamento e Relevância**
   - Planejamento Estratégico
   - Relevância das Engenharias

7. **Premiações**
   - Prêmios de inovação recebidos

8. **Ponto Focal**
   - Dados de contato do responsável

## 🎨 Tecnologias Utilizadas

- **Framework:** Laravel 12
- **CSS:** Tailwind CSS
- **JavaScript:** Alpine.js
- **Autenticação:** Laravel Breeze
- **Banco de Dados:** SQLite (configurável para MySQL/PostgreSQL)

## 🛠️ Comandos Úteis

### Iniciar o servidor
```bash
php artisan serve
```
Acesse: http://localhost:8000

### Criar novo usuário admin
```bash
php artisan db:seed --class=AdminUserSeeder
```

### Limpar cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Executar migrations
```bash
php artisan migrate
```

### Resetar banco de dados
```bash
php artisan migrate:fresh --seed
```

## 📁 Estrutura de Arquivos Principais

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── PublicFormController.php
│   │   └── Admin/
│   │       └── AdminSubmissionController.php
│   └── Requests/
│       └── StoreSubmissionRequest.php
├── Models/
│   └── Submission.php

resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php
    │   └── admin.blade.php
    ├── public/
    │   ├── form.blade.php
    │   └── success.blade.php
    └── admin/
        ├── dashboard.blade.php
        └── submissions/
            ├── index.blade.php
            └── show.blade.php

database/
└── migrations/
    └── 2025_11_12_012342_create_submissions_table.php

routes/
└── web.php
```

## 🎯 Fluxo de Uso

### Para Municípios (Usuários Públicos)
1. Acessar `/manifestacao-interesse`
2. Preencher o formulário completo
3. Campos condicionais aparecem dinamicamente
4. Submeter o formulário
5. Receber número de protocolo único
6. Imprimir comprovante

### Para Administradores (CREA-PR)
1. Fazer login em `/login`
2. Acessar dashboard em `/admin/dashboard`
3. Visualizar estatísticas gerais
4. Listar submissões em `/admin/submissoes`
5. **Aplicar filtros** por município, lei de inovação, fundo ou período
6. **Exportar dados filtrados** para CSV
7. Ver detalhes de cada manifestação
8. Imprimir relatórios

## ⚠️ Validações Implementadas

- Todos os campos obrigatórios são validados
- URLs devem ser válidas
- E-mails devem ter formato correto
- Campos condicionais só são obrigatórios quando aplicável
- CNPJ e telefones são validados por formato
- Checkbox de declaração é obrigatório

## 🎨 Características de Design

- **Responsivo:** Funciona em desktop, tablet e mobile
- **Cores:** Esquema de cores profissional com gradientes
- **UX:** Campos agrupados por blocos temáticos
- **Acessibilidade:** Labels claros e contrastes adequados
- **Interatividade:** Campos aparecem/desaparecem dinamicamente
- **Feedback Visual:** Estados hover, focus e transições suaves

## 📝 Notas Importantes

1. **Protocolo:** Gerado automaticamente no formato `CREA-YYYY-XXXX`
2. **Validação:** A manifestação só é válida após recebimento de ofício do Prefeito
3. **Arrays:** Ambientes de inovação e hackathons são salvos como JSON
4. **Segurança:** Área administrativa protegida por autenticação
5. **Performance:** Paginação implementada na listagem

## 🔄 Próximos Passos (Sugestões)

- [x] Exportação de relatórios em CSV
- [x] Filtros e busca na listagem de submissões
- [ ] E-mail de confirmação automático
- [ ] Status de avaliação da manifestação
- [ ] Upload de documentos comprobatórios
- [ ] API REST para integração externa
- [ ] Notificações por e-mail para admins
- [ ] Exportação em Excel/PDF

## 📞 Contato

Sistema desenvolvido para o CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná

---

**Desenvolvido com ❤️ usando Laravel + TALL Stack**

## 🎭 Máscaras de Formatação Implementadas

O formulário possui máscaras JavaScript para facilitar o preenchimento e garantir a formatação correta:

### Campos com Máscara:

1. **CNPJ do Fundo de Inovação**
   - Formato: `00.000.000/0000-00`
   - Aceita apenas números
   - Formatação automática durante digitação

2. **Telefone Fixo**
   - Formato: `(00) 0000-0000`
   - Aceita apenas números
   - Formatação automática durante digitação

3. **Celular**
   - Formato: `(00) 00000-0000`
   - Aceita apenas números
   - Formatação automática durante digitação

### Campo de Mandato Atualizado:

O campo "Mandato do Prefeito" agora aceita:
- 1º Mandato
- 2º Mandato
- 3º Mandato
- 4º Mandato
- 5º Mandato ou mais

## 🎨 Logo do CREA-PR

A logo oficial do CREA-PR (`logo-crea-pr-preto.png`) foi integrada em:
- ✅ Cabeçalho do formulário público
- ✅ Página de confirmação/comprovante
- ✅ Layout do painel administrativo

**Localização da logo:** `/public/assets/img/logo-crea-pr-preto.png`

## 🔍 Filtros e Exportação de Dados

### Filtros Disponíveis

Na página de listagem de submissões (`/admin/submissoes`), você pode filtrar os dados por:

1. **Município** - Busca por nome do município (parcial ou completo)
2. **Possui Lei de Inovação** - Filtra municípios que possuem ou não a lei
3. **Possui Fundo de Inovação** - Filtra municípios com ou sem fundo
4. **Data Inicial** - Submissões a partir de determinada data
5. **Data Final** - Submissões até determinada data

**Como usar:**
- Clique no botão "Mostrar Filtros"
- Preencha os campos desejados
- Clique em "Aplicar Filtros"
- Use "Limpar Filtros" para resetar

### Exportação CSV

O sistema permite exportar todas as submissões (ou apenas as filtradas) para arquivo CSV.

**Características:**
- ✅ Formato CSV com separador `;` (compatível com Excel)
- ✅ Codificação UTF-8 com BOM (acentos corretos)
- ✅ Respeita os filtros aplicados
- ✅ Nome do arquivo: `submissoes_crea_pr_YYYY-MM-DD_HHMMSS.csv`
- ✅ **Todos os 40 campos são exportados** (sem perda de dados)

**Campos exportados (40 colunas completas):**

**Dados do Município:**
- Protocolo, Município, Prefeito, Mandato, População

**Bloco 1 - Marco Legal e Institucional:**
- Lei de Inovação, Link Lei
- Fundo de Inovação, CNPJ Fundo
- Conselho CTI, Link Portaria Conselho

**Bloco 2 - Governança e Estrutura:**
- Normativa Governança Digital, Link Normativa
- Secretaria CTI, Órgão Responsável CTI

**Bloco 3 - Contratos e Políticas Públicas:**
- Contrato Solução Inovadora, Link Evidência
- Política Sandbox, Link Evidência
- Política Living Lab, Link Evidência
- Estratégia Transformação Digital, Link Evidência

**Bloco 4 - Ecossistema de Inovação:**
- Número de Startups
- Ambientes de Inovação (lista)
- Hackathons Realizados (lista)

**Bloco 5 - Planejamento e Relevância:**
- Planejamento Estratégico, Link Evidência
- Relevância Engenharias
- Descrição Relevância Engenharias

**Bloco 6 - Premiações:**
- Ganhou Prêmio Inovação
- Descrição Prêmio

**Bloco 7 - Ponto Focal:**
- Nome, Cargo, Email, Telefone, Celular

**Meta:**
- Data de Submissão

**Como usar:**
1. Acesse `/admin/submissoes`
2. Aplique filtros se desejar (opcional)
3. Clique no botão verde "Exportar CSV"
4. O arquivo será baixado automaticamente

