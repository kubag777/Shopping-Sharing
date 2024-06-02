import { Outlet, Link } from "react-router-dom";

interface RootProps {
  isLoggedIn: boolean;
}

const Root: React.FC<RootProps> = ({ isLoggedIn }) => {
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
                    // Tu możesz dodać logikę wylogowania
                    sessionStorage.clear();
                  }}>Wyloguj</Link>
                </li>
              </>
            )}
          </ul>
        </nav>
      </div>
      <div id="detail">
        <Outlet />
      </div>
    </>
  );
};

export default Root;
