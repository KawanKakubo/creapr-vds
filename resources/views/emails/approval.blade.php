<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifestação Aprovada - Smart Crea Cities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #16a34a;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #16a34a;
        }
        .success-badge {
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(22, 163, 74, 0.3);
        }
        .success-badge h1 {
            color: white;
            font-size: 28px;
            margin: 0 0 10px 0;
        }
        .success-badge p {
            margin: 5px 0;
            font-size: 16px;
        }
        .diagnostic-cards {
            display: grid;
            gap: 15px;
            margin: 25px 0;
        }
        .diagnostic-card {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 15px;
            border-radius: 6px;
        }
        .diagnostic-card.estimulo {
            border-left-color: #2563eb;
        }
        .diagnostic-card.educacao {
            border-left-color: #16a34a;
        }
        .diagnostic-card.estruturas {
            border-left-color: #9333ea;
        }
        .diagnostic-card h3 {
            margin: 0 0 8px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        .diagnostic-card .icon {
            font-size: 20px;
            margin-right: 8px;
        }
        .diagnostic-card p {
            margin: 0;
            font-size: 13px;
            color: #64748b;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
            font-size: 16px;
        }
        .button:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
        }
        .info-box {
            background-color: #eff6ff;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .info-box h2 {
            color: #2563eb;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .checklist {
            list-style: none;
            padding: 0;
        }
        .checklist li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
        }
        .checklist li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #16a34a;
            font-weight: bold;
            font-size: 18px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Smart Crea Cities</div>
            <p style="color: #64748b; margin: 5px 0 0 0;">CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná</p>
        </div>

        <div class="success-badge">
            <h1>🎉 Parabéns!</h1>
            <p><strong>Sua manifestação foi aprovada!</strong></p>
            <p style="font-size: 14px; margin-top: 10px;">Município: {{ $submission->municipio_nome }}</p>
            <p style="font-size: 14px;">Protocolo: {{ $submission->protocolo }}</p>
        </div>

        <p>Olá,</p>
        
        <p>É com grande satisfação que informamos que a manifestação de interesse do município <strong>{{ $submission->municipio_nome }}</strong> foi <strong style="color: #16a34a;">APROVADA</strong> pelo CREA-PR!</p>

        <p>Agora você tem acesso liberado para realizar os diagnósticos de maturidade nos <strong>3 E's</strong>:</p>

        <div class="diagnostic-cards">
            <div class="diagnostic-card estimulo">
                <h3><span class="icon">⚡</span> Estímulo</h3>
                <p>Avalie o ecossistema de inovação e empreendedorismo do município</p>
            </div>
            
            <div class="diagnostic-card educacao">
                <h3><span class="icon">🎓</span> Educação</h3>
                <p>Analise a infraestrutura educacional e capacitação tecnológica</p>
            </div>
            
            <div class="diagnostic-card estruturas">
                <h3><span class="icon">🏛️</span> Estruturas</h3>
                <p>Mapeie a infraestrutura tecnológica e serviços digitais</p>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ url('/municipality/dashboard') }}" class="button">Acessar Dashboard →</a>
        </div>

        <div class="info-box">
            <h2>📝 Próximos Passos</h2>
            <ul class="checklist">
                <li>Acesse o dashboard da plataforma</li>
                <li>Complete o cadastro do Comitê Smart Crea (até 5 membros)</li>
                <li>Realize os diagnósticos dos 3 E's</li>
                <li>Acompanhe sua pontuação em tempo real</li>
                <li>Receba recomendações personalizadas</li>
            </ul>
        </div>

        <p><strong>Importante:</strong> Os diagnósticos podem ser realizados de forma gradual. Você pode salvar o progresso e continuar depois.</p>

        <p>Cada diagnóstico possui um conjunto de perguntas que ajudarão a identificar o nível de maturidade tecnológica do município e apontarão oportunidades de desenvolvimento.</p>

        <p>Em caso de dúvidas durante o preenchimento, entre em contato com nossa equipe técnica.</p>

        <p style="margin-top: 25px;"><strong>Sucesso na jornada rumo a uma cidade mais inteligente e conectada!</strong></p>

        <div class="footer">
            <p><strong>CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná</strong></p>
            <p>Smart Crea Cities - Programa de Maturidade Tecnológica Municipal</p>
            <p style="margin-top: 10px;">Este é um e-mail automático. Por favor, não responda.</p>
        </div>
    </div>
</body>
</html>
