/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


var selectedRow = null;

//show
function showAlert(message, className){
    const div = document.createElement("div");
    div.className = `alert alert-${className}`;
    
    div.appendChild(document.createTextNode(message));
    const container = document.querySelector(".container");
    const main = document.querySelector(".main");
    container.insertBefore(div, main);
    
    setTimeout(() => document.querySelector(".alert").remove(), 3000);
    }
// clear All
function clearFields(){
    document.querySelector("#eventName").value = "";
    document.querySelector("#tPrice").value = "";
    document.querySelector("#wSeat").value = "";   
}  

//Add
document.querySelector("#event-form").addEventListener("submit", (e) =>{
    e.preventDefault();
        
    //get Form Values
    const eventName = document.querySelector("#eventName").value;
    const tPrice = document.querySelector("#tPrice").value;
    const wSeat = document.querySelector("#wSeat").value;
        
    //validate
    if(eventName == "" || tPrice == "" || wSeat == ""){
        showAlert("Please fill in all blank", "danger");
    }else{
        if(selectedRow == null){
            const list = document.querySelector("#event-list");
            const row  = document.createElement("tr");
            
            row.innerHTML = `
            <td>${eventName}</td>
            <td>${tPrice}</td>
            <td>${wSeat}</td>
            <td>
            <a href="#" class="btn btn-warning btn-sm edit">Edit</a>
            <a href="#" class="btn btn-danger btn-sm delete">Delete</a> 
            </td>
`;
list.appendChild(row);
selectedRow = null;
showAlert("Event Added", "success");
        }
        else{
            selectedRow.children[0].textContent = eventName;
            selectedRow.children[1].textContent = tPrice;
            selectedRow.children[2].textContent = wSeat;
            selectedRow = null;
            showAlert("Event Info Edited", "info");
        }
        clearFields();
    }
        
});



