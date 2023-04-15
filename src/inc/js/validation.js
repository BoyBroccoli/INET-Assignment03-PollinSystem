// JustValidate obj with selector for form
const validation = new JustValidate("#signupform");

// obj, field select first argument and then an array for rules. each rule an obj
validation
    .addField("#userName", [ // rule for userName
        {
            rule: "required"
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
