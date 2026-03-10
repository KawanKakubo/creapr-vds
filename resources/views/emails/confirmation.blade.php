<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifestação Registrada - Smart Crea Cities</title>
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
        h1 {
            color: #16a34a;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .protocol-box {
            background-color: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }
        .protocol-label {
            color: #16a34a;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .protocol-value {
            background-color: #ffffff;
            padding: 12px 20px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 18px;
            font-weight: bold;
            color: #16a34a;
            display: inline-block;
            border: 2px solid #16a34a;
            letter-spacing: 1px;
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
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .info-icon {
            color: #2563eb;
            font-size: 20px;
            margin-right: 10px;
            flex-shrink: 0;
        }
        .button {
            display: inline-block;
            background-color: #16a34a;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #15803d;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
        .highlight {
            background-color: #fef9c3;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #eab308;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Smart Crea Cities</div>
            <p style="color: #64748b; margin: 5px 0 0 0;">CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná</p>
        </div>

        <h1>✅ Manifestação Registrada com Sucesso!</h1>
        
        <p>Olá,</p>
        
        <p>A manifestação de interesse do município <strong>{{ $municipioNome }}</strong> foi recebida e registrada com sucesso em nosso sistema.</p>

        <div class="protocol-box">
            <div class="protocol-label">📋 NÚMERO DO PROTOCOLO</div>
            <div class="protocol-value">{{ $protocol }}</div>
        </div>

        <p>Guarde este número de protocolo para futuras consultas e acompanhamento.</p>

        <div class="highlight">
            <strong>🔔 Próximos Passos</strong><br>
            Nossa equipe do CREA-PR entrará em contato em breve para dar continuidade ao processo de integração ao programa Smart Crea Cities.
        </div>

        <div class="info-box">
            <h2>📌 Informações Importantes</h2>
            
            <div class="info-item">
                <span class="info-icon">📧</span>
                <div>
                    <strong>Contato</strong><br>
                    Você receberá informações e orientações por e-mail sobre os próximos passos do programa.
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">📊</span>
                <div>
                    <strong>Avaliação</strong><br>
                    Sua manifestação será analisada pela nossa equipe técnica do CREA-PR.
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">🏙️</span>
                <div>
                    <strong>Programa</strong><br>
                    O Smart Crea Cities visa desenvolver a maturidade tecnológica dos municípios paranaenses.
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">📞</span>
                <div>
                    <strong>Dúvidas</strong><br>
                    Em caso de dúvidas, entre em contato através dos nossos canais oficiais.
                </div>
            </div>
        </div>

        <p style="text-align: center; color: #64748b; font-style: italic;">
            Agradecemos o interesse do município em participar do Smart Crea Cities!
        </p>

        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="button">Voltar ao Site</a>
        </div>

        <div class="footer">
            <p><strong>CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná</strong></p>
            <p>Smart Crea Cities - Trilha Formativa dos 3'Es</p>
            <p style="margin-top: 10px;">Este é um e-mail automático. Por favor, não responda.</p>
        </div>
    </div>
</body>
</html>
