/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
const loginForm = document.getElementById('login-form');
const loginBtn = document.getElementById('login-btn');

loginBtn.addEventListener('click', (e) => {
  e.preventDefault();
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  if (username === 'shadow' && password === '0813') {
    alert('Login successful!');
    window.location.href = 'home.php';
  }else if(username === 'chun' && password === '0813') {
    alert('Login successful!');
    window.location.href = 'adminpanel.php';
  }else {
    alert('Invalid username or password');
  }
});

