#!/bin/bash

# Script para diagnosticar e corrigir erro 403 no storage

SSH_USER="edua2934"
SSH_HOST="50.6.138.140"
HOME_PATH="/home2/edua2934"
REPO_PATH="$HOME_PATH/repositories/vagapet"
PUBLIC_PATH="$HOME_PATH/vagapet.com.br"
SSH_KEY="$(dirname "$0")/_archive/ssh/id_rsa"
SSH_PASSWORD="PaNeL@VagaPet&2025*"

# Configurar SSH
if command -v sshpass >/dev/null 2>&1; then
    SSH_CMD="sshpass -p '$SSH_PASSWORD' ssh"
    SSH_OPTIONS="-o StrictHostKeyChecking=no -o ConnectTimeout=10"
else
    SSH_CMD="ssh -i $SSH_KEY"
    SSH_OPTIONS="-o StrictHostKeyChecking=no -o ConnectTimeout=10 -o IdentitiesOnly=yes"
fi

echo "=== Diagnosticando Problema 403 no Storage ==="
echo ""

echo "1. Verificando estrutura de diretórios..."
$SSH_CMD $SSH_OPTIONS "$SSH_USER@$SSH_HOST" "cd $REPO_PATH && echo 'Repositório:' && pwd && echo '' && echo 'Storage existe:' && (test -d storage/app/public && echo 'SIM' || echo 'NÃO') && echo '' && echo 'Link no repositório:' && (test -L public/storage && echo 'SIM - aponta para:' && readlink public/storage || echo 'NÃO')"

echo ""
echo "2. Verificando diretório público..."
$SSH_CMD $SSH_OPTIONS "$SSH_USER@$SSH_HOST" "if [ -d $PUBLIC_PATH ]; then echo 'Diretório público existe: SIM'; echo ''; if [ -L $PUBLIC_PATH/storage ]; then echo 'Link storage existe: SIM'; echo 'Link aponta para:' && readlink $PUBLIC_PATH/storage && echo '' && echo 'Link funciona:' && (test -e $PUBLIC_PATH/storage && echo 'SIM' || echo 'NÃO') && echo '' && echo 'Detalhes do link:'; ls -la $PUBLIC_PATH/storage | head -1; else echo 'Link storage existe: NÃO'; fi; else echo 'Diretório público não encontrado!'; fi"

echo ""
echo "3. Verificando permissões..."
$SSH_CMD $SSH_OPTIONS "$SSH_USER@$SSH_HOST" "cd $REPO_PATH && echo 'Permissões do storage:' && ls -ld storage/app/public 2>/dev/null || echo 'Diretório não encontrado' && echo '' && echo 'Permissões de um arquivo de exemplo:' && (find storage/app/public -type f 2>/dev/null | head -1 | xargs ls -l 2>/dev/null || echo 'Nenhum arquivo encontrado')"

echo ""
echo "4. Corrigindo problemas..."
$SSH_CMD $SSH_OPTIONS "$SSH_USER@$SSH_HOST" "cd $REPO_PATH && \
echo 'Criando diretórios...' && \
mkdir -p storage/app/public/professionals/photos storage/app/public/companies/logos storage/app/public/companies/photos && \
echo 'Ajustando permissões...' && \
chmod -R 775 storage/app/public && \
find storage/app/public -type f -exec chmod 664 {} \; 2>/dev/null && \
find storage/app/public -type d -exec chmod 775 {} \; 2>/dev/null && \
echo 'Criando link no repositório...' && \
rm -f public/storage && \
php artisan storage:link && \
if [ -d $PUBLIC_PATH ]; then \
    echo 'Criando link no diretório público...' && \
    rm -rf $PUBLIC_PATH/storage && \
    ln -sfn $REPO_PATH/storage/app/public $PUBLIC_PATH/storage && \
    chmod 755 $PUBLIC_PATH/storage && \
    echo '✓ Link criado em $PUBLIC_PATH/storage'; \
fi && \
chown -R $SSH_USER:$SSH_USER storage 2>/dev/null && \
echo '✓ Correções aplicadas'"

echo ""
echo "5. Verificando resultado..."
$SSH_CMD $SSH_OPTIONS "$SSH_USER@$SSH_HOST" "if [ -L $PUBLIC_PATH/storage ]; then \
    echo '✓ Link simbólico existe'; \
    TARGET=\$(readlink $PUBLIC_PATH/storage); \
    echo '  Aponta para:' \$TARGET; \
    if [ -e \"\$TARGET\" ]; then \
        echo '  ✓ Link funciona (destino existe)'; \
        echo '  Permissões:' \$(ls -ld \"\$TARGET\" | awk '{print \$1, \$3, \$4}'); \
    else \
        echo '  ✗ Link quebrado (destino não existe)'; \
    fi; \
else \
    echo '✗ Link simbólico não existe'; \
fi"

echo ""
echo "=== Diagnóstico Concluído ==="
echo ""
echo "Se ainda der 403, verifique:"
echo "1. Se o Apache tem FollowSymLinks habilitado"
echo "2. Se o usuário do Apache tem permissão para acessar o storage"
echo "3. Se há algum .htaccess bloqueando acesso ao storage"

