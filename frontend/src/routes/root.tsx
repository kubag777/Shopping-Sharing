
import { Outlet, Link } from "react-router-dom";

export default function Root() {
  return (
    <>
      <div id="sidebar">  
        <nav>
          <ul>
            <li>
              <Link to="/login">Login</Link>
            </li>
            <li>
              <Link to="/register">Register</Link>
            </li>
            <li>
              <Link to="/myLists">Listy</Link>
            </li>
            <li>
              <Link to="/profile">Profil</Link>
            </li>
            <li className="logoutButton">
              <Link to="/logout">Wyloguj</Link>
            </li> 
          </ul>
        </nav>
      </div>
      <div id="detail">
        <Outlet />
      </div>
    </>
  );
}
