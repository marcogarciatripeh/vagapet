/**
 * Máscara de telefone brasileiro
 * Aplica automaticamente a máscara (11) 99999-9999 ou (11) 9999-9999
 */

document.addEventListener('DOMContentLoaded', function() {
    // Função para aplicar máscara de telefone
    function applyPhoneMask(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito

            if (value.length <= 11) {
                // Aplica a máscara (11) 99999-9999 ou (11) 9999-9999
                if (value.length <= 2) {
                    value = value;
                } else if (value.length <= 6) {
                    value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
                } else if (value.length <= 10) {
                    value = `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
                } else {
                    value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
                }

                e.target.value = value;
            }
        });

        // Validação do formato
        input.addEventListener('blur', function(e) {
            const value = e.target.value.replace(/\D/g, '');
            if (value.length > 0 && value.length < 10) {
                e.target.setCustomValidity('Digite um número de telefone válido');
            } else {
                e.target.setCustomValidity('');
            }
        });
    }

    // Aplicar máscara em todos os campos de telefone
    const phoneInputs = document.querySelectorAll('input[name="phone"], input[name="whatsapp"], input[id="phone"], input[id="whatsapp"]');
    phoneInputs.forEach(applyPhoneMask);

    // Aplicar máscara em campos que são adicionados dinamicamente
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Element node
                    const newPhoneInputs = node.querySelectorAll ?
                        node.querySelectorAll('input[name="phone"], input[name="whatsapp"], input[id="phone"], input[id="whatsapp"]') :
                        [];
                    newPhoneInputs.forEach(applyPhoneMask);
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});
