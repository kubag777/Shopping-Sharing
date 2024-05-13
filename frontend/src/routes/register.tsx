import '../css/global.css';
import '../css/register.css';

function Register() {
  const handleLoginClick = () => {
    window.location.href = 'login';
  };

  const handleSubmit = (event: React.FormEvent) => {
    event.preventDefault();
    // Obsługa logiki rejestracji
  };

  return (
    <div className="container">
      <div className="overlap-group">
        <div className="page-header">
          <div className="register-text">Register</div>
        </div>
        <button type="button" className="logIn" onClick={handleLoginClick}>
          Login
        </button>
        <form className="register" action="register" method="POST" onSubmit={handleSubmit}>
          <input name="email" type="text" placeholder="email@email.com" />
          <input name="name" type="text" placeholder="Name" />
          <input name="surname" type="text" placeholder="Surname" />
          <input name="password" type="password" placeholder="Password" />
          <button type="submit">REGISTER</button>
        </form>
      </div>
    </div>
  );
}

export default Register;
