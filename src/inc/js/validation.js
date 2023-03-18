const validation = new JustValidate("#signupform"); // just validate obj with selector for form

validation // obj, field select first argument and then an array fof rules. each rule an obj
    .addField("#userName", [ // rule for userName
        {
            rule: "required"
        },
        {
            validator: (value) => () => {
                return fetch("INET-Assignment03-PollinSystem/src/inc/validate-userName.php?userName=" + 
                encodeURIComponent(value)) //returns a promise obj
                        .then(response => response.json())
                        .then(data => {
                            if (data.available) {
                                return Promise.resolve(false);
                            } else {
                                return Promise.reject("User Name Already Exists");
                            }
                        })
                        .catch(error => Promise.reject("Unable to check User Name availability"));
            },
            errorMessage: "User Name Already Exists"
        }
    ])
    .addField("#email", [ // rule for email
        {
            rule: "required"
        },
        {
            rule: "email"
        }
    ])
    .addField("#fName", [ // rule for first name
        {
            rule: "required"
        }
    ])
    .addField("#lName", [ // rule for last name
        {
            rule: "required"
        }
    ])
    .addField("#password", [ // rule for password
        {
            rule: "required"
        },
        {
            rule: "password" // at least 8 characters and contain at least 1 letter and 1 number
        }
    ])
    .addField("#password2", [ // rule for password2
        {
            rule: "required"
        },
        { // custom validator method to take in password2 value and match with password value. returns true or false
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords Must Match"
        }
    ])
    .addField("#terms", [
        {
            rule: "required"
        }
    ])
    // now for when the submit btn is clicked
    .onSuccess((event) => {
        document.getElementById("signupform").submit();
    });
