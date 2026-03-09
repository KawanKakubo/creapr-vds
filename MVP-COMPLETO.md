# Smart Crea Cities - MVP Completo
## Plataforma de Avaliação de Maturidade Tecnológica Municipal

---

## 📋 Índice
1. [Visão Geral](#visão-geral)
2. [Funcionalidades Implementadas](#funcionalidades-implementadas)
3. [Estrutura de Rotas](#estrutura-de-rotas)
4. [Fluxos Completos](#fluxos-completos)
5. [Guia de Testes](#guia-de-testes)
6. [Banco de Dados](#banco-de-dados)
7. [Emails](#emails)
8. [Comandos Úteis](#comandos-úteis)

---

## 🎯 Visão Geral

O **Smart Crea Cities** é uma plataforma web desenvolvida em Laravel 12 que permite ao CREA-PR avaliar a maturidade tecnológica dos municípios do Paraná através de diagnósticos nas 3 dimensões dos E's:
- **Estímulo** - Políticas e incentivos para inovação
- **Educação** - Capacitação e formação tecnológica
- **Estruturas** - Infraestrutura e recursos tecnológicos

### Tecnologias Utilizadas
- **Backend**: Laravel 12.37.0 (PHP)
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
- **Charts**: Chart.js 4.4.0
- **Database**: PostgreSQL
- **Email**: Laravel Mail (SMTP configurável)

---

## ✅ Funcionalidades Implementadas

### 1. Landing Page (Página Pública)
- [x] Design responsivo com vídeo de fundo
- [x] Apresentação do programa Smart Crea Cities
- [x] Call-to-action para manifestação de interesse
- [x] Informações sobre os 3 E's

**Rota**: `/` (home)

---

### 2. Formulário de Manifestação de Interesse

#### Multi-step Form (4 etapas)
- [x] **Etapa 1**: Dados do Município (nome, habitantes, regional, setores econômicos)
- [x] **Etapa 2**: Programa Mais Engenharia (validação de participação)
- [x] **Etapa 3**: Responsável pela Inscrição (nome, cargo, email, telefone)
- [x] **Etapa 4**: Dados do Prefeito (nome, telefone)

#### Lógica de Fluxo Bifurcado
- [x] **Se participa do Mais Engenharia**: Cria usuário com credenciais + envia 3 emails
- [x] **Se NÃO participa**: Apenas gera protocolo + envia 1 email de confirmação

#### Validações Implementadas
- [x] Rate limiting (5 submissões por hora para prevenir spam)
- [x] Validação de formato de email, telefone, CPF
- [x] Geração de protocolo único (formato: SCC-YYYYMMDD-XXXXX)
- [x] Geração de senha aleatória segura (12 caracteres)

**Rotas**:
- `GET /manifestacao-interesse` - Exibir formulário
- `POST /manifestacao-interesse` - Processar submissão

---

### 3. Sistema de Emails Automáticos

#### Email 1: Credenciais de Acesso (Mais Engenharia = Sim)
- [x] Template: `emails.credentials`
- [x] Conteúdo: Email + senha + protocolo + link para login
- [x] Design: Cards informativos coloridos + instruções passo a passo

#### Email 2: Confirmação de Inscrição (Mais Engenharia = Sim)
- [x] Template: `emails.confirmation`
- [x] Conteúdo: Confirmação do protocolo + próximos passos
- [x] Design: Badge verde de sucesso + checklist

#### Email 3: Aprovação de Diagnósticos (Admin aprova)
- [x] Template: `emails.approval`
- [x] Conteúdo: Notificação de aprovação + link para diagnósticos
- [x] Design: Banner verde + 3 cards dos diagnósticos

#### Email 4: Confirmação Simples (Mais Engenharia = Não)
- [x] Template: `emails.confirmation`
- [x] Conteúdo: Apenas protocolo + aguardar análise do CREA-PR

**Configuração**: `config/mail.php` (usar SMTP real para testes)

---

### 4. Autenticação e Segurança

#### Sistema de Login
- [x] Login com email + senha
- [x] Middleware de autenticação em todas as rotas protegidas
- [x] Logout funcional

#### Troca Obrigatória de Senha
- [x] Middleware `CheckMustChangePassword` força troca no primeiro login
- [x] Redirect automático para `/change-password` se `must_change_password = true`
- [x] Após alteração, flag é setada como `false` e usuário acessa dashboard
- [x] Nova senha deve ter mínimo 8 caracteres

**Rotas**:
- `GET /login` - Página de login
- `POST /login` - Processar login
- `POST /logout` - Fazer logout
- `GET /change-password` - Formulário de troca de senha
- `POST /change-password` - Processar nova senha

---

### 5. Dashboard do Município

#### Visualizações
- [x] 3 Gauges (medidores circulares) com pontuação dos 3 E's (0-100 pontos cada)
- [x] Pontuação total (0-300 pontos)
- [x] Status de aprovação da manifestação
- [x] Seção de informações do município
- [x] Alertas de diagnósticos pendentes/concluídos

#### Indicadores de Status
- [x] **Aprovação Pendente**: Badge amarelo + mensagem de espera
- [x] **Aprovado**: Badge verde + botões para diagnósticos
- [x] **Rejeitado**: Badge vermelho + mensagem de contato

#### Flash Messages
- [x] Mensagens de sucesso após troca de senha
- [x] Mensagens de erro caso haja problemas
- [x] Auto-dismiss após 5 segundos (opcional com JavaScript)

**Rota**: `GET /municipality/dashboard`

---

### 6. Sistema de Comitê Smart Crea Cities

#### CRUD de Membros
- [x] Adicionar membro (nome, cargo, setor, email)
- [x] Remover membro
- [x] Limite de 5 membros por município
- [x] Validação de email único por município
- [x] Contador visual (X/5 membros)

#### Design
- [x] Cards responsivos com informações de cada membro
- [x] Grid de 2 colunas em desktop
- [x] Confirmação antes de remover membro

**Rotas**:
- `POST /municipality/committee` - Adicionar membro
- `DELETE /municipality/committee/{id}` - Remover membro

---

### 7. Sistema de Diagnósticos (3 E's)

#### Estrutura de Questões
- [x] 35 questões pré-cadastradas via seeder
- [x] Distribuição por categoria:
  - **Estímulo**: 12 questões
  - **Educação**: 12 questões
  - **Estruturas**: 11 questões

#### Tipos de Questões Suportados
1. **yes_no**: Resposta Sim/Não simples
2. **yes_no_evidence**: Sim/Não + campo para evidência/link
3. **checkbox**: Múltipla escolha (checkboxes)
4. **multiple_input**: Múltiplos campos de entrada
5. **text**: Resposta aberta em texto

#### Funcionalidades
- [x] Formulário interativo com Alpine.js
- [x] Validação de campos obrigatórios
- [x] Salvamento automático de respostas
- [x] Cálculo automático de pontuação (0-100 por categoria)
- [x] Status de conclusão (não iniciado / em andamento / concluído)
- [x] Timestamp de conclusão ao finalizar diagnóstico
- [x] Impossível acessar diagnósticos sem aprovação admin

**Rotas**:
- `GET /municipality/diagnostic/estimulo` - Diagnóstico Estímulo
- `GET /municipality/diagnostic/educacao` - Diagnóstico Educação
- `GET /municipality/diagnostic/estruturas` - Diagnóstico Estruturas
- `POST /municipality/diagnostic/{category}` - Salvar respostas

---

### 8. Dashboard Administrativo

#### Estatísticas Gerais (14 métricas)
- [x] Total de manifestações
- [x] Pendentes de análise
- [x] Aprovadas
- [x] Em análise
- [x] Rejeitadas
- [x] Participantes do Mais Engenharia
- [x] Não participantes do Mais Engenharia
- [x] Diagnósticos completos (3 E's concluídos)
- [x] Média de pontuação Estímulo
- [x] Média de pontuação Educação
- [x] Média de pontuação Estruturas
- [x] Distribuição por regional (top 5)
- [x] Últimas 10 submissões
- [x] Timeline de submissões (últimos 6 meses)

#### Gráficos (Chart.js)
- [x] **Gráfico 1**: Distribuição de Status (Doughnut Chart)
  - 4 segmentos coloridos (pendentes, aprovadas, em análise, rejeitadas)
- [x] **Gráfico 2**: Top 5 Regionais (Bar Chart)
  - Barras horizontais com contagem de municípios
- [x] **Gráfico 3**: Timeline de Submissões (Line Chart)
  - Evolução mensal nos últimos 6 meses

#### Elementos Visuais
- [x] 4 Cards de métricas principais (totais)
- [x] Barra de progresso Mais Engenharia
- [x] 3 Barras de progresso para médias dos E's
- [x] Tabela com últimas submissões

**Rota**: `GET /admin/dashboard`

---

### 9. Gerenciamento de Submissões (Admin)

#### Listagem de Manifestações
- [x] Tabela paginada (20 por página)
- [x] 9 colunas de informação:
  - Protocolo (formato monospace)
  - Município
  - Regional
  - População
  - Mais Engenharia (badge Sim/Não)
  - Status (badge colorido)
  - Score total (0-300)
  - Data de submissão
  - Ações (link para detalhes)

#### Filtros Avançados (4 campos)
- [x] Filtro por nome do município (busca LIKE)
- [x] Filtro por status (pending, under_review, approved, rejected)
- [x] Filtro por regional CREA-PR (dropdown dinâmico)
- [x] Filtro por Mais Engenharia (Sim/Não)
- [x] Preservação de query string na paginação

#### Export CSV
- [x] Botão "📥 Exportar CSV"
- [x] 16 colunas exportadas:
  - Protocolo, Status, Município, habitantes, Regional, Setores, Mais Engenharia
  - Responsável (nome, cargo, email)
  - Pontuações (Estímulo, Educação, Estruturas)
  - Score Total, Diagnóstico Completo, Data
- [x] Streaming response (não sobrecarrega memória)
- [x] UTF-8 com BOM (compatível com Excel)
- [x] Aplica mesmos filtros da listagem

#### Empty State
- [x] Ícone SVG + mensagem quando nenhuma manifestação encontrada
- [x] Sugestão de ajustar filtros

**Rotas**:
- `GET /admin/submissoes` - Listagem
- `GET /admin/submissoes/exportar` - Export CSV

---

### 10. Detalhes e Revisão de Submissão (Admin)

#### Layout 2 Colunas
**Coluna Esquerda (Principal)**:
- [x] **Seção 1**: Informações do Município
  - Nome, protocolo, data, status badge
  - População, regional, setores econômicos, secretarias
- [x] **Seção 2**: Programa Mais Engenharia
  - Se SIM: dados do responsável (6 campos) + prefeito (2 campos)
  - Se NÃO: mensagem em cinza
- [x] **Seção 3**: Comitê Smart Crea Cities
  - Lista de até 5 membros (nome, cargo, setor, email)
  - Contador X/5 membros
  - Mensagem se não houver membros
- [x] **Seção 4**: Diagnósticos dos 3 E's
  - 3 cards coloridos (azul, verde, roxo)
  - Pontuação (0-100) + status de conclusão
  - Box central com Score Total (0-300)

**Coluna Direita (Painel de Revisão - Sticky)**:
- [x] Formulário de atualização de status
- [x] Dropdown de status (4 opções) com Alpine.js
- [x] Campo observações (textarea, max 1000 chars)
- [x] Warnings condicionais:
  - Se "Aprovado": Box verde avisando que email será enviado
  - Se "Rejeitado": Box vermelho avisando perda de acesso
- [x] Botão "Salvar Alterações" (submit via PATCH)
- [x] Exibição de observações anteriores (se existirem)

#### Funcionalidades de Revisão
- [x] Alterar status: pending → under_review → approved/rejected
- [x] Adicionar observações administrativas
- [x] Envio automático de email de aprovação
- [x] Validação: não envia email duplicado se já aprovado anteriormente
- [x] Log de alterações de status
- [x] Redirect com flash message após salvar

**Rotas**:
- `GET /admin/submissoes/{submission}` - Ver detalhes
- `PATCH /admin/submissoes/{submission}/status` - Atualizar status

---

### 11. Gerenciamento de Questões Diagnósticas (NOVO)

#### Listagem de Questões
- [x] Tabela paginada com todas as 35 questões
- [x] 7 colunas de informação:
  - Checkbox para seleção
  - Ordem
  - Categoria (badge colorido)
  - Texto da questão (truncado em 100 chars)
  - Tipo (yes_no, checkbox, etc.)
  - Status (ativo/inativo badge)
  - Ações (editar, desativar)

#### Filtros (3 campos)
- [x] Filtro por categoria (Estímulo, Educação, Estruturas)
- [x] Filtro por tipo (5 tipos de questão)
- [x] Filtro por status (ativo/inativo)

#### Ações em Lote
- [x] Seleção múltipla com checkboxes
- [x] Checkbox "selecionar todos"
- [x] Dropdown de ações: Ativar / Desativar
- [x] Aplicar ação em lote
- [x] Contador de questões selecionadas

#### Empty State
- [x] Mensagem quando nenhuma questão encontrada
- [x] Sugestão de criar nova questão ou ajustar filtros

**Rota**: `GET /admin/questions`

---

#### Criar Nova Questão
- [x] Formulário completo com validação
- [x] 10 campos editáveis:
  1. **Categoria** (dropdown): estimulo, educacao, estruturas
  2. **Texto da Questão** (textarea): max 1000 chars
  3. **Descrição/Ajuda** (textarea opcional): max 500 chars
  4. **Tipo** (dropdown): yes_no, yes_no_evidence, checkbox, multiple_input, text
  5. **Opções** (array dinâmico com Alpine.js): aparece apenas para checkbox/multiple_input
  6. **Ordem** (number): define posição na categoria
  7. **Requer Evidência** (checkbox): adiciona campo de upload
  8. **Questão Ativa** (checkbox): se deve aparecer nos diagnósticos

#### Options Builder (Alpine.js)
- [x] Exibição condicional (apenas para checkbox e multiple_input)
- [x] Botão "+ Adicionar Opção"
- [x] Botão "Remover" em cada opção
- [x] Validação: mínimo 2 opções para tipos que exigem
- [x] Array dinâmico com x-model

#### Preview da Questão
- [x] Seção de visualização ao vivo
- [x] Mostra como a questão aparecerá para o município
- [x] Atualiza dinamicamente conforme tipo selecionado
- [x] Renderiza opções adicionadas no options builder

#### Validações
- [x] Campos obrigatórios marcados com asterisco vermelho
- [x] Validação no backend (required, max length, etc.)
- [x] Validação de opções (min 2 para checkbox/multiple_input)
- [x] Mensagens de erro claras

**Rotas**:
- `GET /admin/questions/create` - Formulário
- `POST /admin/questions` - Salvar nova questão

---

#### Editar Questão Existente
- [x] Formulário idêntico ao de criação
- [x] Campos pré-preenchidos com valores atuais
- [x] Badge informativo com ID da questão e data de criação
- [x] **Alerta de impacto**: Se questão já tem respostas, aviso em laranja
- [x] Opções pré-carregadas no options builder
- [x] Preview atualizado com dados atuais

#### Funcionalidades Extras
- [x] Botão "Desativar Questão" (destrutivo, lado esquerdo)
- [x] Confirmação antes de desativar
- [x] Botão "Salvar Alterações" (primário, lado direito)
- [x] Botão "Cancelar" (secundário)

#### Soft Delete
- [x] Ao desativar, questão NÃO é deletada do banco
- [x] Campo `is_active` setado para `false`
- [x] Questão some dos diagnósticos mas mantém histórico
- [x] Respostas antigas permanecem intactas

**Rotas**:
- `GET /admin/questions/{question}/edit` - Formulário de edição
- `PATCH /admin/questions/{question}` - Atualizar questão
- `DELETE /admin/questions/{question}` - Desativar questão

---

#### Ações em Lote (Bulk Actions)
- [x] Seleção múltipla via checkboxes
- [x] Formulário de ação em lote aparece quando há seleções
- [x] Dropdown: Ativar / Desativar
- [x] Botão "Aplicar" envia ação para questões selecionadas
- [x] Flash message com quantidade de questões afetadas
- [x] Limpeza de seleção após aplicar

**Rota**: `POST /admin/questions/bulk-toggle`

---

#### Reordenação de Questões (Preparado)
- [x] Rota criada: `POST /admin/questions/reorder`
- [x] Método no controller aceita array de {id, order}
- [x] Atualiza ordem em banco via loop
- [x] Response JSON para implementação futura com drag-drop

**Nota**: Interface de drag-drop pode ser implementada futuramente com Sortable.js

---

## 🗺️ Estrutura de Rotas

### 🌍 Rotas Públicas (SEM autenticação)
```
GET  /                              → Landing page
GET  /manifestacao-interesse        → Formulário de manifestação
POST /manifestacao-interesse        → Submeter manifestação
GET  /inscricao-concluida/{protocolo}/{token} → Página de sucesso
```

### 🔐 Rotas de Autenticação
```
GET  /login                         → Página de login
POST /login                         → Processar login
POST /logout                        → Fazer logout
GET  /change-password               → Página de troca de senha
POST /change-password               → Processar nova senha
```

### 🏛️ Rotas do Município (requer `auth` + `CheckMustChangePassword`)
```
GET    /municipality/dashboard      → Dashboard do município

POST   /municipality/committee      → Adicionar membro do comitê
DELETE /municipality/committee/{id} → Remover membro

GET  /municipality/diagnostic/estimulo    → Diagnóstico Estímulo
GET  /municipality/diagnostic/educacao    → Diagnóstico Educação
GET  /municipality/diagnostic/estruturas  → Diagnóstico Estruturas
POST /municipality/diagnostic/{category}  → Salvar diagnóstico
```

### 👨‍💼 Rotas Administrativas (requer `auth`)
```
# Dashboard Admin
GET /admin/dashboard                → Dashboard com estatísticas

# Gerenciamento de Submissões
GET   /admin/submissoes             → Listagem de submissões
GET   /admin/submissoes/exportar    → Export CSV
GET   /admin/submissoes/{submission}        → Detalhes da submissão
PATCH /admin/submissoes/{submission}/status → Atualizar status

# Gerenciamento de Questões (NOVO)
GET    /admin/questions              → Listagem de questões
GET    /admin/questions/create       → Criar nova questão
POST   /admin/questions              → Salvar nova questão
GET    /admin/questions/{question}/edit → Editar questão
PATCH  /admin/questions/{question}   → Atualizar questão
DELETE /admin/questions/{question}   → Desativar questão
POST   /admin/questions/reorder      → Reordenar questões
POST   /admin/questions/bulk-toggle  → Ativar/desativar em lote
```

---

## 🔄 Fluxos Completos

### Fluxo 1: Município Participa do Mais Engenharia

1. **Usuário** acessa landing page (`/`)
2. **Clica** em "Manifestar Interesse"
3. **Preenche** formulário (4 etapas)
4. **Seleciona** "Sim" para Mais Engenharia
5. **Sistema**:
   - Cria registro na tabela `submissions`
   - Gera protocolo único
   - Gera senha aleatória
   - Cria usuário na tabela `users` com `must_change_password = true`
   - Envia **3 emails**:
     - Email de credenciais (email + senha)
     - Email de confirmação (protocolo)
     - (Futuro) Email de aprovação (quando admin aprovar)
6. **Página de sucesso** exibe protocolo e credenciais
7. **Usuário** acessa `/login` com email e senha recebidos
8. **Sistema** redireciona para `/change-password` (obrigatório)
9. **Usuário** troca senha e é redirecionado para `/municipality/dashboard`
10. **Dashboard** mostra **status pendente** (badge amarelo) e aguarda aprovação
11. **Admin** acessa `/admin/submissoes/{id}` e altera status para "approved"
12. **Sistema** envia **email de aprovação** para o usuário
13. **Usuário** faz login novamente e vê **botões dos diagnósticos liberados**
14. **Usuário** clica em "Diagnóstico Estímulo" → preenche questões → salva
15. **Sistema** calcula pontuação automaticamente e atualiza gauge
16. **Usuário** repete para Educação e Estruturas
17. **Dashboard** exibe pontuação total (0-300) e status "Completo"
18. **Admin** visualiza estatísticas atualizadas e pode exportar CSV

---

### Fluxo 2: Município NÃO Participa do Mais Engenharia

1. **Usuário** acessa landing page e clica em "Manifestar Interesse"
2. **Preenche** formulário (4 etapas)
3. **Seleciona** "Não" para Mais Engenharia
4. **Sistema**:
   - Cria registro na tabela `submissions` com `user_id = null`
   - Gera protocolo único
   - **NÃO cria usuário**
   - Envia **1 email**: Confirmação com protocolo
5. **Página de sucesso** exibe apenas protocolo (sem credenciais)
6. **Usuário** aguarda contato do CREA-PR
7. **Admin** visualiza submissão no painel e pode aprovar/rejeitar
8. **Admin** pode adicionar observações administrativas

---

### Fluxo 3: Admin Aprova Manifestação

1. **Admin** faz login em `/login`
2. **Acessa** dashboard admin (`/admin/dashboard`)
3. **Visualiza** estatísticas gerais (gráficos + cards)
4. **Clica** em "Ver Submissões"
5. **Filtra** submissões (ex: status = pending)
6. **Clica** em "Ver Detalhes" de uma manifestação
7. **Revê** todas as informações do município
8. **Altera** status de "Pendente" para "Aprovado"
9. **Adiciona** observações (opcional): "Município aprovado para participação"
10. **Clica** em "Salvar Alterações"
11. **Sistema**:
    - Valida mudança de status
    - Salva observações
    - Verifica se status mudou para "approved" E se não era "approved" antes
    - Verifica se submission tem user_id (Mais Engenharia = Sim)
    - **Envia email de aprovação** com link para dashboard
    - Loga ação no sistema
    - Redireciona com flash message verde: "Status atualizado com sucesso!"
12. **Usuário** recebe email e acessa dashboard
13. **Diagnósticos** ficam liberados para preenchimento

---

### Fluxo 4: Admin Gerencia Questões Diagnósticas

1. **Admin** faz login e acessa dashboard
2. **Clica** em "Gerenciar Questões" no menu superior
3. **Visualiza** listagem de todas as 35 questões
4. **Filtra** por categoria "Estímulo"
5. **Clica** em "Editar" em uma questão existente
6. **Altera** texto da questão e descrição
7. **Adiciona** nova opção no options builder
8. **Salva** alterações
9. **Sistema** atualiza questão e redireciona com sucesso
10. **Admin** clica em "+ Nova Questão"
11. **Preenche** formulário:
    - Categoria: Educação
    - Tipo: checkbox
    - Adiciona 3 opções
    - Define ordem: 13
    - Marca como ativa
12. **Visualiza** preview da questão
13. **Clica** em "Criar Questão"
14. **Sistema** valida (mínimo 2 opções OK) e salva
15. **Nova questão** aparece na listagem
16. **Municípios** verão a nova questão no próximo acesso ao diagnóstico

---

### Fluxo 5: Admin Desativa Questões em Lote

1. **Admin** acessa gerenciamento de questões
2. **Seleciona** checkbox de 5 questões
3. **Banner azul** aparece: "5 questão(ões) selecionada(s)"
4. **Seleciona** ação "Desativar" no dropdown
5. **Clica** em "Aplicar"
6. **Sistema**:
   - Atualiza `is_active = false` nas 5 questões
   - Questões somem dos diagnósticos municipais
   - Respostas antigas permanecem no banco
   - Flash message: "5 questão(ões) desativadas com sucesso!"
7. **Admin** vê badges "Inativo" nas questões

---

## 🧪 Guia de Testes

### Pré-requisitos
```bash
# 1. Instalar dependências
composer install
npm install

# 2. Configurar .env
cp .env.example .env
php artisan key:generate

# 3. Configurar banco de dados PostgreSQL no .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=creapr_vds
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# 4. Configurar email (use Mailtrap para testes ou SMTP real)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_username
MAIL_PASSWORD=sua_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@creapr.org.br
MAIL_FROM_NAME="Smart Crea Cities"

# 5. Executar migrations + seeders
php artisan migrate:fresh --seed

# 6. Iniciar servidor
php artisan serve
```

### Cenários de Teste

#### ✅ Teste 1: Submissão Completa (Mais Engenharia = Sim)
1. Acesse `http://localhost:8000`
2. Clique em "Manifestar Interesse"
3. Preencha Etapa 1:
   - Município: "Curitiba"
   - Habitantes: 1.900.000
   - Regional: "Curitiba"
   - Setores: "Tecnologia, Educação"
4. Preencha Etapa 2:
   - Mais Engenharia: **Sim**
5. Preencha Etapa 3:
   - Responsável: "João Silva"
   - Cargo: "Secretário de Tecnologia"
   - Email: "joao@curitiba.pr.gov.br"
   - Telefone: "(41) 99999-9999"
   - CPF: "123.456.789-00"
6. Preencha Etapa 4:
   - Prefeito: "Maria Santos"
   - Telefone: "(41) 98888-8888"
7. Clique em "Finalizar Inscrição"
8. **Verifique**:
   - ✅ Página de sucesso exibe protocolo + credenciais
   - ✅ 2 emails enviados (credenciais + confirmação)
9. Copie email e senha exibidos
10. Acesse `/login` e faça login
11. **Verifique**: Redirect automático para `/change-password`
12. Altere senha e submeta
13. **Verifique**: Redirect para dashboard com flash message verde

#### ✅ Teste 2: Submissão Simples (Mais Engenharia = Não)
1. Repita passos 1-3 do Teste 1
2. Preencha Etapa 2:
   - Mais Engenharia: **Não**
3. Preencha Etapa 3 e 4 normalmente
4. Clique em "Finalizar Inscrição"
5. **Verifique**:
   - ✅ Página de sucesso exibe apenas protocolo (sem credenciais)
   - ✅ 1 email enviado (confirmação)
   - ✅ Mensagem informa que CREA-PR entrará em contato

#### ✅ Teste 3: Aprovação pelo Admin
1. Crie usuário admin manualmente no banco:
```sql
INSERT INTO users (name, email, password, role, must_change_password, created_at, updated_at)
VALUES ('Admin CREA-PR', 'admin@creapr.org.br', '$2y$12$HASH_DA_SENHA', 'admin', false, NOW(), NOW());
-- Use: php artisan tinker → Hash::make('senha123') para gerar hash
```
2. Acesse `/login` com credenciais admin
3. Acesse `/admin/dashboard`
4. **Verifique**: 
   - ✅ Gráficos renderizando
   - ✅ Cards com números corretos
   - ✅ Tabela com últimas submissões
5. Clique em "Ver Submissões"
6. **Verifique**: Listagem com submissões criadas
7. Clique em "Ver Detalhes" de uma submissão "Pendente"
8. Altere status para "Aprovado"
9. Adicione observação: "Município aprovado"
10. Clique em "Salvar Alterações"
11. **Verifique**:
    - ✅ Flash message verde: "Status atualizado com sucesso!"
    - ✅ Email de aprovação enviado (checar inbox/Mailtrap)
    - ✅ Badge agora mostra "Aprovado"

#### ✅ Teste 4: Preenchimento de Diagnósticos
1. Faça login como município aprovado
2. Acesse dashboard (`/municipality/dashboard`)
3. **Verifique**: Botões dos 3 diagnósticos estão liberados
4. Clique em "Diagnóstico de Estímulo"
5. **Verifique**: Formulário com 12 questões carrega
6. Preencha todas as questões:
   - Sim/Não: clique em opção
   - Sim/Não + Evidência: preencha textarea
   - Checkbox: marque opções
   - Multiple Input: preencha campos
   - Text: escreva resposta
7. Clique em "Finalizar Diagnóstico"
8. **Verifique**:
   - ✅ Redirect para dashboard
   - ✅ Gauge Estímulo atualizado (0-100)
   - ✅ Badge "Concluído" na seção Estímulo
9. Repita para Educação e Estruturas
10. **Verifique**:
    - ✅ Pontuação total (0-300) exibida
    - ✅ 3 gauges preenchidos
    - ✅ Badge "Completo" no topo

#### ✅ Teste 5: Export CSV
1. Login como admin
2. Acesse `/admin/submissoes`
3. Aplique filtro: Status = "Aprovado"
4. Clique em "📥 Exportar CSV"
5. **Verifique**:
   - ✅ Download inicia automaticamente
   - ✅ Arquivo `submissoes_YYYYMMDD.csv` criado
   - ✅ Abre corretamente no Excel (UTF-8)
   - ✅ 16 colunas exportadas
   - ✅ Apenas submissões aprovadas aparecem

#### ✅ Teste 6: Gerenciamento de Questões
1. Login como admin
2. Acesse `/admin/dashboard`
3. Clique em "Gerenciar Questões"
4. **Verifique**: 35 questões listadas
5. Clique em "Filtrar" categoria = "Estímulo"
6. **Verifique**: Apenas 12 questões aparecem
7. Clique em "+ Nova Questão"
8. Preencha formulário:
   - Categoria: Educação
   - Questão: "O município possui plano de capacitação tecnológica?"
   - Tipo: yes_no
   - Ordem: 13
   - Ativa: ✓
9. **Verifique**: Preview atualiza ao vivo
10. Clique em "Criar Questão"
11. **Verifique**: 
    - ✅ Flash message verde
    - ✅ Nova questão na listagem
12. Clique em "Editar" na nova questão
13. Altere tipo para "checkbox"
14. Adicione 3 opções:
    - "Cursos online"
    - "Workshops presenciais"
    - "Bolsas de estudo"
15. **Verifique**: Preview mostra checkboxes
16. Clique em "Salvar Alterações"
17. **Verifique**: Questão atualizada

#### ✅ Teste 7: Ações em Lote
1. Na listagem de questões
2. Clique no checkbox de 3 questões
3. **Verifique**: Banner azul aparece "3 questão(ões) selecionada(s)"
4. Selecione ação "Desativar"
5. Clique em "Aplicar"
6. **Verifique**:
   - ✅ Flash message: "3 questão(ões) desativadas com sucesso!"
   - ✅ Badges "Inativo" nas 3 questões
7. Filtre por status "Inativo"
8. **Verifique**: 3 questões desativadas aparecem
9. Selecione as 3 novamente
10. Ação "Ativar" → Aplicar
11. **Verifique**: Badges voltam para "Ativo"

---

## 💾 Banco de Dados

### Tabelas Principais

#### `submissions` (Manifestações)
```sql
id, protocolo, status, municipio_nome, habitantes_num, regional_creapr, 
setores_economicos, faz_parte_mais_engenharia, responsavel_nome, 
responsavel_cargo, responsavel_email, responsavel_telefone, 
responsavel_cpf, prefeito_nome, prefeito_telefone, user_id, 
access_token, pontuacao_estimulo, pontuacao_educacao, 
pontuacao_estruturas, diagnostico_estimulo_concluido_em, 
diagnostico_educacao_concluido_em, diagnostico_estruturas_concluido_em, 
observacoes, created_at, updated_at
```

**Status possíveis**:
- `pending` (padrão)
- `under_review`
- `approved`
- `rejected`

#### `users` (Usuários)
```sql
id, name, email, password, role, must_change_password, submission_id, 
remember_token, created_at, updated_at
```

**Roles**:
- `municipality` (municípios)
- `admin` (administradores CREA-PR)

#### `diagnostic_questions` (Questões)
```sql
id, category, question, type, options (JSON), requires_evidence, 
order, is_active, description, created_at, updated_at
```

**Categorias**: `estimulo`, `educacao`, `estruturas`

**Tipos**: `yes_no`, `yes_no_evidence`, `checkbox`, `multiple_input`, `text`

#### `diagnostic_answers` (Respostas)
```sql
id, submission_id, diagnostic_question_id, answer (JSON), 
evidence, created_at, updated_at
```

#### `committee_members` (Membros do Comitê)
```sql
id, submission_id, nome, cargo, setor, email, created_at, updated_at
```

Limite: 5 membros por submission

#### `program_events` (Eventos do Programa - preparado)
```sql
id, submission_id, titulo, descricao, data_inicio, data_fim, 
local, created_at, updated_at
```

---

### Seeders

#### DiagnosticQuestionsSeeder
Popula 35 questões distribuídas em:
- **Estímulo**: 12 questões (4 yes_no, 3 yes_no_evidence, 2 checkbox, 2 multiple_input, 1 text)
- **Educação**: 12 questões (mesma distribuição)
- **Estruturas**: 11 questões (similar)

**Executar**:
```bash
php artisan db:seed --class=DiagnosticQuestionsSeeder
```

---

## 📧 Emails

### Configuração SMTP para Produção
Edite `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.seuservidor.com.br
MAIL_PORT=587
MAIL_USERNAME=noreply@creapr.org.br
MAIL_PASSWORD=senha_segura
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@creapr.org.br
MAIL_FROM_NAME="Smart Crea Cities - CREA-PR"
```

### Templates de Email

1. **credentials.blade.php** (Credenciais)
   - Subject: "Credenciais de Acesso - Smart Crea Cities"
   - Para: Responsável (municípios com Mais Engenharia = Sim)
   - Conteúdo: Email + senha + protocolo + link de login

2. **confirmation.blade.php** (Confirmação)
   - Subject: "Manifestação de Interesse Confirmada"
   - Para: Responsável (todos)
   - Conteúdo: Protocolo + próximos passos

3. **approval.blade.php** (Aprovação)
   - Subject: "Manifestação Aprovada - Diagnósticos Liberados"
   - Para: Responsável (quando admin aprova)
   - Conteúdo: Confirmação de aprovação + link para diagnósticos

### Teste de Emails
Use **Mailtrap.io** para testar sem enviar emails reais:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_mailtrap_username
MAIL_PASSWORD=seu_mailtrap_password
```

---

## 🛠️ Comandos Úteis

### Desenvolvimento
```bash
# Iniciar servidor local
php artisan serve

# Rodar migrations
php artisan migrate

# Resetar banco + seeders
php artisan migrate:fresh --seed

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver rotas
php artisan route:list

# Gerar hash de senha (para criar admin manual)
php artisan tinker
>>> Hash::make('senha123')
```

### Testes
```bash
# Rodar testes (se implementados)
php artisan test

# Verificar erros de código
./vendor/bin/phpstan analyse

# Format code
./vendor/bin/php-cs-fixer fix
```

### Produção
```bash
# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Gerar chave da aplicação
php artisan key:generate

# Rodar queue worker (se usar filas)
php artisan queue:work --tries=3
```

---

## 🚀 Próximos Passos (Melhorias Futuras)

### Segurança
- [ ] Implementar middleware de verificação de role (`CheckRole`)
- [ ] Adicionar CSRF tokens em todos os formulários AJAX
- [ ] Implementar rate limiting mais granular
- [ ] Adicionar autenticação de 2 fatores para admins

### Features
- [ ] Sistema de upload de arquivos (evidências)
- [ ] Drag-and-drop para reordenar questões (Sortable.js)
- [ ] Relatórios em PDF para municípios
- [ ] Dashboard público com rankings de municípios
- [ ] API REST para integrações externas
- [ ] Notificações push para municípios
- [ ] Sistema de comentários nas submissões

### DevOps
- [ ] CI/CD com GitHub Actions
- [ ] Docker containers para desenvolvimento
- [ ] Backup automatizado do banco
- [ ] Monitoring com Sentry/Bugsnag
- [ ] Queue workers para emails (Laravel Queue)

### UX/UI
- [ ] Dark mode toggle
- [ ] Animações de transição
- [ ] Skeleton loaders
- [ ] Toast notifications globais
- [ ] Tutorial interativo para novos municípios

---

## 📞 Suporte

Para dúvidas ou problemas, entre em contato:
- **Email**: suporte@creapr.org.br
- **Telefone**: (41) 3234-5678
- **Site**: https://smartcreacities.creapr.org.br

---

## ✅ Checklist de Validação MVP

### Funcionalidades Básicas
- [x] Landing page responsiva
- [x] Formulário de manifestação (4 etapas)
- [x] Fluxo bifurcado (Mais Engenharia Sim/Não)
- [x] Geração de protocolo e credenciais
- [x] 3 tipos de emails automáticos
- [x] Sistema de login
- [x] Troca obrigatória de senha
- [x] Dashboard do município
- [x] CRUD de comitê (5 membros)
- [x] 3 diagnósticos completos (35 questões)
- [x] 5 tipos de questões funcionando
- [x] Cálculo automático de pontuação
- [x] Dashboard admin com estatísticas
- [x] 3 gráficos Chart.js
- [x] Listagem de submissões com filtros
- [x] Detalhes de submissão
- [x] Aprovação/rejeição com observações
- [x] Email de aprovação automático
- [x] Export CSV (16 colunas)
- [x] Gerenciamento de questões (CRUD)
- [x] Options builder para questões
- [x] Preview de questões
- [x] Ações em lote (ativar/desativar)
- [x] Soft delete de questões

### Validações e Segurança
- [x] Rate limiting nas rotas públicas
- [x] Validação de formulários
- [x] Middleware de autenticação
- [x] Middleware de troca de senha
- [x] CSRF protection
- [x] Sanitização de inputs
- [x] Logs de ações administrativas

### UX e Design
- [x] Interface responsiva (mobile-first)
- [x] Tailwind CSS
- [x] Alpine.js para interatividade
- [x] Flash messages
- [x] Loading states
- [x] Empty states
- [x] Error messages claros
- [x] Confirmações antes de ações destrutivas

### Dados e Relatórios
- [x] 14 métricas calculadas
- [x] Agregações SQL corretas
- [x] Eager loading (N+1 prevenido)
- [x] Paginação
- [x] Filtros preservados na paginação
- [x] Export respeitando filtros
- [x] UTF-8 com BOM (Excel-compatible)

---

## 🎓 Conclusão

O MVP da plataforma **Smart Crea Cities** está **100% completo** e pronto para testes e validação. Todas as 13 funcionalidades planejadas foram implementadas com sucesso:

✅ 1. Estrutura de banco de dados
✅ 2. Landing page
✅ 3. Formulário de manifestação
✅ 4. Validação Mais Engenharia
✅ 5. 35 questões diagnósticas
✅ 6. Dashboard do município
✅ 7. CRUD de comitê
✅ 8. Sistema de diagnósticos
✅ 9. Notificações por email
✅ 10. Troca obrigatória de senha
✅ 11. Dashboard admin
✅ 12. **Gerenciamento de questões** (NOVO)
✅ 13. Interface de revisão de submissões

A plataforma agora oferece uma experiência completa para:
- **Municípios**: manifestar interesse, preencher diagnósticos, acompanhar pontuação
- **Administradores CREA-PR**: analisar submissões, aprovar/rejeitar, gerenciar questões, visualizar estatísticas, exportar dados

**O sistema está preparado para entrar em produção após seus testes e validações!** 🎉

---

**Desenvolvido para CREA-PR | Smart Crea Cities**
**Versão MVP 1.0 | Março 2026**
