/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
const form = document.getElementById('register');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm-password');
const registerBtn = document.getElementById('register-btn');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  if (passwordInput.value !== confirmPasswordInput.value) {
    alert('Passwords do not match');
    return;
  }
  console.log({
    name: nameInput.value,
    email: emailInput.value,
    password: passwordInput.value
  });
});

const phoneInput = document.getElementById('phone');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const phone = phoneInput.value;
  if (isValidPhone(phone)) {
    console.log(`Phone number ${phone} is valid`);
  } else {
    alert('Invalid phone number');
  }
});

function isValidPhone(phone) {
  const validChars = /^[0-9+-]+$/;
  if (!validChars.test(phone)) {
    return false;
  }
  const digits = phone.replace(/[-+]/g, '');
  return digits.length >= 10;
}
