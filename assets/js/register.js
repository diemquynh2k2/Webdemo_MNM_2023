function Validator(options){
    var selectorRules = {};
    var formElement = document.querySelector(options.form);

    if(formElement){

        formElement.onsubmit = function(e){
            e.preventDefault();

            var isValidate = true;

            options.rules.forEach(function(rule){
                var inputElement = formElement.querySelector(rule.selector);
                var errorElement = inputElement.parentElement.querySelector('.form-message');
                var errorMessage;
                var rules = selectorRules[rule.selector];

                    for(var i = 0;i < rules.length; ++i){
                        errorMessage = rules[i](inputElement.value);
                        if(errorMessage){
                            break;
                        }
                    }

                    if(errorMessage){
                        errorElement.innerText = errorMessage;
                        inputElement.parentElement.classList.add('invalid');
                        isValidate=false;
                    }else{
                        errorElement.innerText = "";
                        inputElement.parentElement.classList.remove('invalid');
                    }
            })

            if(isValidate){
                if(typeof options.onSubmit === 'function'){
                    var enableInput = formElement.querySelectorAll('[name]');
                    var formValues = Array.from(enableInput).reduce(function(values , input){
                        values[input.name] = input.value;
                        return values;
                    },{});

                    options.onSubmit(formValues);
                };
            }

        }

        options.rules.forEach(function(rule){

            if(Array.isArray(selectorRules[rule.selector])){
                selectorRules[rule.selector].push(rule.test);
            }else{
                selectorRules[rule.selector] = [rule.test];
            }
            

            var inputElement = formElement.querySelector(rule.selector);
            

            if(inputElement){
                inputElement.onblur = function(){
                
                var errorElement = inputElement.parentElement.querySelector('.form-message');
                var errorMessage;
                var rules = selectorRules[rule.selector];

                    for(var i = 0;i < rules.length; ++i){
                        errorMessage = rules[i](inputElement.value);
                        if(errorMessage){
                            break;
                        }
                    }

                    if(errorMessage){
                        errorElement.innerText = errorMessage;
                        inputElement.parentElement.classList.add('invalid');
                    }else{
                        errorElement.innerText = "";
                        inputElement.parentElement.classList.remove('invalid');
                    }
                }
            }

            inputElement.oninput = function(){
                inputElement.parentElement.classList.remove('invalid');
            }
        });
    }
}

Validator.isRequired = function(selector){
    return {
        selector: selector,
        test: function(value){
            return value.trim() ? undefined : 'Vui lòng nhập trường này';
        }
    };

}

Validator.isEmail = function(selector){
    return {
        selector: selector,
        test: function(value){
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            return regex.test(value) ? undefined : 'Trường này phải là email'
        }
    };
}


Validator.minLength = function(selector){
    return{
        selector: selector,
        test: function(value){
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/
            return regex.test(value) ? undefined : 'Mật khẩu phải trên 8 ký tự, bao gồm 1 chữ thường, 1 in hoa và 1 chữ số'
        }
    }
}


Validator.isConfirm = function(selector,getConfirmValue){
    return {
        selector: selector,
        test: function(value){
            return value=== getConfirmValue() ? undefined : 'Giá trị nhập vào không chính xác';
        }
    }
}