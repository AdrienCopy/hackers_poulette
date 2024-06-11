const email = document.getElementById('email');
let p = document.createElement('p');
p.textContent = "incorrect email address"
p.style.color = 'red';


email.addEventListener('blur', function(event) {
    const saisie = event.target.value;
    if (saisie.includes('@')) {
        p.remove();
      } else {
        email.parentNode.insertBefore(p, email.nextSibling);
        console.log("error");
      }
  });