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

    try {
      const response = await axios.post('https://localhost/auth', { email, password });
      const token = response.data.token;
      const user = response.data.user;
      const userId = user.id;
      sessionStorage.setItem('token', token);
      sessionStorage.setItem('userId', userId);
      setIsLoggedIn(true);
      navigate('/myLists');
    } catch (error) {
      setError('Nieprawidłowy email lub hasło.');
      console.error('Błąd logowania:', error);
    }
  };

  return (
    <div className="container">
      <div className="overlap-group">
        <div className="page-header">
          <div className="login-text">Log into</div>
        </div>
        <button type="button" onClick={() => window.location.href='register'} className="SignUp">
          SIGN UP
        </button>
        <form className="login" onSubmit={handleLogin}>
          <input name="email" type="text" placeholder="email@email.com" value={email} onChange={(e) => setEmail(e.target.value)} />
          <input name="password" type="password" placeholder="password" value={password} onChange={(e) => setPassword(e.target.value)} />
          <button type="submit" className="loginButton">
            LOGIN
          </button>
          {error && <div style={{ color: 'red' }}>{error}</div>}
        </form>
      </div>
    </div>
  );
};

export default LoginPage;
