// Função para alterar o título da página

// Função de sair da página e falar para voltar // 
function changeTitle(title) {
    document.title = title;
  }
  
  // Armazena o título original da página
  var originalTitle = document.title;
  
  // Adiciona um ouvinte para o evento "blur" na janela
  window.addEventListener('blur', function() {
    changeTitle('Volte aqui  ;('); // Altera o título quando a janela perde o foco
  });
  
  // Adiciona um ouvinte para o evento "focus" na janela
  window.addEventListener('focus', function() {
    changeTitle(originalTitle); // Restaura o título original quando a janela recupera o foco
  });
  
  // Adiciona um ouvinte para o evento "beforeunload" na janela
  window.addEventListener('beforeunload', function() {
    changeTitle('| Carregando |'); // Altera o título antes de sair
    return null;
  });
  
// Função de sair da página e falar para voltar // 