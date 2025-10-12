function compute_days(){
    const dob = get_dob();
    
    // Add code here computing the age in number of days!
    if (!dob) {
        write_answer_days("Please enter your date of birth.");
        return;
    }

    const birthDate = new Date(dob);
    const today = new Date();
    const diffTime = today - birthDate;
    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

    write_answer_days(
        "You are approximately <b>" + diffDays + "</b> days old."
    );
}


function compute_circle(){
    const screen = get_screen_dims();
    
    // Add code here computing the radius and area of the circle
    const radius = Math.min(screen.width, screen.height) / 2;
    const area = Math.PI * radius * radius;

    write_answer_circle(
        "The biggest circle that fits on your screen has a radius of <b>" +
        radius.toFixed(2) + "</b> pixels and an area of <b>" +
        area.toFixed(2) + "</b> pixels²."
    );
}


function check_palindrome(){
    const text_input = get_palindrome();
    
    // Add code here checking if text_input is a palindrome.
    // You must use a for loop
    // Hint: choose how to manage spaces and capital/lowercase letters!
    if (!text_input) {
        write_answer_palindrome("Please enter some text.");
        return;
    }

    const cleaned = text_input.replace(/\s+/g, '').toLowerCase();
    let isPalindrome = true;

    for (let i = 0; i < Math.floor(cleaned.length / 2); i++) {
        if (cleaned[i] !== cleaned[cleaned.length - 1 - i]) {
            isPalindrome = false;
            break;
        }
    }

    const resultText = isPalindrome ? "is a palindrome!" : "is NOT a palindrome!";
    write_answer_palindrome(
        "Your text: <b>" + text_input + "</b> <br>Result: <b>" + resultText + "</b>"
    );
}


function create_fibo(){    
    // Add code here to get the wanted length. 
    // Hint: check my other codes in javascript_utils.js
    const fibo_length = Number(document.getElementById("fibo_length").value);
    
    // Add code here to compute the fibonacci sequence.
    // The two first elements are 0 and 1
    // The next elements are the sum of the two last elements.
    // You must use arrays
    // What happens if the input number is negative?
    // What happens if the input number is 0 or 1?
    if (isNaN(fibo_length) || fibo_length <= 0) {
        write_answer_fibo("Please enter a positive number greater than 0.");
        return;
    }

    if (fibo_length === 1) {
        write_answer_fibo("<b>0</b>");
        return;
    }

    const fibo = [0, 1];
    for (let i = 2; i < fibo_length; i++) {
        fibo.push(fibo[i - 1] + fibo[i - 2]);
    }

    write_answer_fibo(
        "Here is your Fibonacci sequence (" + fibo_length + " elements): <br><b>" +
        fibo.slice(0, fibo_length).join(", ") + "</b>"
    );
}
