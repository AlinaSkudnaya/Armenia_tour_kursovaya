(function () {
    const header = document.querySelector('.header');
    window.onscroll = () => {
        if (window.pageYOffset > 50) {
            header.classList.add('header_active');
        } else {
            header.classList.remove('header_active');
        }
    };
}());





// Плавный скрол
(function () {

    const smoothScroll = function (targetEl, duration) // главная функция
    {
        const headerElHeight =  document.querySelector('.header').clientHeight;
        let target = document.querySelector(targetEl);
        let targetPosition = target.getBoundingClientRect().top - headerElHeight;
        let startPosition = window.pageYOffset;
        let startTime = null;
    
        //как будет анимироваться скрол
        const ease = function(t,b,c,d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        };
    

        //функция анимации
        const animation = function(currentTime){
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = ease(timeElapsed, startPosition, targetPosition, duration);
            window.scrollTo(0,run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        };
        requestAnimationFrame(animation);

    };

   // обработчик события на ссылки
    const scrollTo = function () {
        const links = document.querySelectorAll('.js-scroll');
        links.forEach(each => {
            each.addEventListener('click', function () {
                const currentTarget = this.getAttribute('href');
                smoothScroll(currentTarget, 1000);
            });
        });
    };
    scrollTo();
}());

document.addEventListener('DOMContentLoaded',function(){

    const form = document.getElementById('form');
    form.addEventListener('submit',formSend)

    async function formSend(e){
        e.preventDefault();
        let error = formvalidate(form);

        let formdata = new formdata(form);

        if (error===0){
            let response = await fetch('sendmail.php',{
                method: 'POST',
                body: formdata
            });

            if(response.ok){
                let result = await response.json();
                alert(result.message);
                document.getElementById('form').reset();
            }else{
                alert('error');
            }
        }else {
            alert('fill');
        }
    }

    function  formvalidate(form){
        let error =0;
        let formReq = document.querySelector('._req');

        for(index = 0; index<formReq.length; index++){
            const element = formReq[index];
            formRemoveError(input);

            if(input.classList.contains('_email')){
                if (emailTest(input)){
                    formAddError(input);
                    error++;
                }
            } else {
                if (input.value===''){
                    formAddError(input);
                    error++;
                }
            }

        }
    }

    function formAddError(input){
        input.parenElement.classList.add('_error');
        input.classList.add('_error');
    }

    function formRemoveError(input){
        input.parenElement.classList.remove('_error');
        input.classList.rem('_error');
    }

    function emailTest(input){
        return !/^\w+([\.-]?w+)*@\w+([\.-]?w+)*(\.\w{2.8})+$/.test(input.value);
    }

});