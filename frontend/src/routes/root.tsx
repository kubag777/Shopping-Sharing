import { Outlet, Link } from "react-router-dom";

interface RootProps {
  isLoggedIn: boolean;
  setIsLoggedIn: (isLoggedIn: boolean) => void;
}

const Root: React.FC<RootProps> = ({ isLoggedIn, setIsLoggedIn }) => {
  return (
    <>
      <div id="sidebar">
        <nav>
          <ul>
            {!isLoggedIn ? (
              <>
                <li>
                  <Link to="/login">Login</Link>
                </li>
                <li>
                  <Link to="/register">Register</Link>
                </li>
              </>
            ) : (
              <>
                <li>
                  <Link to="/myLists">Listy</Link>
                </li>
                <li>
                  <Link to="/profile">Profil</Link>
                </li>
                <li className="logoutButton">
                  <Link to="/login" onClick={() => {
                    // Logika wylogowania
                    sessionStorage.clear();
                    setIsLoggedIn(false);
                  }}>Wyloguj</Link>
                </li>
              </>
            )}
          </ul>
          <img src="public/logo.jpg" alt="Logo" className="sidebarLogo" />
        </nav>

      </div>
      <div id="detail">
        <Outlet />
      </div>
    </>
  );
};

export default Root;
