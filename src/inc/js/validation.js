const validation = new JustValidate("#signupform"); // just validate obj with selector for form

validation // obj, field select first argument and then an array fof rules. each rule an obj
    .addField("#userName", [
        {
            rule: "required"
        }

    ]);
