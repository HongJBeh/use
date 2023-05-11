/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
const resetPasswordForm = document.getElementById('reset-password-form');
const submitBtn = document.getElementById('submit-btn');

submitBtn.addEventListener('click', (e) => {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  if (isValidReset(email, password, confirmPassword)) {
    alert('Password reset successful!');
    window.location.href = 'login.php';
  } else {
    alert('Invalid email or password');
  }
});

function isValidReset(email, password, confirmPassword) {
  if (password !== confirmPassword) {
    return false;
  }
  return true;
}

