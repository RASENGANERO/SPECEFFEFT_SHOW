// Получаем элементы
function check_errors() {
    jQuery("#modal-order").validate({
        onfocusout: false,
        rules: {
            username: {
                minlength: 2,
            },
            phone: {
                minlength: 18,
                maxlength: 18,
            },
        },
        messages: {
            username: {
                minlength: "Имя не состоит из 1 буквы",
            },
            phone: {
                minlength: "Номер некорректен",
                maxlength: "Номер некорректен",
            },
        },
        
    });
    let validator = jQuery("#modal-order").valid();
    return validator;

}

function send_order(event){

    event.preventDefault(); // Предотвращаем отправку формы для демонстрации

    if (check_errors() != false) {
        let dt = {
            'name':document.getElementById('username').value,
            'phone':document.getElementById('phone').value,
        };
        jQuery.ajax({
			url:'/wp-content/themes/blocksy/order/orderHandler.php',
			type: 'POST',
			data: dt,
			dataType: 'json',
			async: true,
			success: function(response) {
                document.getElementById('result-order').setAttribute('class','result-order-active');
                document.getElementById('result-order').textContent = response['result'];
                setInterval(function(){
                    window.location.reload();
                }, 1200);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error('Ошибка:', textStatus, errorThrown);
			}
		});
    }
    
}
function clear_input(event){
    let clear = event.target;
    if(clear.hasAttribute('class')){
        if(clear.getAttribute('class') == 'error') {
            clear.removeAttribute('class');
            clear.removeAttribute('aria-invalid');
            let s = clear.getAttribute('id');
            document.getElementById(s+'-error').remove();    
        }
    }
}
document.addEventListener('DOMContentLoaded',()=>{
    if(document.getElementById("modal")!=null) {
        let modal = document.getElementById("modal");
        let btn = document.getElementById("send-order");
        let span = document.getElementById("closeModal");

        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        document.getElementById("modal-order").addEventListener('submit',send_order);


        let inputUsername = document.getElementById('username');
        let inputPhone = document.getElementById('phone');
        inputUsername.addEventListener('input',clear_input);
        inputPhone.addEventListener('input',clear_input);

        jQuery.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]";
        jQuery(".phone").mask('+7 (h99) 999-99-99');
        
        inputUsername.addEventListener('click',clear_input);
        inputPhone.addEventListener('click',clear_input);
        
    }
});