<<<<<<< HEAD

const forms = document.querySelectorAll("form");


forms.forEach((form) => {
  form.addEventListener("submit", function (e) {
   
    e.preventDefault();

 
    const textarea = form.getElementsById("textreply");
    const message = textarea.value.trim(); 

    
    let responseMessage = form.querySelector("#responseMessage");
    if (!responseMessage) {
      responseMessage = document.createElement("p");
      responseMessage.id = "responseMessage";
      form.appendChild(responseMessage);
    }

    
    if (message === "") {
      responseMessage.textContent = "Duhesh me shkru diçka!";
      responseMessage.style.color = "red";
    } else {
      responseMessage.textContent = "Mesazhi u dergua!";
      responseMessage.style.color = "green";

      
      textreply.value = "";
    }
  }
=======

const forms = document.querySelectorAll("form");


forms.forEach((form) => {
  form.addEventListener("submit", function (e) {
   
    e.preventDefault();

 
    const textarea = form.getElementsById("textreply");
    const message = textarea.value.trim(); 

    
    let responseMessage = form.querySelector("#responseMessage");
    if (!responseMessage) {
      responseMessage = document.createElement("p");
      responseMessage.id = "responseMessage";
      form.appendChild(responseMessage);
    }

    
    if (message === "") {
      responseMessage.textContent = "Duhesh me shkru diçka!";
      responseMessage.style.color = "red";
    } else {
      responseMessage.textContent = "Mesazhi u dergua!";
      responseMessage.style.color = "green";

      
      textreply.value = "";
    }
}
>>>>>>> 7eea70d98ae2b0f3ddffaeea1b7dd656c71f7489
}