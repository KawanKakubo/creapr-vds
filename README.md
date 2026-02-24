# 🏙️ Smart Crea Cities 2026 - Sistema de Manifestação de Interesse

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-336791?style=for-the-badge&logo=postgresql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)

**Sistema web completo para gestão de manifestações de interesse de municípios paranaenses no programa Smart Crea Cities**

[Documentação Técnica](README_SISTEMA.md) • [Segurança](SECURITY.md) • [Demonstração](#-demonstração)

</div>

---

## 📋 Sobre o Projeto

Sistema desenvolvido para o **CREA-PR (Conselho Regional de Engenharia e Agronomia do Paraná)** para gerenciar o processo de manifestação de interesse dos municípios paranaenses no programa **"Trilha dos 3E's - Smart Crea Cities 2026"**.

O programa tem como objetivo transformar municípios do Paraná em **Territórios Inteligentes**, promovendo:
- **Estímulo** à cultura de inovação
- **Educação** para o letramento digital
- **Estruturas** de governança e tecnologia

### 🎯 Objetivos do Sistema

O sistema foi desenvolvido para:

1. **Facilitação do Processo**: Digitalizar e simplificar o processo de manifestação de interesse dos municípios
2. **Coleta Estruturada de Dados**: Reunir informações detalhadas sobre:
   - Marco legal e institucional
   - Governança digital
   - Ecossistema de inovação
   - Planejamento estratégico
   - Relevância das engenharias
3. **Gestão Administrativa**: Fornecer painel completo para análise e acompanhamento das submissões
4. **Segurança e Privacidade**: Proteger dados sensíveis dos municípios com múltiplas camadas de segurança
5. **Transparência**: Gerar comprovantes e protocolos únicos para cada manifestação

---

## 👥 Cliente e Contexto

**Cliente:** CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná  
**Setor:** Autarquia Federal - Regulação Profissional  
**Projeto:** Smart Crea Cities 2026  
**Público-Alvo:** 399 municípios do Estado do Paraná  
**Projeto Piloto:** 10 municípios selecionados na primeira fase  

### 🎓 Programa "Trilha dos 3E's"

O programa visa desenvolver competências fundamentais em cidades inteligentes através de:

- **Letramento fundamental** em conceitos de smart cities
- **Capacitação técnica** de gestores públicos
- **Implementação de governança** digital
- **Estímulo ao ecossistema** de inovação local
- **Integração** entre tecnologia, engenharias e gestão pública

---

## ✨ Funcionalidades Principais

### 🌍 Área Pública

#### Landing Page Institucional
- Design moderno e responsivo
- Seções informativas sobre o programa
- Apresentação dos objetivos e etapas
- Call-to-action para manifestação de interesse

#### Formulário de Manifestação
- **8 blocos temáticos** organizados:
  1. Informações do Município
  2. Marco Legal e Institucional (Lei, Fundo, Conselho)
  3. Governança e Estrutura Digital
  4. Contratos e Políticas Públicas
  5. Ecossistema de Inovação
  6. Planejamento Estratégico
  7. Premiações e Reconhecimentos
  8. Ponto Focal (Contato)

- **Validação em tempo real** com feedback visual
- **Campos dinâmicos** que aparecem/desaparecem conforme respostas
- **Máscaras de input** para CNPJ, telefone e população
- **47 regras de validação** diferentes

#### Página de Confirmação
- Geração automática de **protocolo único** (formato: CREA-YYYY-XXXX)
- **Token de segurança** com 64 caracteres para acesso protegido
- Comprovante imprimível com todos os dados
- Instruções sobre próximos passos
- Expiração de 30 dias para o link

---

### 🔐 Área Administrativa

#### Dashboard Executivo
- **Cards estatísticos** com métricas principais:
  - Total de manifestações
  - Municípios com Lei de Inovação
  - Municípios com Fundo de Inovação
- **Tabela de últimas submissões** com informações-chave
- **Design responsivo** com gradientes e animações

#### Gestão de Submissões
- **Listagem paginada** de todas as manifestações
- **Sistema de filtros avançados**:
  - Por município
  - Por presença de Lei de Inovação
  - Por presença de Fundo de Inovação
- **Busca em tempo real**
- **Ordenação** por data de submissão

#### Visualização Detalhada
- **Página dedicada** para cada submissão
- Dados organizados em **blocos visuais** com cores temáticas
- Links para evidências fornecidas
- Informações completas do ponto focal
- Layout otimizado para impressão

#### Exportação de Dados
- **Download em CSV** com todas as submissões
- **Filtros aplicáveis** na exportação
- Formato compatível com Excel e Google Sheets
- Encoding UTF-8 com BOM para caracteres especiais

---

## 🛠️ Stack Tecnológica

### Backend
- **Laravel 11.x** - Framework PHP moderno e robusto
- **PHP 8.2+** - Última versão com tipos e performance otimizada
- **PostgreSQL 15** - Banco de dados relacional confiável
- **Laravel Breeze** - Sistema de autenticação

### Frontend
- **Blade Templates** - Engine de templates do Laravel
- **TailwindCSS 3.x** - Framework CSS utility-first
- **Alpine.js 3.x** - JavaScript reativo e leve
- **Design Responsivo** - Mobile-first approach

### Segurança
- **CSRF Protection** - Tokens em todos os formulários
- **Rate Limiting** - Proteção contra força bruta e DDoS
- **SQL Injection Protection** - Eloquent ORM com prepared statements
- **XSS Protection** - Escape automático e sanitização
- **Security Headers** - CSP, X-Frame-Options, etc.
- **Token-based Access** - Links protegidos com tokens únicos
- **Hash Timing Attack Protection** - hash_equals() para tokens

### DevOps
- **Git** - Controle de versão
- **Composer** - Gerenciamento de dependências PHP
- **NPM** - Gerenciamento de dependências JavaScript

---

## 🚀 Instalação e Configuração

### Pré-requisitos

```bash
PHP >= 8.2
PostgreSQL >= 13
Composer
Node.js e NPM (opcional, para desenvolvimento)
```

### Passo a Passo

1. **Clone o repositório**
```bash
git clone https://github.com/KawanKakubo/creapr-vds.git
cd creapr-vds
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados no `.env`**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=creapr_vds
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. **Execute as migrations**
```bash
php artisan migrate
```

6. **Crie o usuário administrador**
```bash
php artisan db:seed --class=AdminUserSeeder
```

7. **Inicie o servidor**
```bash
php artisan serve
```

8. **Acesse o sistema**
- **Site público:** http://localhost:8000
- **Admin:** http://localhost:8000/admin/dashboard
- **Credenciais:** admin@crea-pr.org.br / admin123

---

## 📊 Estrutura do Banco de Dados

### Tabela Principal: `submissions`

Estrutura completa com 50+ campos organizados em blocos:

```sql
- id, protocolo, access_token, token_expires_at
- municipio_nome, prefeito_nome, prefeito_mandato, habitantes_num
- possui_lei_inovacao, link_lei_inovacao
- possui_fundo_inovacao, cnpj_fundo_inovacao
- possui_conselho_cti, link_portaria_conselho
- possui_normativa_governanca, link_normativa_governanca
- possui_secretaria_cti, orgao_responsavel_cti
- rodou_contrato_solucao_inovadora, link_evidencia_contrato
- possui_politica_sandbox, link_evidencia_sandbox
- possui_politica_living_lab, link_evidencia_living_lab
- possui_estrategia_transformacao_digital, link_evidencia_estrategia
- startups_num, ambientes_inovacao (JSON), hackathons_realizados (JSON)
- possui_planejamento_estrategico, link_evidencia_planejamento
- relevancia_engenharias, relevancia_engenharias_descricao
- ganhou_premio_inovacao, descricao_premio_relevante
- ponto_focal_nome, ponto_focal_cargo, ponto_focal_email
- ponto_focal_telefone, ponto_focal_celular
- declaracao_interesse
- created_at, updated_at
```

### Índices e Performance
- Índice único em `protocolo`
- Índice único em `access_token`
- Índice em `created_at` para ordenação
- Campos JSON para arrays (ambientes_inovacao, hackathons_realizados)

---

## 🔒 Segurança

O sistema implementa **15 camadas de proteção** diferentes. Principais medidas:

### Proteções Implementadas

✅ **SQL Injection** - Eloquent ORM + Prepared Statements  
✅ **XSS** - Blade Escaping + strip_tags() + CSP  
✅ **CSRF** - Tokens em todos os formulários  
✅ **Rate Limiting** - 5 submissões/hora, 10 acessos/min  
✅ **Mass Assignment** - $fillable definido  
✅ **Timing Attacks** - hash_equals() para tokens  
✅ **Clickjacking** - X-Frame-Options: SAMEORIGIN  
✅ **Information Disclosure** - Logging + Erros genéricos  

### Rate Limits Configurados

| Rota | Limite | Janela |
|------|--------|--------|
| Visualizar formulário | 60 req/min | 1 minuto |
| Submeter formulário | 5 submissões | 1 hora |
| Acessar confirmação | 10 acessos | 1 minuto |
| Tentativas de login | 6 tentativas | 1 minuto |

**Documentação completa:** [SECURITY.md](SECURITY.md)

---

## 📁 Estrutura de Arquivos

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── PublicFormController.php      # Formulário público
│   │   └── Admin/
│   │       └── AdminSubmissionController.php  # Painel admin
│   ├── Requests/
│   │   └── StoreSubmissionRequest.php    # Validações (47 regras)
│   └── Middleware/
│       └── SecurityHeaders.php           # Headers HTTP
├── Models/
│   └── Submission.php                    # Model principal
resources/
└── views/
    ├── home.blade.php                    # Landing page
    ├── layouts/
    │   ├── admin.blade.php
    │   ├── public.blade.php
    │   └── navigation.blade.php
    ├── public/
    │   ├── form.blade.php                # Formulário
    │   └── success.blade.php             # Confirmação
    └── admin/
        ├── dashboard.blade.php
        └── submissions/
            ├── index.blade.php           # Listagem
            └── show.blade.php            # Detalhes
database/
└── migrations/
    ├── 2025_11_12_012342_create_submissions_table.php
    └── 2026_02_24_222625_add_access_token_to_submissions_table.php
routes/
├── web.php                               # Rotas principais
└── auth.php                              # Rotas de autenticação
```

---

## 🎨 Demonstração

### Landing Page
- Design moderno com gradientes azul/verde
- Seções: Hero, Sobre, Objetivos, Etapas, Piloto, CTA
- Totalmente responsiva (mobile-first)
- Animações suaves em scroll

### Formulário Público
- 8 blocos com código de cores
- Validação em tempo real
- Campos condicionais
- Máscaras de input
- Progress visual

### Painel Administrativo
- Cards estatísticos animados
- Tabelas responsivas
- Filtros em tempo real
- Export para CSV
- Design profissional

---

## 📈 Métricas do Projeto

- **Linhas de Código:** ~5.000+ linhas
- **Tempo de Desenvolvimento:** 2 semanas
- **Arquivos Criados:** 30+ arquivos
- **Validações:** 47 regras diferentes
- **Rotas:** 15+ rotas mapeadas
- **Migrations:** 2 migrations
- **Controllers:** 3 controllers principais
- **Views:** 15+ views Blade
- **Modelos:** 2 modelos Eloquent

---

## 🧪 Testes

```bash
# Executar testes
php artisan test

# Com coverage
php artisan test --coverage
```

Testes implementados:
- ✅ Validação de formulários
- ✅ Geração de protocolos
- ✅ Autenticação
- ✅ Filtros da listagem

---

## 📝 Documentação Adicional

- **[README_SISTEMA.md](README_SISTEMA.md)** - Documentação técnica completa
- **[SECURITY.md](SECURITY.md)** - Relatório de segurança detalhado

---

## 🤝 Contribuições

Este é um projeto **closed-source** desenvolvido para o CREA-PR. Contribuições não são aceitas publicamente, mas sugestões são bem-vindas.

---

## 👨‍💻 Desenvolvedor

**Desenvolvido por:** Kawan Harshe Kakubo  
**LinkedIn:** kawan-kakubo
**Email:** kawanhrs@gmail.com 
**Portfólio:** https://kawankakubo.github.io/dev-links/

### Skills Demonstradas neste Projeto

- ✅ Laravel 11 (Framework MVC)
- ✅ PHP 8.2 (Paradigma OOP)
- ✅ PostgreSQL (Banco Relacional)
- ✅ TailwindCSS (Design Responsivo)
- ✅ Alpine.js (Interatividade)
- ✅ RESTful APIs
- ✅ Segurança Web (OWASP Top 10)
- ✅ Validação de Dados
- ✅ Autenticação e Autorização
- ✅ Export de Dados (CSV)
- ✅ Design de Sistema
- ✅ UX/UI Design
- ✅ Git & Versionamento

---

## 📄 Licença

Este projeto foi desenvolvido sob contrato para o **CREA-PR**. Todos os direitos pertencem ao cliente.

**Uso do código para portfólio:** Autorizado apenas para demonstração de competências técnicas, sem violação de dados sensíveis ou propriedade intelectual do cliente.

---

## 🙏 Agradecimentos

- **CREA-PR** pela confiança no projeto
- **Comunidade Laravel** pela excelente documentação
- **Taylor Otwell** pelo framework Laravel

---

## 📞 Contato do Cliente

**CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná**  
- Website: [www.crea-pr.org.br](https://www.crea-pr.org.br)
- Programa: Smart Crea Cities 2026
- Localização: Curitiba - PR, Brasil

---

<div align="center">

**Desenvolvido com ❤️ usando Laravel**

![Laravel](https://img.shields.io/badge/Made%20with-Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

</div>
