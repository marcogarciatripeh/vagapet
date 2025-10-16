# 🔐 Configuração do Login Social

## 📋 Variáveis de Ambiente Necessárias

Adicione as seguintes variáveis ao seu arquivo `.env`:

```bash
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://vagapet.local/auth/google/callback

# Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_app_id_here
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret_here
FACEBOOK_REDIRECT_URI=http://vagapet.local/auth/facebook/callback

# Apple OAuth
APPLE_CLIENT_ID=your_apple_client_id_here
APPLE_CLIENT_SECRET=your_apple_client_secret_here
APPLE_REDIRECT_URI=http://vagapet.local/auth/apple/callback
```

## 🛠️ Como Configurar

### Google OAuth
1. Acesse [Google Cloud Console](https://console.cloud.google.com/)
2. Crie um novo projeto ou selecione um existente
3. Ative a API do Google+
4. Crie credenciais OAuth 2.0
5. Adicione `http://vagapet.local/auth/google/callback` como URI de redirecionamento
6. Copie o Client ID e Client Secret para o `.env`

### Facebook OAuth
1. Acesse [Facebook Developers](https://developers.facebook.com/)
2. Crie um novo aplicativo
3. Adicione o produto "Facebook Login"
4. Configure as URLs de redirecionamento OAuth
5. Adicione `http://vagapet.local/auth/facebook/callback`
6. Copie o App ID e App Secret para o `.env`

### Apple OAuth
1. Acesse [Apple Developer Portal](https://developer.apple.com/)
2. Crie um novo App ID
3. Configure o Sign in with Apple
4. Crie um Service ID
5. Configure as URLs de redirecionamento
6. Adicione `http://vagapet.local/auth/apple/callback`
7. Copie o Client ID e Client Secret para o `.env`

## ✅ Funcionalidades Implementadas

- ✅ Login com Google
- ✅ Login com Facebook  
- ✅ Login com Apple
- ✅ Criação automática de usuário
- ✅ Redirecionamento baseado no perfil
- ✅ Integração com onboarding existente
- ✅ Máscara de telefone brasileira
- ✅ Validação de formato de telefone

## 🎯 Fluxo de Funcionamento

1. **Usuário clica no botão social**
2. **Redirecionamento para o provedor**
3. **Autorização do usuário**
4. **Callback com dados do usuário**
5. **Verificação se usuário existe**
6. **Login ou criação de nova conta**
7. **Redirecionamento para dashboard ou onboarding**

## 📱 Máscara de Telefone

A máscara de telefone está implementada globalmente e funciona em:
- Campo WhatsApp no cadastro
- Campo telefone no perfil profissional
- Campo telefone no perfil da empresa
- Qualquer campo com `name="phone"` ou `name="whatsapp"`

**Formatos suportados:**
- `(11) 9999-9999` (telefone fixo)
- `(11) 99999-9999` (celular)

## 🚀 Próximos Passos

1. Configure as credenciais OAuth nos provedores
2. Adicione as variáveis ao arquivo `.env`
3. Teste o login social
4. Configure URLs de produção quando necessário
