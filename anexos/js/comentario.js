function toggleFaq(index) {
    const answer = document.getElementById(`faq-answer-${index}`);
    const questions = document.querySelectorAll('.faq-question');
    const answers = document.querySelectorAll('.faq-answer');
    
    // Cerrar todas las respuestas excepto la actual
    for (let i = 0; i < answers.length; i++) {
        if (i !== index) {
            answers[i].classList.remove('active');
            questions[i].classList.remove('active');
        }
    }
    
    // Toggle la respuesta actual
    answer.classList.toggle('active');
    questions[index].classList.toggle('active');
}


document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.comments-form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const comentario = form.querySelector('#comentario').value;
            const tipo = form.querySelector('#tipo_comentario').value;
            
            if (!comentario.trim() || !tipo) {
                e.preventDefault();
                alert('Por favor completa los campos requeridos');
            }
        });
    }
});