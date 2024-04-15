import React from 'react';
import '../css/login.css'; // Importowanie stylów CSS

const LoginPage = () => {
  const handleLogin = (event: React.FormEvent) => {
    event.preventDefault();
    // Tutaj dodasz logikę logowania
    console.log('Logging in...');
  };

  return (
    <div className="container">
      <div className="overlap-group">
        <div className="page-header">
          <div className="login-text">Log In</div>
        </div>
        <button type="button" onClick={() => window.location.href='register'} className="SignUp">
          Sign Up
        </button>
        <form className="login" onSubmit={handleLogin}>
          <input name="email" type="text" placeholder="email@email.com" />
          <input name="password" type="password" placeholder="password" />
          <button type="submit" className="loginButton">
            LOGIN
          </button>
        </form>
      </div>
      {/* <div className="forgot">
        <a href="">Forgot your password?</a>
      </div> */}
    </div>
  );
};

export default LoginPage;
