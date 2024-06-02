import React, { useState } from 'react';
import '../css/global.css';
import '../css/register.css';

interface RegisterProps {
  email?: string;
  // name?: string;
  // surname?: string;
}

const Register: React.FC<RegisterProps> = ({ email = '', /*name = '', surname = '' */}) => {
  const [formData, setFormData] = useState({ email, /*name, surname,*/ plainPassword: '' });


  
  const handleLoginClick = () => {
    window.location.href = 'login';
  };
  
  const handleSubmit = async (event: React.FormEvent) => {
    console.log(JSON.stringify({ ...formData }));
    event.preventDefault();
    // Obsługa logiki rejestracji, np. wywołanie API
    try {
      const response = await fetch('https://localhost:443/api/users', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/ld+json'
        },
        body: JSON.stringify({...formData})
      });
      if (response.ok) {
        window.location.href = 'myLists';
      } else {
        // Obsługa błędów rejestracji
        const errorData = await response.json();
        console.error('Błąd rejestracji:', errorData.message);
      }
    } catch (error) {
      console.error('Błąd sieci:', error);
    }
  };

  const handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = event.target;
    setFormData((prevFormData) => ({
      ...prevFormData,
      [name]: value
    }));
  };

  return (
    <div className="container">
      <div className="overlap-group">
        <div className="page-header">
          <div className="register-text">Create account</div>
        </div>
        <button type="button" className="logIn" onClick={handleLoginClick}>
          LOGIN
        </button>
        <form className="register" action="register" method="POST" onSubmit={handleSubmit}>
          <input name="email" type="text" placeholder="email@email.com" value={formData.email} onChange={handleChange} />
          {/* <input name="name" type="text" placeholder="Name" value={formData.name} onChange={handleChange} /> */}
          {/* <input name="surname" type="text" placeholder="Surname" value={formData.surname} onChange={handleChange} /> */}
          <input name="plainPassword" type="password" placeholder="Password" value={formData.plainPassword} onChange={handleChange} />
          <button type="submit">REGISTER</button>
        </form>
      </div>
    </div>
  );
};

export default Register;
