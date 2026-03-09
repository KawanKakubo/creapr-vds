<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Smart Crea Cities</title>
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
            border-bottom: 3px solid #2563eb;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }
        h1 {
            color: #2563eb;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .credentials-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .credentials-box p {
            margin: 10px 0;
            font-size: 14px;
        }
        .credentials-box strong {
            display: inline-block;
            width: 100px;
            color: #2563eb;
        }
        .credential-value {
            background-color: #ffffff;
            padding: 8px 12px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            display: inline-block;
            border: 1px solid #e2e8f0;
        }
        .steps {
            background-color: #eff6ff;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .steps h2 {
            color: #2563eb;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .step-number {
            background-color: #2563eb;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .step-text {
            flex: 1;
            padding-top: 4px;
        }
        .button {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #1d4ed8;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
        .warning {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Smart Crea Cities</div>
            <p style="color: #64748b; margin: 5px 0 0 0;">CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná</p>
        </div>

        <h1>🎉 Bem-vindo ao Smart Crea Cities!</h1>
        
        <p>Olá,</p>
        
        <p>A manifestação de interesse do município <strong>{{ $municipioNome }}</strong> foi registrada com sucesso!</p>
        
        <p>Como seu município faz parte do programa <strong>Mais Engenharia</strong>, criamos seu acesso à plataforma Smart Crea Cities.</p>

        <div class="credentials-box">
            <p style="font-weight: bold; margin-bottom: 15px; color: #2563eb;">📋 PROTOCOLO E CREDENCIAIS DE ACESSO</p>
            <p><strong>Protocolo:</strong> <span class="credential-value">{{ $protocol }}</span></p>
            <p><strong>E-mail:</strong> <span class="credential-value">{{ $user->email }}</span></p>
            <p><strong>Senha:</strong> <span class="credential-value">{{ $temporaryPassword }}</span></p>
        </div>

        <div class="warning">
            ⚠️ <strong>Importante:</strong> Esta é uma senha temporária. Você será solicitado a alterá-la no primeiro acesso por motivos de segurança.
        </div>

        <div style="text-align: center;">
            <a href="{{ url('/login') }}" class="button">Acessar Plataforma</a>
        </div>

        <div class="steps">
            <h2>📝 Próximos Passos</h2>
            
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-text">
                    <strong>Faça seu primeiro acesso</strong><br>
                    Use as credenciais acima para entrar na plataforma e altere sua senha.
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-text">
                    <strong>Aguarde a aprovação do CREA-PR</strong><br>
                    Nossa equipe irá analisar sua manifestação e aprovar o acesso aos diagnósticos.
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">
                    <strong>Forme o Comitê Smart Crea</strong><br>
                    Cadastre até 5 membros representantes de diferentes áreas do município.
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-text">
                    <strong>Realize os diagnósticos</strong><br>
                    Responda aos questionários dos 3 E's: Estímulo, Educação e Estruturas.
                </div>
            </div>
        </div>

        <p>Em caso de dúvidas, entre em contato com o CREA-PR através dos nossos canais oficiais.</p>

        <div class="footer">
            <p><strong>CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná</strong></p>
            <p>Smart Crea Cities - Programa de Maturidade Tecnológica Municipal</p>
            <p style="margin-top: 10px;">Este é um e-mail automático. Por favor, não responda.</p>
        </div>
    </div>
</body>
</html>
