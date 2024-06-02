import React, { useState } from 'react';
import axios from 'axios';
import '../css/login.css'; // Importowanie stylów CSS
import { useNavigate } from 'react-router-dom';

interface LoginPageProps {
  setIsLoggedIn: React.Dispatch<React.SetStateAction<boolean>>;
}

const LoginPage: React.FC<LoginPageProps> = ({ setIsLoggedIn }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState<string | null>(null);
  const navigate = useNavigate();

  const handleLogin = async (event: React.FormEvent) => {
    event.preventDefault();
    setError(null); // Wyczyść bieżący błąd

    try {
      const response = await axios.post('https://localhost/auth', { email, password });
      const token = response.data.token;
      const user = response.data.user;
      const userId = user.id;
      sessionStorage.setItem('token', token);
      sessionStorage.setItem('userId', userId);
      //console.log('Zalogowano pomyślnie. Token JWT:', token);
      setIsLoggedIn(true);
      navigate('/myLists');
    } catch (error) {
      console.error('Błąd logowania:', error);
      setError('Nieprawidłowy email lub hasło.');
    }
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
          <input name="email" type="text" placeholder="email@email.com" value={email} onChange={(e) => setEmail(e.target.value)} />
          <input name="password" type="password" placeholder="password" value={password} onChange={(e) => setPassword(e.target.value)} />
          <button type="submit" className="loginButton">
            LOGIN
          </button>
          {error && <div style={{ color: 'red' }}>{error}</div>} {/* Wyświetl błąd, jeśli istnieje */}
        </form>
      </div>
      {/* <div className="forgot">
        <a href="">Forgot your password?</a>
      </div> */}
    </div>
  );
};

export default LoginPage;
