function CMB() {
    document.getElementById("login").style.display = "none";
    document.getElementById("profile").style.display = "block";
}
function CMB2() {
    document.getElementById("login").style.display = "block";
    document.getElementById("profile").style.display = "none";
}
// Пример стартового JavaScript для отключения отправки форм при наличии недопустимых полей
(function () {
    'use strict'

    // Получите все формы, к которым мы хотим применить пользовательские стили проверки Bootstrap
    var forms = document.querySelectorAll('.needs-validation')

    // Зацикливайтесь на них и предотвращайте отправку
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

async function uniq_username(username, valid) {
    form=new FormData();
    form.append('username', username);
    try {
        const response = await fetch('testusername.php', {
            method: 'POST',
            body: form
        });
        let result = await response.text();
        console.log('Успех:', result);
        a=document.getElementById('yekflyj');
        //controll();
        if (result=='false\r\n') {
            document.getElementById('username')
            a.innerText="Пользователь с таким именем уже существует";
        }
        else{
            a.innerText="";
        }
    } catch (error) {
        console.log('Ошибка:', error);
        a.innerText="ERROR";
    }
}



